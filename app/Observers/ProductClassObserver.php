<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductClass;

class ProductClassObserver
{

    /**
     * Handle the product class "deleting" event.
     *
     * @param  \App\ProductClass  $productClass
     * @return void
     */
    public function deleting(ProductClass $productClass)
    {
        $productsWithClass = Product::where('product_class_id', $productClass->id)->get();

        if ($productsWithClass->count()) {
            abort(401, 'No puedes eliminar una clase que esta siendo utilizada por un producto');
        }
    }


    /**
     * Handle the product class "created" event.
     *
     * @param  \App\ProductClass  $productClass
     * @return void
     */
    public function created(ProductClass $productClass)
    {
        //
    }

    /**
     * Handle the product class "updated" event.
     *
     * @param  \App\ProductClass  $productClass
     * @return void
     */
    public function updated(ProductClass $productClass)
    {
        //
    }

    /**
     * Handle the product class "deleted" event.
     *
     * @param  \App\ProductClass  $productClass
     * @return void
     */
    public function deleted(ProductClass $productClass)
    {
        //
    }

    /**
     * Handle the product class "restored" event.
     *
     * @param  \App\ProductClass  $productClass
     * @return void
     */
    public function restored(ProductClass $productClass)
    {
        //
    }

    /**
     * Handle the product class "force deleted" event.
     *
     * @param  \App\ProductClass  $productClass
     * @return void
     */
    public function forceDeleted(ProductClass $productClass)
    {
        //
    }
}
