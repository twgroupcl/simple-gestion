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
            'description' => 'required',
            'code' => 'required|unique:product_categories,code',
            'slug' => new SlugRule(),
            'position' => 'numeric',
            'parent_id' => 'exists:product_categories,id',
            'status' => 'boolean',

        ]);
      
        if ($validator->fails()) {
          return response()->json([ 'status' => 'error', 'message' => $validator->errors() ], 400);
        }

        $slug = isset($request['slug']) 
                    ? $request['slug'] 
                    : Str::slug($request['name']);
        
        try {
            $productCategory  = ProductCategory::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'slug' => $slug,
                'code' => $request['code'],
                'position' => $request['position'] ?? 0,
                'icon' => $request['icon'],
                'json_value' => $request['custom_attributes'],
                'parent_id' => $request['parent_id'],
                'status' => $request['status'] ?? 1,
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

    public function showByCode(Request $request)
    {
        $productCategory = ProductCategory::where('code', $request['code'])->first();

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

    public function delete(Request $request)
    {
        $productCategory = ProductCategory::where('code', $request['code'])->first();

        if (!$productCategory) return response()->json([ 
            'status' => 'error', 
            'message' => 'La categoria indicada no existe'
        ],  404);

        try {
            $productCategory->forceDelete();
        } catch (\Exception $e) {
            return response()->json([ 
                'status' => 'error', 
                'message' => 'Ocurrio un error intentando eliminar la categoria. Posiblemente la categoria este siendo usada',
                'error_message' => $e->getMessage(),
            ],  404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Categoria elminada',
            'data' => $productCategory,
        ], 200);
    }
}