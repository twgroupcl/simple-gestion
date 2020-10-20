<?php

namespace App\Observers;

use App\Models\ProductClassAttribute;

class ProductClassAttributeObserver
{
    /**
     * Handle the product class attribute "created" event.
     *
     * @param  \App\ProductClassAttribute  $productClassAttribute
     * @return void
     */
    public function created(ProductClassAttribute $productClassAttribute)
    {
        $productClassAttribute->removeEmptyOptions();
        $productClassAttribute->update(); 
    }

    /**
     * Handle the product class attribute "updated" event.
     *
     * @param  \App\ProductClassAttribute  $productClassAttribute
     * @return void
     */
    public function updating(ProductClassAttribute $productClassAttribute)
    {
        $productClassAttribute->removeEmptyOptions();
    }

    /**
     * Handle the product class attribute "deleted" event.
     *
     * @param  \App\ProductClassAttribute  $productClassAttribute
     * @return void
     */
    public function deleted(ProductClassAttribute $productClassAttribute)
    {
        //
    }

    /**
     * Handle the product class attribute "restored" event.
     *
     * @param  \App\ProductClassAttribute  $productClassAttribute
     * @return void
     */
    public function restored(ProductClassAttribute $productClassAttribute)
    {
        //
    }

    /**
     * Handle the product class attribute "force deleted" event.
     *
     * @param  \App\ProductClassAttribute  $productClassAttribute
     * @return void
     */
    public function forceDeleted(ProductClassAttribute $productClassAttribute)
    {
        //
    }
}
