<?php 

namespace App\Services;

use App\Models\Product;

class ProductFilterService {
    
    public function filterByParams($data) {

        $query = Product::query();

        // Category filter
        /* $query = $query->whereHas('categories', function($q) {
            return $q->where('id', 1);
        }); */

        // Price filter
        if ( isset($data['price']) ) {
            $priceRange = explode(',', $data['price']);

            $query = $query->where('price', '<', $priceRange[1]);

            $query = $query->where('price', '>', $priceRange[0]);
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

        // Filter by every attribute
        foreach($customAttributes as $id => $values) {
            
            // Separate mulitples values into an array
            $values_array = explode('|', $values);
            $query = $query->whereHas('custom_attributes', function($q) use ($id, $values_array) {
                
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

       // dd($query->toSql(), $query->getBindings());
       // dd($query->toSql());

        return $query;
    }
}

?>