<?php

namespace App\Http\Controllers\Api\v1;

use DateTime;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use App\Models\ProductInventorySource;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\ProductRequest;

class ProductController extends Controller
{
    private $productService;
    
    public function show(Request $request)
    {
        $product = Product::with('categories')->find($request['id']);

        if (!$product) return response()->json([ 
            'status' => 'error', 
            'message' => 'El producto indicado no existe'
        ],  404);
        
        return response()->json([
            'status' => 'success',
            'data' => $product,
        ], 200);
    }


    public function store(ProductRequest $request)
    {   
        $this->productService = new ProductService();

        // Obtener bodegas
        $warehouses = json_decode($request['warehouse']);

        $companyId = auth()->user()->companies->first()->id;

        $products = []; 

       DB::beginTransaction();

        // Crear un producto por cada bodega
        foreach ($warehouses as $warehouse) {
    
            $warehouseData = ProductInventorySource::where('code', $warehouse->code)->first();

            // Obtener seller id
            $sellerInfo = $this->getSellerIdFromWarehouse($warehouse->code);

            if (!$sellerInfo['status']) {
                DB::rollBack();
                return response()->json([ 
                    'status' => 'error', 
                    'message' => $sellerInfo['message'],
                ],  400); 
            }

            $sellerId = $sellerInfo['sellerId'];

            // Validate SKU
            if ( ! $this->productService->validateUniqueSku($request['sku'], $sellerId, $companyId) ) {
                DB::rollBack();
                return response()->json([ 
                    'status' => 'error', 
                    'message' => 'Ya tienes un producto con el SKU indicado'
                ],  400); 
            }

            // Validate Url key
            $baseUrlKey = $request['url_key'] ?? Str::slug($request['name']);
            $finalUrlKey = $baseUrlKey;
            $counter = 0;

            // If the Url key already exits, we added a suffix
            while ( !$this->productService->validateUniqueSlug($finalUrlKey, $companyId) && $counter < 20) {
                $counter++;
                $finalUrlKey = $baseUrlKey . '-' . $counter;
            }

            if ($counter == 20) {
                DB::rollBack();
                return response()->json([ 
                    'status' => 'error', 
                    'message' => 'Ha ocurrido un error con el url_key',
                ],  400); 
            }
            
            // Set default currency
            $currencyId = 63;

            // Validate and save custom attributes
            
            // Validate and save inventories
            $inventories = [];
            $inventories['inventory-source-'.$warehouseData->id] = $warehouse->stock;
            
            // Save the product
            try {

                $product  = Product::create([
                    'name' => $request['name'],
                    'sku' => $request['sku'],
                    'url_key' => $finalUrlKey,
                    'is_service' => $request['is_service'],
                    'use_inventory_control' => $request['use_inventory_control'],
                    'short_description' => $request['short_description'],
                    'description' =>  $request['description'],
                    'product_type_id' => $request['product_type_id'],
                    'product_class_id' => $request['product_class_id'],
                    'prduct_brand_id' => $request['product_brand_id'],
                    'price' => $warehouse->price,
                    
                    //'special_price' => $request['special_price'],
                    //'special_price_from' => isset($request['special_price_from']) ? new DateTime($request['special_price_from']) : null,
                    //'special_price_to' => isset($request['special_price_to']) ? new DateTime($request['special_price_to']) : null,

                    'currency_id' => $currencyId,

                    'weight' => $request['is_service'] ? null : $request['weight'],
                    'height' => $request['is_service'] ? null : $request['height'],
                    'width' => $request['is_service'] ? null : $request['width'],
                    'depth' => $request['is_service'] ? null : $request['depth'],

                    'meta_title' => $request['meta_title'],
                    'meta_keywords' => $request['meta_keywords'],
                    'meta_description' => $request['meta_description'],
                    
                    'status' => $request['status'] ?? 1,
                    'seller_id' => $sellerId,
                    'company_id' => $companyId,
                ]);

            } catch(\Illuminate\Database\QueryException $exception) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => $exception,
                ], 400);
            }

            // Attach categories
            $product->categories()->attach($request['categories']);

            // Convert images to base64 and save it in the images_json field of the product
            // so the product observer can take care of the upload
            if ( $request->file('images') ) {
                $imagesArray = [];
                foreach ($request->file('images') as $image) {
                    array_push($imagesArray, ['image' => 'data:image/jpeg;base64,' . base64_encode(file_get_contents($image))]);
                }
                $product->images_json = $imagesArray;
            }

            // Update inventories and save product
            $product->inventories_json = $inventories;
            $product->update();
            $products[] = $product;
        }

        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'Productos creados correctamente',
            'data' => $products,
        ], 200);

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
