<?php

namespace App\Services;

use App\Models\CommuneShippingMethod;

class FlatRateShippingService
{

    private $code = 'flat_rate';

    public function calculateItem(CartItem $item, $iddestineCommune)
    {

    }


    public function calculateItemBySeller($itemShipping, $sellerId, $communeOrigin, $communeDestine)
    {   

        // Search for method commune
        $shippingConfig = CommuneShippingMethod::where([ 'seller_id' => $sellerId, 'commune_id' => $communeDestine ])->first();

        if (!$shippingConfig) {
            
            // If not found, search by Global config
            $shippingConfig = CommuneShippingMethod::where([ 'seller_id' => $sellerId, 'is_global' => 1 ])->first();

            if (!$shippingConfig) {
                
                // Return error, this shipping method is not configure for this destiny commune
                return [
                    'is_available' => false,
                    'message' => 'error', 
                ];
            }

        }

        if (empty($shippingConfig->shippin_methods[$this->code])) {
            // Return error, something happen, the shipping method is corrupet
            return [
                'is_available' => false,
                'message' => 'error', 
            ];
        }

        // Get the flat rate
        // @todo la cantidad del item deberia tomarse en cuenta?
        $shippingPriceTotal = $shippingConfig->shippin_methods[$this->$code]->price;

        return [
            'is_available' => true,
            'shipping_total_price' => $shippingConfig,
            'message' => 'ok'
        ];

    }
}

?>