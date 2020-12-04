<?php

namespace App\Http\Controllers\Api\v1;

use DateTime;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use App\Models\ProductClassAttribute;
use App\Models\ProductInventorySource;
use Illuminate\Database\QueryException;
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
        $productService = new ProductService();

        DB::beginTransaction();

        $result = $productService->createSimpleProduct($request);

        if (!$result['status']) {

            DB::rollBack();

            return response()->json([
                'status' => $result['status_response'],
                'message' => $result['message'],
            ], 400);
        }

        DB::commit();

        return response()->json([
            'status' => $result['status_response'],
            'message' => $result['message'],
            'data' => $result['data'],
        ], 200);
    }

    

}
