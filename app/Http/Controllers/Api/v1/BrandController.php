<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Support\Str;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function store(Request $request) {

        $user = Auth::guard('api')->user();

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
                'slug' => Str::slug($request['name']),
                'code' => $request['code'] ?? '',
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
}