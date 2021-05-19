<?php

namespace App\Http\Livewire\Pos;

use Exception;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\RefundItem;
use App\Models\InvoiceType;
use App\Services\DTE\DTEService;
use Illuminate\Support\Facades\DB;
use App\Models\Refund as RefundModel;

/**
 * @todo
 * 
 * - Traspasar logica del movimiento de inventario a el controlador del ManageInvoice y crear campo en invoice
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
    public $disabledSendButton = false;

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
        $this->disabledSendButton = false;
    }

    public function selectOrder($orderId)
    {
        $this->cleanData();
        
        $this->order = Order::findOrFail($orderId);
        $this->invoice = $this->order->invoice;

        if (!$this->invoice) return false;
        
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
        $this->totals = [
            'subtotal' => 0, 
            'iva' => 0, 
            'total' => 0
        ];

        foreach ($this->itemsToRefund as $key => $item) {
            $this->totals['subtotal'] += $item['price'] * $item['qty_to_return']; 
        }

        if ($this->invoice->discount_percent > 0) {
            $this->totals['discount'] = $this->totals['subtotal'] * $this->invoice->discount_percent / 100; 
            $this->totals['iva'] = ($this->totals['subtotal'] - $this->totals['discount']) * 0.19;
            $this->totals['total'] = ($this->totals['subtotal'] - $this->totals['discount']) * 1.19;
        } else {
            $this->totals['iva'] = $this->totals['subtotal'] * 0.19;
            $this->totals['total'] = $this->totals['subtotal'] * 1.19;
        }
    }

    /**
     * Create a new credit note 
     * 
     * @param bool $moveInventory if true, the qty of the returned items will be added to the inventories
     */
    public function issueCreditNote(bool $moveInventory = false)
    {
        $this->messageError = null;
        $error = false;

        if (!$this->invoice) {
            return $this->messageError = 'Ocurrio un error';
        }

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

        $creditNote->references_json = json_encode([
            [
                'reference_type_document' => $invoice->invoice_type_id,
                'reference_folio' => $invoice->folio,
                'reference_date' => $invoice->invoice_date,
                'reference_reason' => $this->reason,
                'reference_code' => 3, // Corrige montos
                'source' => 'pos',
            ]
        ]);

        $itemsData = collect(!is_array($creditNote->items_data) 
                                ? json_decode($creditNote->items_data, true)
                                : $creditNote->items_data);

        $itemsData = $itemsData->map(function ($item) {
            foreach ($this->itemsToRefund as $itemRefund) {

                // Si hay dos items con el mismo product id o si
                // alguno de los items no tiene un product id (en el caso de items personalizados)
                // el proceso fallara

                // @todo 
                // Realizar una comparacion utilizando otros atributos (precio, qty, total)
                // para buscar el producto cuando este no tenga un product_id
                
                if ($itemRefund['product_id'] == $item['product_id']) {
                    $item['qty'] = $itemRefund['qty_to_return'];
                    break;
                }
            }
            return $item;
        });

        // Remove items with quantity equals to 0
        $itemsData = $itemsData->filter(function ($item) {
            return $item['qty'] == 0 ? false : true;
        })->values();

        if (!$itemsData->count()) {
            return $this->messageError = 'La nota de credito debe contener por lo menos un item';
        }

        DB::beginTransaction();

        try {
            // Create document (credit note)
            $creditNote->items_data = $itemsData;
            $creditNote = $this->calculateInvoiceTotal($creditNote);
            $creditNote->impact_inventory = $moveInventory;
            $creditNote->save();
            
            // Create refund
            $this->createRefund($this->order, $creditNote);
    
        } catch (Exception $e) {
            \Log::error('Error creando nota de credito para devolución: ' . $e->getMessage());

            $error = true;
            $errorMessage = $e->getMessage();
        }
        
        if ($error) {
            $this->messageError = 'Ocurrio un error: ' . $errorMessage;
            DB::rollBack();
            return false;
        }

        DB::commit();
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
        $referenceTypeDocument = InvoiceType::find($invoice->references_json[0]['reference_type_document'])->first();

        $hasIva = in_array($referenceTypeDocument->code, [41, 34]) ? false : true;
        $iva = 0;
        $total = 0;
        $subTotal = 0;
        $globalDiscountAmount = 0;

        $itemsData = collect($invoice->items_data)->map(function ($item) use ($invoice, $hasIva, &$iva, &$subTotal, &$globalDiscountAmount) {
            $price = sanitizeNumber($item['price']);
            $sub_total = $price * $item['qty'];
            $discountAmount = 0;

            $item['sub_total'] = number_format($sub_total, 0, ',', '.');
            $item['total'] = number_format($sub_total, 0, ',', '.');
            $subTotal += $sub_total; 
            
            if ($invoice->discount_percent > 0) {
                $discountAmount = $sub_total * $invoice->discount_percent / 100; 
                $globalDiscountAmount += $discountAmount;
            }

            if ($hasIva) $iva += ($sub_total - $discountAmount) * 0.19;

            return $item;
        });

        $total = round($subTotal) + round($iva) - round($globalDiscountAmount);

        $invoice->discount_total = $globalDiscountAmount;
        $invoice->discount_amount = $globalDiscountAmount;
        $invoice->items_data = $itemsData;
        $invoice->sub_total = $subTotal;
        $invoice->net = $subTotal - $globalDiscountAmount;
        $invoice->tax_amount = $iva; 
        $invoice->total = $total;

        return $invoice;
    }

    /**
     * Sum the qty returned to the inventory of the product
     * @deprecated the change in the inventory now happens in the ManageInvoice Controller
     * 
     */
    /* public function updateInventory()
    {
        foreach ($this->itemsToRefund as $key => $item) {

            $product = Product::find($item['product_id']);

            if (!$product || $product->use_inventory_control == false) continue;

            $inventory = $product->inventories->first();
            $actualQty = $inventory->pivot->qty;
            $newQty = $actualQty + $item['qty_to_return'];

            $product->updateInventory($newQty, $inventory->id);            
        }
    } */

    /**
     * Create a refund record from the order and invoice
     * 
     * @param Order $order the original order
     * @param Invoice $invoice the invoice with the returned items
     */
    public function createRefund(Order $order, Invoice $invoice)
    {
        $refundData = [
            'order_id' => $order->id,
            'invoice_id' => $invoice->id,
            'items_count' => count($invoice->items_data),
            'items_qty' => collect($invoice->items_data)->sum('qty'),
            'sub_total' => $invoice->sub_total,
            'discount_amount' => $invoice->discount_amount,
            'discount_percent' => $invoice->discount_percent,
            'discount_total' => $invoice->discount_total,
            'tax_amount' => $invoice->tax_amount, 
            'tax_percent' => 19,
            'tax_total' => $invoice->tax_amount,
            'total' => $invoice->total,
            'currency_id' => 63,
            'company_id' => $invoice->company_id,
        ];

        $refund = RefundModel::create($refundData);

        $refundItems = $invoice->invoice_items->map(function ($item) {
            $refundItem = new RefundItem();

            $refundItem->sku = $item['sku'];
            $refundItem->name = $item['name'];
            $refundItem->description = $item['description'];
            $refundItem->width = $item['width'];
            $refundItem->height = $item['height'];
            $refundItem->depth = $item['depth'];
            $refundItem->weight = $item['weight'];
            $refundItem->weight_total = $item['weight_total'];
            $refundItem->qty = $item['qty'];
            $refundItem->ind_exe = $item['ind_exe'] ?? 0;
            $refundItem->sub_total = $item['sub_total'];
            $refundItem->discount_total = $item['discount_total'];
            $refundItem->tax_percent = $item['tax_percent'];
            $refundItem->tax_amount = $item['tax_amount'];
            $refundItem->tax_total = $item['tax_total'];
            $refundItem->total = $item['total'];
            $refundItem->currency_id = $item['currency_id'];
            $refundItem->product_id = $item['product_id'];
            $refundItem->seller_id = $item['seller_id'];

            return $refundItem;
        });

        $refund->refund_items()->saveMany($refundItems);
    }

    public function sendCreditNote()
    {
        $this->disabledSendButton = true;
    }
}
