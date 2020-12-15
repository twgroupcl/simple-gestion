<?php 

namespace App\Services;

use DateTime;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductBrand;
use App\Models\ProductClass;
use App\Models\ProductCategory;
use App\Models\ProductClassAttribute;
use App\Models\ProductInventorySource;
use Illuminate\Database\QueryException;

class ProductService
{

    const USE_INVENTORY_CONTROL_BY_DEFAULT = true;
    const MAX_ATTEMPTS_FOR_URL_SLUG = 20;
    const DEFAULT_CURRENCY_ID = 63;

    public function createSimpleProductWithWarehouse($request)
    {
        
        if (self::USE_INVENTORY_CONTROL_BY_DEFAULT) {
            $use_inventory_control = 1;
            $is_service = 0;
        }

    
        $brandId = $request['product_brand_id'];
        if (!$brandId) {
            $brand = ProductBrand::where('code', $request['product_brand_code'])->first();
            $brandId = $brand ? $brand->id : null;
        }

        $classId = $request['product_class_id'];
        if (!$classId) {
            $class = ProductClass::where('code', $request['product_class_code'])->first();
            $classId = $class ? $class->id : null;
        }

        $categoriesId = $request['categories'];
        if (!$categoriesId && $request['categories_code']) {
            $categoriesId = [];
            foreach ($request['categories_code'] as $cat) {
                $category = ProductCategory::where('code', $cat)->first();
                if ($category) $categoriesId[] = $category->id;
            }
        }

        $warehouses = json_decode($request['warehouse']);
        $companyId = auth()->user()->companies->first()->id;
        $products = [];

        $typeId = ( $request['type'] == 'simple') ? Product::PRODUCT_TYPE_SIMPLE : Product::PRODUCT_TYPE_CONFIGURABLE;

        // Validate unique warehouses
        $warehousCodes = collect($warehouses)->pluck('code');

        if ( $warehousCodes->duplicates()->count() ) {
            return [ 'status' => false, 'message' =>  'El codigo de cada bodega debe ser unico', 'status_response' => 'error']; 
        }
    
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
            while ( !$this->validateUniqueSlug($finalUrlKey, $companyId) && $counter < self::MAX_ATTEMPTS_FOR_URL_SLUG) {
                $counter++;
                $finalUrlKey = $baseUrlKey . '-' . $counter;
            }

            if ($counter == self::MAX_ATTEMPTS_FOR_URL_SLUG) {
                return [ 'status' => false, 'message' =>  'Ha ocurrido un error con el url_key', 'status_response' => 'error'];
            }
            
            // Set default currency
            $currencyId = self::DEFAULT_CURRENCY_ID;

            // Custom attributes
            if ($request['extra_attributes']) {

                $attributes_json = json_decode($request['extra_attributes']);
                $attributes = [];

                foreach ($attributes_json as $attributeData) {
                    $attribute = ProductClassAttribute::where([
                        'json_attributes->code' => $attributeData->code,
                        'product_class_id' => $classId,
                    ])->first();
                    
                    // @todo si el atributo es de tipo select, verificar que el value existe entre las opciones
                    if (!$attribute) {
                        return [ 'status' => false, 'message' =>  'El atributo ' . $attributeData->code . ' no existe o es invalido', 'status_response' => 'error'];
                    }

                    $attributes['attribute-' . $attribute->id] = $attributeData->value;
                }
            }

            $inventories = [];
            $inventories['inventory-source-'.$warehouseData->id] = $warehouse->stock;
            
            try {
                // Base Propierties
                $product  = Product::create([
                    'name' => $request['name'],
                    'sku' => $request['sku'],
                    'url_key' => $finalUrlKey,
                    'is_service' => $is_service,
                    'use_inventory_control' => $use_inventory_control,
                    'short_description' => $request['short_description'],
                    'description' =>  $request['description'],
                    'price' => $warehouse->price,
                    
                    'product_type_id' => $typeId,
                    'product_class_id' => $classId,
                    'product_brand_id' => $brandId,
                    
                    'special_price' => $warehouse->special_price ?? null,
                    'special_price_from' => isset($warehouse->special_price_from) ? new DateTime($warehouse->special_price_from) : null,
                    'special_price_to' => isset($warehouse->special_price_to) ? new DateTime($warehouse->special_price_to) : null,

                    'currency_id' => $currencyId,

                    'weight' => $is_service ? null : $request['weight'],
                    'height' => $is_service ? null : $request['height'],
                    'width' => $is_service ? null : $request['width'],
                    'depth' => $is_service ? null : $request['depth'],

                    'new' => $request['new'],
                    'featured' => $request['featured'],
                    'visible' => $request['visible'],
                    'visible_from' => $request['visible_from'],
                    'visible_to' => $request['visible_to'],

                    'meta_title' => $request['meta_title'],
                    'meta_keywords' => $request['meta_keywords'],
                    'meta_description' => $request['meta_description'],

                    'is_approved' => 1,
                    'status' => $request['status'] ?? 1,
                    'seller_id' => $sellerId,
                    'company_id' => $companyId,
                ]);

            } catch(QueryException $exception) {
                return [ 'status' => false, 'message' =>  $exception, 'status_response' => 'error'];
            }

            // Save categories
            $product->categories()->attach($categoriesId);
            
            // Save Shipping Methods
            $product->shipping_methods()->attach($warehouse->shipping_type);

            if ( $request->file('images') ) {
                $imagesArray = [];

                // Convert image to base64. Product observer will upload to the server
                foreach ($request->file('images') as $image) {
                    array_push($imagesArray, ['image' => 'data:image/jpeg;base64,' . base64_encode(file_get_contents($image))]);
                }
                $product->images_json = $imagesArray;
            }

            // Save attributes and inventories
            $product->attributes_json = isset($request['extra_attributes']) ? $attributes : null; 
            $product->inventories_json = $inventories;

            // Update product
            $product->update();
            $products[] = $product;
        }

        return [ 'status' => true, 'message' =>  'Productos creados exitosamente', 'status_response' => 'success', 'data' => $products];
    }

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

    private function getSellerIdFromWarehouse($warehouseCode)
    {

        $warehouse = ProductInventorySource::where('code', $warehouseCode)->first();
        if (!$warehouse) return [ 'status' => false, 'message' => 'El codigo de la bodega (' . $warehouseCode . ') no existe'];

        // @todo the user must have a seller associate
        $seller = $warehouse->branch->users->first()->seller;
        if (!$seller) return [ 'status' => false, 'message' => 'El codigo de la bodega (' . $warehouseCode . ') no tiene asociado un vendedor'];

        return [ 'sellerId' =>  $seller->id, 'status' => true];
    }

}