<?php 

namespace App\Services;

use App\Models\Product;

class ProductFilterService {
    
    public function filterByParams($baseQuery, $data) 
    {
        $query = $baseQuery;
        $customAttributes = [];

        // Extract attributes of the request
        foreach($data->all() as $param => $value) {
            // If the param start with "ca-" then is an attribute
            $isAttr = substr($param, 0, 3) == 'ca-';
            if ($isAttr) {
                // The attribute is store as ID => attribute_values
                $customAttributes[str_replace('ca-', '', $param)] = $value;
            }
        }

    
        // Brand Filter
        if ( isset($data['brand']) ) {
            $brands = explode(',', $data['brand']);
            $query = $query->where(function ($q) use ($brands) {
                foreach ($brands as $brandId) {
                    $q->orWhere('product_brand_id', $brandId);
                }
            });
        }

        // Filtro ubicacion
        // @todo


        $queryForSimple = clone $query;
        $queryForConfigurable = clone $query;

         // Price filter
         if ( isset($data['price']) ) {
            $priceRange = explode(',', $data['price']);

            $queryForSimple = $queryForSimple->where('price', '<', $priceRange[1]);
            $queryForSimple = $queryForSimple->where('price', '>', $priceRange[0]);
        }


        // Attributes filter for Simple products
        foreach($customAttributes as $id => $values) {
            $values_array = explode('|', $values);
            $queryForSimple = $queryForSimple->whereHas('custom_attributes', function($q) use ($id, $values_array) {

                // Main where
                $q->where(function ($q2) use ($id, $values_array) {  
 
                    // Add an orWhere for every value of an attribute
                    foreach($values_array as $value) {
                        $q2->orWhere(function ($q3) use ($id, $value) {
                            $q3->where([ 
                                'product_class_attribute_id' => $id,
                                'json_value' => $value,
                            ]);
                        });
                    }
                });
            });
        }


        // Attributes filter for Configurable products
        $queryForConfigurable->whereHas('children', function($query) use ($customAttributes) {
            foreach ($customAttributes as $id => $values) {
                $values_array = explode('|', $values);
                $query->whereHas('custom_attributes', function ($q) use ($id, $values_array) {

                    // Main where
                    $q->where(function ($q2) use ($id, $values_array) {

                        // Add an orWhere for every value of an attribute
                        foreach ($values_array as $value) {
                            $q2->orWhere(function ($q3) use ($id, $value) {
                                $q3->where([
                                            'product_class_attribute_id' => $id,
                                            'json_value' => $value,
                                ]);
                            });
                        }
                    });
                });
            }
        });     


        // Combine results of configurable and simple products
        $queryForSimple->union($queryForConfigurable);

        return $queryForSimple;
    }
}

?>