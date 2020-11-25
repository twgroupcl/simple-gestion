<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Support\Str;
use App\Models\ProductBrand;
use App\Models\ProductClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Validator;

class ProductClassController extends Controller
{
    
    public function store(Request $request) {

        $user = Auth::user();

        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'category_id' => 'exists:product_categories,id',
            'status' => 'boolean',
        ]);
      
        if ($validator->fails()) {
          return response()->json([
              'status' => 'error',
              'message' => $validator->errors(),
          ], 400);
        }
        
        try {
            $productClass  = ProductClass::create([
                'name' => $request['name'],
                'category_id' => $request['category_id'],
                'status' => $request['status'] ?? 1,
                'company_id' => $user->companies->first()->id,
            ]);

        } catch(\Illuminate\Database\QueryException $exception) {
            return response()->json([ 'status' => 'error', 'message' => $exception ], 400);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $productClass,
            'message' => 'Clase de producto creada exitosamente',
        ], 200);
    }

    public function show(Request $request)
    {
        $productClass = ProductClass::find($request['id']);

        if (!$productClass) return response()->json([ 
            'status' => 'error', 
            'message' => 'La clase de producto no existe'
        ],  404);

        
        return response()->json([
            'status' => 'success',
            'data' => $productClass,
        ], 200);
    }

    public function all(Request $request)
    {
        $productClasses = productClass::all();

        return response()->json([
            'status' => 'success',
            'data' => $productClasses,
        ], 200);
    }
}