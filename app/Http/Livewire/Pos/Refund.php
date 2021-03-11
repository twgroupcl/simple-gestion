<?php

namespace App\Http\Livewire\Pos;

use App\Models\Order;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\InvoiceType;

class Refund extends Component
{

    public $type;
    public $reason;
    public $order;
    public $invoice;
    public $itemsToRefund;
    public $totals;

    protected $listeners = ['selectOrder' => 'selectOrder'];

    public function render()
    {
        return view('livewire.pos.refund');
    }

    public function selectOrder($orderId)
    {
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

    public function calculateTotals()
    {
        $this->totals = ['subtotal' => 0, 'iva' => 0, 'total' => 0];

        foreach ($this->itemsToRefund as $key => $item) {
            $this->totals['subtotal'] += $item['price'] * $item['qty_to_return']; 
        }

        
        $this->totals['iva'] = $this->totals['subtotal'] * 0.19;
        $this->totals['total'] = $this->totals['subtotal'] * 1.19;
    }

    public function issueCreditNote()
    {
        if (!$this->invoice) return false;

        $invoice = $this->invoice;

        if (!isset($invoice->dte_code)) {
            return dd('no tiene codigo dte');
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
        ];

        $itemsData = collect(json_decode($creditNote->items_data, true));
        $creditNote->items_data = $itemsData->map(function ($item) {
            foreach ($this->itemsToRefund as $itemRefund) {

                // Si hay dos items con el mismo product id o si
                // alguno de los items no tiene un product id (en el caso de items personalizados)
                // el proceso fallara
                if ($itemRefund['product_id'] == $item['product_id']) {
                    $item['qty'] = $item['qty'] - $itemRefund['qty_to_return'];
                    break;
                }
            }

            return $item;
        });

        $creditNote->save();
    }
}
