<?php

namespace App\Observers;

use Carbon\Carbon;
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
    public function creating(Quotation $quotation) {

        // Store customer address
        $quotation->uid = $quotation->customer->uid;
        $quotation->first_name = $quotation->customer->first_name;
        $quotation->last_name = $quotation->customer->last_name;
        $quotation->email = $quotation->customer->email;
        $quotation->phone = $quotation->customer->phone;
        $quotation->cellphone = $quotation->customer->cellphone;
        $quotation->is_company = $quotation->customer->is_company;

        $quotation->code = $this->generateUniqueCodeByBranch($quotation);

    }


    /**
     * Handle the quotation "created" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function created(Quotation $quotation)
    {
        $this->syncQuotationItems($quotation, [ 'set_quotation_status' => 'BORRADOR', 'set_item_status' => 'pending']);
    }

    public function updating(Quotation $quotation)
    {
        // Update quotation customer info
        $quotation->uid = $quotation->customer->uid;
        $quotation->first_name = $quotation->customer->first_name;
        $quotation->last_name = $quotation->customer->last_name;
        $quotation->email = $quotation->customer->email;
        $quotation->phone = $quotation->customer->phone;
        $quotation->cellphone = $quotation->customer->cellphone;
        $quotation->is_company = $quotation->customer->is_company;
    }

    /**
     * Handle the quotation "updated" event.
     *
     * @param  \App\Quotation  $quotation
     * @return void
     */
    public function updated(Quotation $quotation)
    {
            $this->syncQuotationItems($quotation, [ 'set_item_status' => 'pending']);
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
    
        if ( !empty($quotation->items_data) ) {

            QuotationItem::where('quotation_id', $quotation->id)->delete();
            
            $items = $quotation->items_data;
            
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
                        //'tax_percent' => $item['tax_percent'],
                        'additional_tax_id' => $item['additional_tax_id'] == 0 ? null : $item['additional_tax_id'],
                        'additional_tax_amount' => $item['additional_tax_amount'],
                        'additional_tax_total' => $item['additional_tax_total'],
                        'total' => $item['total'],
                        'currency_id' => $quotation->currency_id,
                        'seller_id' => $quotation->seller_id,
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
                        'parent_id' => $product->parent_id,
                        'seller_id' => $quotation->seller_id,
                        'discount_percent' => $item['discount_percent'],
                        'discount_amount' => $item['discount_amount'],
                        'discount_total' => $item['discount_total'],
                        //'tax_percent' => $item['tax_percent'],
                        'additional_tax_id' => $item['additional_tax_id'] == 0 ? null : $item['additional_tax_id'],
                        'additional_tax_amount' => $item['additional_tax_amount'],
                        'additional_tax_total' => $item['additional_tax_total'],
                        'total' => $item['total'],
                        'currency_id' => $quotation->currency_id,
                    ];

                    if ( isset($options['set_item_status']) ) $props['item_status'] = $options['set_item_status'];

                    QuotationItem::create($props); 
                }
                
            }

            // @todo Check this later
            $itemQty = collect($items)->sum('qty');
            $itemCount = count($items);
            $sub_total = collect($items)->sum('total');

            $hasDiscountPerItem = collect($items)->sum('discount_total') > 0 ? 1 : 0;
            $hasTaxPerItem = collect($items)->sum('additional_tax_total') > 0 ? 1 : 0;

            //dd(collect($items)->sum('discount_total') , collect($items)->sum('additional_tax_total'), $hasTaxPerItem,  $hasDiscountPerItem);
            //dd($quotation->discount_amount, collect($items)->sum('discount_total'));
            $discount_total = $quotation->discount_amount + collect($items)->sum('discount_total');

            $propsToUpdate = [
                'items_qty' => $itemQty,
                'items_count' => $itemCount,
                'sub_total' => $sub_total,
                'discount_total' => $discount_total,
                'has_discount_per_item' => $hasDiscountPerItem,
                'has_tax_per_item' => $hasTaxPerItem,
            ];

            if ( isset($options['set_quotation_status']) ) $propsToUpdate['quotation_status'] = ($options['set_quotation_status']);

            $quotation->updateWithoutEvents($propsToUpdate);
        }
    }

    public function generateUniqueCodeByBranch($quotation)
    {
        $lastQuotation = Quotation::withTrashed()->where('branch_id', $quotation->branch_id)->orderBy('created_at')->get()->last();

        $lastCode = $lastQuotation ? intval($lastQuotation->code) : 1;

        $date = new Carbon();
        $prefix = $date->format('Ym');

        // Check if has the date prefix
        if (strlen((string) $lastCode) > 6) {
            $number = substr((string) $lastCode, 6);
            $number = (int) $number + 1;
            $lastCode = $prefix . $number;
        } else {
            $lastCode = $prefix . $lastCode;
        }

        $verification = Quotation::withTrashed()->where([ 'code' => $lastCode, 'branch_id' => $quotation->branch_id ])->get();

        while ( $verification->count() ) {
            $number = substr((string) $lastCode, 6);
            $number = (int) $number + 1;
            $lastCode = $prefix . $number;
            $verification = Quotation::withTrashed()->where([ 'code' => $lastCode, 'branch_id' => $quotation->branch_id ])->get();
        }

        return $lastCode;
    }
}
