<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Support\Str;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductBrandController extends Controller
{
    
    public function store(Request $request) {

        $user = Auth::user();
        

        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
        ]);
      
        if ($validator->fails()) {
          return response()->json([
              'status' => 'error',
              'message' => $validator->errors(),
          ], 400);
        }
        
        try {
            $brand  = ProductBrand::create([
                'name' => $request['name'],
                'slug' => $request['slug'] ?? Str::slug($request['name']),
                'code' => $request['code'],
                'company_id' => $user->companies->first()->id,
            ]);
        } catch(\Illuminate\Database\QueryException $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception,
            ], 400);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $brand,
        ], 200);

    }

    public function show(Request $request)
    {
        $productBrand = ProductBrand::find($request['id']);

        if (!$productBrand) return response()->json([ 
            'status' => 'error', 
            'message' => 'The product brand no exists'
        ],  404);

        
        return response()->json([
            'status' => 'success',
            'data' => $productBrand,
        ], 200);
    }

    public function all(Request $request)
    {
        $productBrands = ProductBrand::all();

        return response()->json([
            'status' => 'success',
            'data' => $productBrands,
        ], 200);
    }
}