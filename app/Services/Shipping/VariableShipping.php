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

            // Sanitaze values
            $rateMinWeight = sanitizeNumber($rate['min_weight']);
            $rateMaxWeight = sanitizeNumber($rate['max_weight']);
            $rateFinalPrice = sanitizeNumber($rate['final_price']);
            $rateFallbackPrice = sanitizeNumber($shippingConfigurationData['fallback_price']);

            if ($totalWeight >= $rateMinWeight && $totalWeight <= $rateMaxWeight) {

                if ( (isset($rate['min_price']) && strlen($rate['min_price'])) && !empty($rate['max_price']) ) {

                    $rateMinPrice = sanitizeNumber($rate['min_price']);
                    $rateMaxPrice = sanitizeNumber($rate['max_price']);

                    if ($totalPrice >= $rateMinPrice && $totalPrice <= $rateMaxPrice) {
                        $shippingPrice = $rateFinalPrice;
                        break; 
                    }

                } else {
                    $shippingPrice = $rateFinalPrice;
                    break;
                }
            }
        }

        if (!$shippingPrice) $shippingPrice = $rateFallbackPrice;

        return $shippingPrice;
    }
}

?>