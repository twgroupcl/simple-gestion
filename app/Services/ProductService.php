<?php 

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductClassAttribute;
use App\Models\ProductInventorySource;
use Illuminate\Database\QueryException;

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

    public function createSimpleProduct($request)
    {   

        $warehouses = json_decode($request['warehouse']);
        $companyId = auth()->user()->companies->first()->id;
        $products = []; 

        // Crear un producto por cada bodega
        foreach ($warehouses as $warehouse) {
    
            $warehouseData = ProductInventorySource::where('code', $warehouse->code)->first();

            // Obtener seller id
            $sellerInfo = $this->getSellerIdFromWarehouse($warehouse->code);

            if ( ! $sellerInfo['status'] ) {
                return [ 'status' => false, 'message' =>  $sellerInfo['message'], 'status_response' => 'error'];
            }

            $sellerId = $sellerInfo['sellerId'];

            // Validate SKU
            if ( ! $this->validateUniqueSku($request['sku'], $sellerId, $companyId) ) {
                return [ 'status' => false, 'message' =>  'Ya tienes un producto con el SKU indicado', 'status_response' => 'error'];

            }

            // Validate Url key
            $baseUrlKey = $request['url_key'] ?? Str::slug($request['name']);
            $finalUrlKey = $baseUrlKey;
            $counter = 0;

            // If the Url key already exits, we added a suffix
            while ( !$this->validateUniqueSlug($finalUrlKey, $companyId) && $counter < 20) {
                $counter++;
                $finalUrlKey = $baseUrlKey . '-' . $counter;
            }

            if ($counter == 20) {
                return [ 'status' => false, 'message' =>  'Ha ocurrido un error con el url_key', 'status_response' => 'error'];
            }
            
            // Set default currency
            $currencyId = 63;

            // Custom attributes
            if ($request['custom_attributes']) {

                $attributes_json = json_decode($request['custom_attributes']);
                $attributes = [];

                foreach ($attributes_json as $attributeData) {
                    $attribute = ProductClassAttribute::where([
                        'json_attributes->code' => $attributeData->code,
                        'product_class_id' => $request['product_class_id'],
                    ])->first();

                    if (!$attribute) {
                        return [ 'status' => false, 'message' =>  'El atributo ' . $attributeData->code . ' no existe o es invalido', 'status_response' => 'error'];
                    }

                    $attributes['attribute-' . $attribute->id] = $attributeData->value;
                }
            }

            // Save inventories
            $inventories = [];
            $inventories['inventory-source-'.$warehouseData->id] = $warehouse->stock;
            
            try {

                // Base Propierties
                $product  = Product::create([
                    'name' => $request['name'],
                    'sku' => $request['sku'],
                    'url_key' => $finalUrlKey,
                    'is_service' => $request['is_service'],
                    'use_inventory_control' => $request['use_inventory_control'],
                    'short_description' => $request['short_description'],
                    'description' =>  $request['description'],
                    'price' => $warehouse->price,
                    
                    'product_type_id' => $request['product_type_id'],
                    'product_class_id' => $request['product_class_id'],
                    'prduct_brand_id' => $request['product_brand_id'],
                    
                    //'special_price' => $request['special_price'],
                    //'special_price_from' => isset($request['special_price_from']) ? new DateTime($request['special_price_from']) : null,
                    //'special_price_to' => isset($request['special_price_to']) ? new DateTime($request['special_price_to']) : null,

                    'currency_id' => $currencyId,

                    'weight' => $request['is_service'] ? null : $request['weight'],
                    'height' => $request['is_service'] ? null : $request['height'],
                    'width' => $request['is_service'] ? null : $request['width'],
                    'depth' => $request['is_service'] ? null : $request['depth'],

                    'new' => $request['new'],
                    'featured' => $request['featured'],
                    'visible' => $request['visible'],
                    'visible_from' => $request['visible_from'],
                    'visible_to' => $request['visible_to'],

                    'meta_title' => $request['meta_title'],
                    'meta_keywords' => $request['meta_keywords'],
                    'meta_description' => $request['meta_description'],
                    
                    'status' => $request['status'] ?? 1,
                    'seller_id' => $sellerId,
                    'company_id' => $companyId,
                ]);

            } catch(QueryException $exception) {
                return [ 'status' => false, 'message' =>  $exception, 'status_response' => 'error'];
            }

            // Save categories
            $product->categories()->attach($request['categories']);

            if ( $request->file('images') ) {
                $imagesArray = [];

                // Convert image to base64. Product observer will upload to the server
                foreach ($request->file('images') as $image) {
                    array_push($imagesArray, ['image' => 'data:image/jpeg;base64,' . base64_encode(file_get_contents($image))]);
                }
                $product->images_json = $imagesArray;
            }

            // Save attributes and inventories
            $product->attributes_json = isset($request['custom_attributes']) ? $attributes : null; 
            $product->inventories_json = $inventories;

            // Update product
            $product->update();
            $products[] = $product;
        }

        return [ 'status' => true, 'message' =>  'Productos creados exitosamente', 'status_response' => 'success', 'data' => $products];
    }

    private function getSellerIdFromWarehouse($warehouseCode)
    {

        $warehouse = ProductInventorySource::where('code', $warehouseCode)->first();
        if (!$warehouse) return [ 'status' => false, 'message' => 'El codigo de la bodega (' . $warehouseCode . ') no existe'];

        $seller = $warehouse->branch->users->first()->seller;
        if (!$seller) return [ 'status' => false, 'message' => 'El codigo de la bodega (' . $warehouseCode . ') no tiene asociado un vendedor'];

        return [ 'sellerId' =>  $seller->id, 'status' => true];
    }

}