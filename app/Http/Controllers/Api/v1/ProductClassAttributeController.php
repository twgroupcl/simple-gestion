<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use App\Models\ProductClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductClassAttribute;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Api\ProductClassAttributeRequest;

class ProductClassAttributeController extends Controller
{

    public function showByCode(Request $request)
    {
        $classAttribute = ProductClassAttribute::where('json_attributes->code', $request['code'])->first();

        if (!$classAttribute) return response()->json([ 
            'status' => 'error', 
            'message' => 'No existe ningun atributo con el codigo indicado'
        ],  404);

        
        return response()->json([
            'status' => 'success',
            'data' => $classAttribute,
        ], 200);
    }

    public function store(ProductClassAttributeRequest $request)
    {
        $user = Auth::user();
        $productClass = ProductClass::where('code', $request->class_code)->first();
        $options = $request->type_attribute === 'select' ? json_decode($request->options, true) : null;

        try {
            $attribute = ProductClassAttribute::create([
                'product_class_id' => $productClass->id,
                'json_options' => $options,
                'json_attributes' => [
                    'name' => $request->name,
                    'code' => $request->code,
                    'type_attribute' => $request->type_attribute,
                ],
                'company_id' => $user->companies->first()->id,
            ]);
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json([ 'status' => 'error', 'message' => $exception ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Atributo creado exitosamente',
            'data' => $attribute,
        ], 200);
    }
}