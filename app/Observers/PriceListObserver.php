<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\PriceList;
use App\Models\PriceListItem;

class PriceListObserver
{

    public function creating(PriceList $priceList)
    {
        $priceList->user_id = backpack_user()->id;
    }
    /**
     * Handle the price list "created" event.
     *
     * @param  \App\PriceList  $priceList
     * @return void
     */
    public function created(PriceList $priceList)
    {
        $products = Product::select('id', 'price', 'cost')->whereDoesntHave('children')->get();

        $items = [];

        foreach ($products as $product) {
            $priceListItem = new PriceListItem();
            $priceListItem->product_id = $product->id;
            $priceListItem->price = $product->price;
            $priceListItem->cost = $product->cost; 
            
            array_push($items, $priceListItem);
        }

        $priceList->priceListItems()->saveMany($items);
    }

    /**
     * Handle the price list "updated" event.
     *
     * @param  \App\PriceList  $priceList
     * @return void
     */
    public function updated(PriceList $priceList)
    {
        //
    }

    /**
     * Handle the price list "deleted" event.
     *
     * @param  \App\PriceList  $priceList
     * @return void
     */
    public function deleted(PriceList $priceList)
    {
        //
    }

    /**
     * Handle the price list "restored" event.
     *
     * @param  \App\PriceList  $priceList
     * @return void
     */
    public function restored(PriceList $priceList)
    {
        //
    }

    /**
     * Handle the price list "force deleted" event.
     *
     * @param  \App\PriceList  $priceList
     * @return void
     */
    public function forceDeleted(PriceList $priceList)
    {
        //
    }
}
