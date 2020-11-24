<?php 

namespace App\Services;

use App\Models\Product;

class ProductFilterService {

    public function filterByParams($baseQuery, $data) 
    {
        if (!$data) return $baseQuery;

        $query = $baseQuery;
        $customAttributes = [];

        // Brand Filter
        if ( isset($data['brand']) ) {
            $brands = $data['brand'];
            $query->where(function ($q) use ($brands) {
                foreach ($brands as $brandId) {
                    if (!$brandId) continue;
                    $q->orWhere('product_brand_id', $brandId);
                }
            });
        }

        $queryForSimple = clone $query;
        $queryForConfigurable = clone $query;

         // Price range filter
         if ( isset($data['price']) ) {
            $priceRange = $data['price'];
            if ( isset($priceRange['min']) && $priceRange['min']) $queryForSimple->having('current_price', '>=', $priceRange['min']);
            if ( isset($priceRange['max']) && $priceRange['max']) $queryForSimple->having('current_price', '<=', $priceRange['max']);
        }

        if (isset($data['attributes'])) {
            $customAttributes = $this->sanitizeAttributesOptions($data['attributes']);
        } 

        // Attributes filter for Simple products
        foreach ($customAttributes as $id => $values_array) {
            $queryForSimple = $queryForSimple->whereHas('custom_attributes', function ($q) use ($id, $values_array) {
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


        // Attributes filter for Configurable products
        $queryForConfigurable->whereHas('children', function ($query) use ($customAttributes) {
            foreach ($customAttributes as $id => $values_array) {
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


    /**
     * Check for false values on every attribute array. Remove false values and if
     * every value of the attribute array if false, remove the attribute
     * 
     */
    public function sanitizeAttributesOptions($attributes)
    {
        foreach($attributes as $key => &$attribute) {
            $attribute = array_filter($attribute);
            if ( empty($attribute) ) unset($attributes[$key]);
        }

        return $attributes;
    }
}

?>