<?php

namespace App\Services\Shipping;

use App\Models\CommuneShippingMethod;

class VariableShipping {

    public function calculateItemBySeller($itemData, $sellerId, $communeOrigin, $communeDestine)
    {
        // Search for commune specific shipping configuracion
        $shippingConfig = CommuneShippingMethod::where([ 'seller_id' => $sellerId, 'commune_id' => $communeDestine ])->first();

        // Shipping Item Info
        $totalWeight = $itemData['shipping']['totalWeight'];
        $totalPrice = $itemData['shipping']['totalPrice'];

        if (!$shippingConfig) {

            // Search for global shipping configuracion
            $shippingConfig = CommuneShippingMethod::where([ 'seller_id' => $sellerId, 'is_global' => 1 ])->first();
            
            if (!$shippingConfig) {
                return false;
            }
        }
        
        $shippingConfigurationData = json_decode($shippingConfig->shipping_methods['variable'], true)[0];
        $tableRates = json_decode($shippingConfigurationData['table_prices'], true);
        $shippingPrice = null;
        
        foreach ($tableRates as $rate) {

            if ($totalWeight >= $rate['min_weight'] && $totalWeight <= $rate['max_weight']) {

                if ( (isset($rate['max_price']) && strlen($rate['max_price'])) && !empty($rate['max_price']) ) {

                    if ($totalPrice >= $rate['min_price'] && $totalPrice <= $rate['max_price']) {
                        $shippingPrice = $rate['final_price'];
                        break; 
                    }

                } else {
                    $shippingPrice = $rate['final_price'];
                    break;
                }
            }
        }

        if (!$shippingPrice) $shippingPrice = $shippingConfigurationData['fallback_price'];

        return $shippingPrice;
    }
}

?>