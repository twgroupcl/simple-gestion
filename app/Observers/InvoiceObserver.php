<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Invoice;
use App\Models\Payments;
use App\Models\InvoiceItem;
use App\Services\DTE\DTEService;

class InvoiceObserver
{
    /**
     * Handle the quotation "created" event.
     *
     * @param  \App\Invoice  $quotation
     * @return void
     */
    public function creating(Invoice $invoice) {

        // Store customer address
        $invoice->uid = $invoice->customer->uid;
        $invoice->first_name = $invoice->customer->first_name;
        $invoice->last_name = $invoice->customer->last_name;
        $invoice->email = $invoice->customer->email;
        $invoice->phone = $invoice->customer->phone;
        $invoice->cellphone = $invoice->customer->cellphone;

        // emitter data
        $invoice->company_id = backpack_user()->current()->company->id;
        $invoice->is_company = $invoice->customer->is_company;
        $invoice->invoice_status = Invoice::STATUS_DRAFT;

        if ($invoice->invoice_type->code == 39 || $invoice->invoice_type->code == 41) {
            $invoice->business_activity_id = null;
        }
    }


    /**
     * Handle the quotation "created" event.
     *
     * @param  \App\Invoice  $quotation
     * @return void
     */
    public function created(Invoice $invoice)
    {
        $this->syncInvoiceItems($invoice, [ 'set_quotation_status' => 'BORRADOR', 'set_item_status' => 'pending']);
    }

    /**
     * Handle the invoice "updating" event
     * @param \App\Invoice $invoice
     * @return void
     */
    public function updating(Invoice $invoice)
    {
        if ($invoice->invoice_status == Invoice::STATUS_TEMPORAL) {
            $service = new DTEService();
            $originalInvoice = Invoice::toObject($invoice->getOriginal());

            $response = $service->deleteTemporalDocument($originalInvoice);
            if ($response->getStatusCode() !== 200) {
                \Alert::add('danger', 'No se pudo cambiar el documento')->flash();
                return false;
            }

            \Alert::add('sucess', 'El documento temporal se ha eliminado, deberá enviarlo nuevamente.')->flash();
            $invoice->toDraft();
        }
        
        if ($invoice->invoice_type->code == 39 || $invoice->invoice_type->code == 41) {
            $invoice->business_activity_id = null;
        }
    }

    /**
     * Handle the quotation "updated" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function updated(Invoice $invoice)
    {
        $this->syncInvoiceItems($invoice, [ 'set_item_status' => 'pending']);

    }

    public function syncInvoiceItems($invoice, $options = []) {

        if ( !empty($invoice->items_data) ) {

            InvoiceItem::where('invoice_id', $invoice->id)->delete();

            $items = is_string($invoice->items_data) ? json_decode($invoice->items_data, true) : $invoice->items_data;

            foreach($items as &$item) {

                // Sanitize numbers
                $item['price'] = sanitizeNumber($item['price']);
                $item['discount'] = sanitizeNumber($item['discount']);
                $item['total'] = sanitizeNumber($item['total']);
                //$item['tax_amount'] = sanitizeNumber($item['tax_amount']);
                //$item['tax_total'] = sanitizeNumber($item['tax_total']);

                // Calculate discount amount base on the type of discount
                if ($item['discount_type'] == 'amount') {
                    $item['discount_amount'] = $item['discount'];
                    $item['discount_total'] = $item['discount'];
                    $item['discount_percent'] = 0;
                } else if ($item['discount_type'] == 'percentage') {
                    $item['discount_amount'] = 0;
                    $item['discount_percent'] = $item['discount'];
                    $item['discount_total'] = $item['discount_percent'] / 100 * ($item['price'] * $item['qty']);
                }

                $item['sub_total'] = $item['price'] * $item['qty'];

                if ($item['is_custom']) {

                    $props = [
                        'invoice_id' => $invoice->id,
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'qty' => $item['qty'],
                        'sub_total' => $item['sub_total'],
                        'is_custom' => $item['is_custom'],
                        'discount_percent' => $item['discount_percent'],
                        'discount_amount' => $item['discount_amount'],
                        'discount_total' => $item['discount_total'],
                        //'tax_percent' => $item['tax_percent'],
                        'additional_tax_id' => $item['additional_tax_id'] == 0 ? null : $item['additional_tax_id'],
                        'additional_tax_amount' => $item['additional_tax_amount'],
                        'additional_tax_total' => $item['additional_tax_total'],
                        'total' => $item['total'],
                        'currency_id' => $invoice->currency_id,
                        'seller_id' => $invoice->seller_id,
                    ];

                    //if ( isset($options['set_item_status']) ) $props['item_status'] = $options['set_item_status'];

                    InvoiceItem::create($props);

                } else {

                    $product = Product::find($item['product_id']);

                    $props = [
                        'invoice_id' => $invoice->id,
                        'name' => $product->name,
                        'sku' => $product->sku,
                        'product_id' => $product->id,
                        'description' =>$item['description'],
                        'price' =>$item['price'],
                        'qty' => $item['qty'],
                        'weight' => $product->weight,
                        'height' => $product->height,
                        'depth' => $product->depth,
                        'width' => $product->width,
                        'sub_total' => $item['sub_total'],
                        'is_custom' => false,
                        'parent_id' => $product->parent_id,
                        'seller_id' => $invoice->seller_id,
                        'discount_percent' => $item['discount_percent'],
                        'discount_amount' => $item['discount_amount'],
                        'discount_total' => $item['discount_total'],
                        //'tax_percent' => $item['tax_percent'],
                        'additional_tax_id' => $item['additional_tax_id'] == 0 ? null : $item['additional_tax_id'],
                        'additional_tax_amount' => $item['additional_tax_amount'],
                        'additional_tax_total' => $item['additional_tax_total'],
                        'total' => $item['total'],
                        'currency_id' => $invoice->currency_id,
                    ];

                    //if ( isset($options['set_item_status']) ) $props['item_status'] = $options['set_item_status'];

                    InvoiceItem::create($props);
                }

            }

            // @todo Check this later
            $itemQty = collect($items)->sum('qty');
            $itemCount = count($items);
            $sub_total = collect($items)->sum('total');

            $hasDiscountPerItem = collect($items)->sum('discount_total') > 0 ? 1 : 0;
            $hasTaxPerItem = collect($items)->sum('additional_tax_total') > 0 ? 1 : 0;

            //dd(collect($items)->sum('discount_total') , collect($items)->sum('additional_tax_total'), $hasTaxPerItem,  $hasDiscountPerItem);
            //dd($invoice->discount_amount, collect($items)->sum('discount_total'));
            $discount_total = $invoice->discount_amount + collect($items)->sum('discount_total');

            $propsToUpdate = [
                'items_qty' => $itemQty,
                'items_count' => $itemCount,
                'sub_total' => $sub_total,
                'discount_total' => $discount_total,
                'has_discount_per_item' => $hasDiscountPerItem,
                'has_tax_per_item' => $hasTaxPerItem,
            ];

            //if ( isset($options['set_quotation_status']) ) $propsToUpdate['quotation_status'] = ($options['set_quotation_status']);

            $invoice->updateWithoutEvents($propsToUpdate);
        }
    }

    public function deleted(Invoice $invoice)
    {
        if ($invoice->invoice_status == Invoice::STATUS_TEMPORAL) {
            $service = new DTEService();
            $service->deleteTemporalDocument($invoice);
        }
    }
}
