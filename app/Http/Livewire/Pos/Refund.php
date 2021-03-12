<?php

namespace App\Http\Livewire\Pos;

use App\Models\Order;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\InvoiceType;
use App\Services\DTE\DTEService;

/**
 * @todo
 * 
 * - Notas de credito no estan funcionando con invoices que poseen descuentos
 */

class Refund extends Component
{

    public $type;
    public $reason;
    public $order;
    public $invoice;
    public $creditNote;
    public $itemsToRefund;
    public $totals;

    public $step = 1;
    public $messageError;

    protected $listeners = ['selectOrder' => 'selectOrder'];

    public function render()
    {
        return view('livewire.pos.refund');
    }

    public function goStep(int $step)
    {
        $this->step = $step;
    }

    public function cleanData()
    {
        $this->step = 1;
        $this->messageError = null;
        $this->reason = null;
        $this->creditNote = null;
        $this->totals = [];
    }

    public function selectOrder($orderId)
    {
        $this->cleanData();
        
        $this->order = Order::find($orderId);
        $this->invoice = $this->order->invoice;
        $this->itemsToRefund = $this->invoice->invoice_items->map(function ($item) {
            return [
                'item_id' => $item->id,
                'name' => $item->name,
                'max_qty' => $item->qty,
                'qty_to_return' => 0,
                'price' => $item->price,
                'product_id' => $item->product_id,
            ];
        });
    }

    public function addQty($itemId, $qty)
    {
        $index = null;

        foreach ($this->itemsToRefund as $key => $item) {
            if ($item['item_id'] == $itemId) {
                $index = $key;
                break;
            }
        }
        if ($index === null) return false;
        
        $item = $this->itemsToRefund[$index];

        if ($item['qty_to_return'] + $qty > $item['max_qty']) return false;

        $item['qty_to_return'] = $item['qty_to_return'] + $qty;  
        $this->itemsToRefund[$index] = $item;
        $this->calculateTotals(); 
    }

    public function removeQty($itemId, $qty)
    {
        $index = null;

        foreach ($this->itemsToRefund as $key => $item) {
            if ($item['item_id'] == $itemId) {
                $index = $key;
                break;
            }
        }
        if ($index === null) return false;
        
        $item = $this->itemsToRefund[$index];

        if ($item['qty_to_return'] - $qty < 0) return false;

        $item['qty_to_return'] = $item['qty_to_return'] - $qty;  
        $this->itemsToRefund[$index] = $item; 

        $this->calculateTotals();
    }

    /**
     * Calculate the subtotal, iva, and total of items to be returned
     * 
     */
    public function calculateTotals()
    {
        $this->totals = ['subtotal' => 0, 'iva' => 0, 'total' => 0];

        foreach ($this->itemsToRefund as $key => $item) {
            $this->totals['subtotal'] += $item['price'] * $item['qty_to_return']; 
        }

        $this->totals['iva'] = $this->totals['subtotal'] * 0.19;
        $this->totals['total'] = $this->totals['subtotal'] * 1.19;
    }

    /**
     * Create a new credit note 
     * 
     * @param bool $moveInventory if true, the qty of the returned items will be added to the inventories
     */
    public function issueCreditNote(bool $moveInventory = false)
    {
        $this->messageError = null;

        if (!$this->invoice) return $this->messageError = 'Ocurrio un error';

        $invoice = $this->invoice;

        if (!isset($invoice->folio)) {
            return $this->messageError = 'El documento que intentas referenciar no posee un folio';
        }

        $creditNote = new Invoice($invoice->toArray());
        $creditNote->folio = null;
        $creditNote->dte_code = null;
        $creditNote->dte_status = null;
        $creditNoteType = InvoiceType::whereCode('61')->first();
        $creditNote->invoice_type_id = $creditNoteType->id;
        $creditNote->json_value = [
            'reference_type_document' => $invoice->invoice_type_id,
            'reference_folio' => $invoice->folio,
            'reference_date' => $invoice->invoice_date,
            'reference_reason' => $this->reason,
            'reference_code' => 3, // Corrige montos
            'source' => 'pos',
        ];

        $itemsData = collect(json_decode($creditNote->items_data, true));

        $itemsData = $itemsData->map(function ($item) {
            foreach ($this->itemsToRefund as $itemRefund) {
                // Si hay dos items con el mismo product id o si
                // alguno de los items no tiene un product id (en el caso de items personalizados)
                // el proceso fallara
                if ($itemRefund['product_id'] == $item['product_id']) {
                    $item['qty'] = $itemRefund['qty_to_return'];
                    break;
                }
            }
            return $item;
        });

        // Remove items with qty equals to 0
        $itemsData = $itemsData->filter(function ($item) {
            return $item['qty'] == 0 ? false : true;
        });

        if (!$itemsData->count()) return $this->messageError = 'La nota de credito debe contener por lo menos un item';

        \DB::beginTransaction();
        $error = false;

        try {
            $creditNote->items_data = $itemsData;
            $creditNote = $this->calculateInvoiceTotal($creditNote);
            $creditNote->save();
    
            if ($moveInventory) {
                $this->updateInventory();
            }
        } catch (\Exception $e) {
            \Log::error('Error creando nota de credito para devolución: ' . $e->getMessage());
            $error = true;
            $errorMessage = $e->getMessage();
        }
        
        if ($error) {
            $this->messageError = 'Ocurrio un error: ' . $errorMessage;
            \DB::rollBack();
            return false;
        }

        \DB::commit();

        $this->creditNote = $creditNote;
        $this->goStep(3);
    }

    /**
     * Calculate the total of the invoice base on the new qty of products
     * 
     * @param $invoice
     * @return Invoice the invoice with the new total
     */
    public function calculateInvoiceTotal(Invoice $invoice)
    {
        $referenceTypeDocument = InvoiceType::find($invoice->json_value['reference_type_document'])->first();

        $hasIva = in_array($referenceTypeDocument->code, [41, 34]) ? false : true;
        $iva = 0;
        $total = 0;
        $subTotal = 0;

        $itemsData = collect($invoice->items_data)->map(function ($item) use ($hasIva, &$iva, &$subTotal) {
            $price = sanitizeNumber($item['price']);
            $sub_total = $price * $item['qty'];
            
            $item['sub_total'] = number_format($sub_total, 0, ',', '.');
            $subTotal += $sub_total; 

            // @todo discount
            $item['total'] = number_format($sub_total, 0, ',', '.');

            if ($hasIva) $iva += $sub_total * 0.19;

            return $item;
        });

        $total = round($subTotal) + round($iva);

        $invoice->items_data = $itemsData;
        $invoice->sub_total = $subTotal;
        $invoice->tax_amount = $iva; 
        $invoice->total = $total;

        return $invoice;
    }

    /**
     * Sum the qty returned to the inventory of the product
     * 
     */
    public function updateInventory()
    {
        foreach ($this->itemsToRefund as $key => $item) {

            $product = Product::find($item['product_id']);

            if (!$product || $product->use_inventory_control == false) continue;

            $inventory = $product->inventories->first();
            $actualQty = $inventory->pivot->qty;
            $newQty = $actualQty + $item['qty_to_return'];

            $product->updateInventory($newQty, $inventory->id);            
        }
    }
}
