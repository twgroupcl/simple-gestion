<?php

namespace App\Observers;

use App\Models\CommuneShippingMethod;


class CommuneShippingMethodObserver
{
    /**
     * Handle the commune shipping method "created" event.
     *
     * @param  \App\CommuneShippingMethod  $communeShippingMethod
     * @return void
     */
    public function creating(CommuneShippingMethod $communeShippingMethod)
    {
        $this->validateGlobalCommune($communeShippingMethod);
    }

    /**
     * Handle the commune shipping method "updated" event.
     *
     * @param  \App\CommuneShippingMethod  $communeShippingMethod
     * @return void
     */
    public function updating(CommuneShippingMethod $communeShippingMethod)
    {
        $this->validateGlobalCommune($communeShippingMethod);
    }

    /**
     * Handle the commune shipping method "deleted" event.
     *
     * @param  \App\CommuneShippingMethod  $communeShippingMethod
     * @return void
     */
    public function deleted(CommuneShippingMethod $communeShippingMethod)
    {
        //
    }

    /**
     * Handle the commune shipping method "restored" event.
     *
     * @param  \App\CommuneShippingMethod  $communeShippingMethod
     * @return void
     */
    public function restored(CommuneShippingMethod $communeShippingMethod)
    {
        //
    }

    /**
     * Handle the commune shipping method "force deleted" event.
     *
     * @param  \App\CommuneShippingMethod  $communeShippingMethod
     * @return void
     */
    public function forceDeleted(CommuneShippingMethod $communeShippingMethod)
    {
        //
    }


    private function validateGlobalCommune($communeShippingMethod)
    {
        if ($communeShippingMethod->is_global) {
            $communeShippingMethod->commune_id = null;
        }
    }
}
