<?php 

namespace App\Services;

use App\Models\Product;

class ProductService
{

    public function validateUniqueSku($sku, $sellerId, $companyId)
    {
        $productsSku = Product::where([
            'seller_id' => $sellerId,
            'company_id' => $companyId,
        ])->pluck('sku')->toArray();

        if ( in_array($sku, $productsSku) ) return false;

        return true;
    }

    public function validateUniqueSlug($slug, $companyId)
    {
        $urlKeysArray = Product::where([
            'company_id' => $companyId,
        ])->pluck('url_key')->toArray();

        if ( in_array($slug, $urlKeysArray) ) return false;

        return true;
    }

}