<?php 

namespace App\Services;

use App\Models\Product;

class ProductFilterService {
    
    public function filterByParams($data) {

        $query = Product::query();

        // Category filter
        $query = $query->whereHas('categories', function($q) {
            return $q->where('id', 1);
        });

        // Price filter
        if ( isset($data['price']) ) {
            $priceRange = explode(',', $data['price']);

            $query = $query->where('price', '<', $priceRange[1]);

            $query = $query->where('price', '>', $priceRange[0]);
        }

        // Filtro ubicacion
        // @todo

        // Filtro ordernar por nombre
        // @todo


        // Attribute filter
        $customAttributes = [];

        // Extract attributes of the request
        foreach($data->all() as $param => $value) {
            $isAttr = substr($param, 0, 3) == 'ca-';
            if ($isAttr) {
                $customAttributes[str_replace('ca-', '', $param)] = $value;
            }
        }

        foreach($customAttributes as $id => $value) {
            $query = $query->whereHas('custom_attributes', function($q) use ($id, $value) {
                $q->where([ 
                    'product_class_attribute_id' => $id,
                    'json_value' => $value,
                ]);
            });
        }

        return $query;
    }
}

?>