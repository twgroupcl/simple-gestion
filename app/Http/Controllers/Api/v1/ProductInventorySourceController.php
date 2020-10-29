<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Models\ProductInventorySource;
use App\Http\Controllers\Api\Controller;

class ProductInventorySourceController extends Controller
{
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
