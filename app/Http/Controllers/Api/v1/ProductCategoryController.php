<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use App\Rules\SlugRule;
use Illuminate\Support\Str;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    public function store(Request $request) {
        
        $user = Auth::user();

        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'slug' => new SlugRule(),
            'code' => 'required',
            'icon' => 'required',
            'parent_id' => 'numeric',

        ]);
      
        if ($validator->fails()) {
          return response()->json([ 'status' => 'error', 'message' => $validator->errors() ], 400);
        }


        $slug = isset($request['slug']) ? $request['slug'] : Str::slug($request['name']);
        
        try {
            $productCategory  = ProductCategory::create([
                'name' => $request['name'],
                'slug' => $slug,
                'code' => $request['code'],
                'icon' => $request['icon'],
                'parent_id' => $request['parent_id'],
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
            'data' => $productCategory,
            'message' => 'Marca de producto creada exitosamente',
        ], 200);

    }

    public function show(Request $request)
    {
        $productCategory = ProductCategory::find($request['id']);

        if (!$productCategory) return response()->json([ 
            'status' => 'error', 
            'message' => 'La categoria indicada no existe'
        ],  404);

        
        return response()->json([
            'status' => 'success',
            'data' => $productCategory,
        ], 200);
    }

    public function all(Request $request)
    {
        $ProductCategories = ProductCategory::all();

        return response()->json([
            'status' => 'success',
            'data' => $ProductCategories,
        ], 200);
    }
}