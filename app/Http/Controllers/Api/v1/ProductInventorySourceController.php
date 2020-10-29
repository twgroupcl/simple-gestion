<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Models\ProductInventorySource;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\ProductInventorySourceRequest;

class ProductInventorySourceController extends Controller
{

    public function store(ProductInventorySourceRequest $request)
    {

        try {
            $productInventorySource = ProductInventorySource::create([
                'code' => $request['code'],
                'name' => $request['name'],
                'description' => $request['description'],
                'commune_id' => $request['city_id'],
                'address_street' => $request['street'],
                'address_number' => $request['number'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'contact_first_name' => $request['contact_name'], // La request no manda un last name
                'contact_email' => $request['contact_email'],
                'contact_phone' => $request['contact_number'],
                'company_id' => auth()->user()->companies->first()->id,

                //'region_id' => $request['region_id'], No existe en db
                //'custom_attributes' => $request['custom_attributes'], No existe en db
            ]);
        } catch(\Illuminate\Database\QueryException $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception,
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Warehouse creado exitosamente',
            'data' => $productInventorySource,
        ], 200);
    }


    public function show(Request $request)
    {
        $productInventorySource = ProductInventorySource::find($request['id']);

        if (!$productInventorySource) return response()->json([ 
            'status' => 'error', 
            'message' => 'El warehouse indicado no existe'
        ],  404);

        
        return response()->json([
            'status' => 'success',
            'data' => $productInventorySource,
        ], 200);
    }
}
