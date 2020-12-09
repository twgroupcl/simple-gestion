<?php

namespace App\Services\Shipping;

use App\Models\CommuneShippingMethod;

class FlatRateShipping {

    public function calculateItemBySeller($itemData, $sellerId, $communeOrigin, $communeDestine)
    {
        // Search for commune specific shipping configuracion
        $shippingConfig = CommuneShippingMethod::where([ 'seller_id' => $sellerId, 'commune_id' => $communeDestine ])->first();

        if (!$shippingConfig) {

            // Search for global shipping configuracion
            $shippingConfig = CommuneShippingMethod::where([ 'seller_id' => $sellerId, 'is_global' => 1 ])->first();
            
            if (!$shippingConfig) {
                return false;
            }
        }
        
        $flatRateShippingData = json_decode($shippingConfig->shipping_methods['flat_rate'], true)[0];
        
        return sanitizeNumber($flatRateShippingData['price']);
    }
}

?>