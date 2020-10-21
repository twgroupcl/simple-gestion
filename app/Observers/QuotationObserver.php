<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Quotation;
use App\Models\QuotationItem;

class QuotationObserver
{
    /**
     * Handle the quotation "created" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function created(Quotation $quotation)
    {
        $this->syncQuotationItems($quotation, [ 'set_quotation_status' => 'pending', 'set_item_status' => 'pending']);
    }

    /**
     * Handle the quotation "updated" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function updated(Quotation $quotation)
    {
        if ( $quotation->isDirty('quotation_items_json') ) {
            $this->syncQuotationItems($quotation, [ 'set_quotation_status' => 'pending', 'set_item_status' => 'pending']);
        }
    }

    /**
     * Handle the quotation "deleted" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function deleted(Quotation $quotation)
    {
        //
    }

    /**
     * Handle the quotation "restored" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function restored(Quotation $quotation)
    {
        //
    }

    /**
     * Handle the quotation "force deleted" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function forceDeleted(Quotation $quotation)
    {
        //
    }

        public function syncQuotationItems($quotation, $options = []) {
    
        if ($quotation->is_custom && !empty($quotation->quotation_items_json)) {

            QuotationItem::where('quotation_id', $quotation->id)->delete();
            
            $items = $quotation->quotation_items_json;
            
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
                        'quotation_id' => $quotation->id,
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'qty' => $item['qty'],
                        'sub_total' => $item['sub_total'],
                        'is_custom' => $item['is_custom'],
                        'discount_percent' => $item['discount_percent'],
                        'discount_amount' => $item['discount_amount'],
                        'discount_total' => $item['discount_total'],
                        'tax_percent' => $item['tax_percent'],
                        'tax_amount' => $item['tax_amount'],
                        'tax_total' => $item['tax_total'],
                        'total' => $item['total'],
                        'currency_id' => $quotation->currency_id,
                        'business_id' => $quotation->business_id,
                    ];

                    if ( isset($options['set_item_status']) ) $props['item_status'] = $options['set_item_status'];

                    QuotationItem::create($props); 

                } else {

                    $product = Product::find($item['product_id']);

                    $props = [
                        'quotation_id' => $quotation->id,
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
                        'discount_percent' => $item['discount_percent'],
                        'discount_amount' => $item['discount_amount'],
                        'discount_total' => $item['discount_total'],
                        'tax_percent' => $item['tax_percent'],
                        'tax_amount' => $item['tax_amount'],
                        'tax_total' => $item['tax_total'],
                        'total' => $item['total'],
                        'currency_id' => $quotation->currency_id,
                        'business_id' => $quotation->business_id,
                    ];

                    if ( isset($options['set_item_status']) ) $props['item_status'] = $options['set_item_status'];

                    QuotationItem::create($props); 
                }
                
            }

            // @todo Check this later
            $itemQty = collect($items)->sum('qty');
            $itemCount = count($items);
            $sub_total = collect($items)->sum('sub_total');
            $tax_total = collect($items)->sum('tax_total');
            $discount_total = $quotation->discount_total;

            $propsToUpdate = [
                'items_qty' => $itemQty,
                'items_count' => $itemCount,
                'tax_total' => $tax_total,
                'sub_total' => $sub_total,
                'discount_total' => $discount_total,
            ];

            if ( isset($options['set_quotation_status']) ) $propsToUpdate['quotation_status'] = ($options['set_quotation_status']);

            $quotation->updateWithoutEvents($propsToUpdate);
        }
    }
}
