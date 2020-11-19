<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class OrderController extends Controller
{
    public function show(Request $request)
    {
        $order = Order::find($request['id']);

        if (!$order) return response()->json([ 
            'status' => 'error', 
            'message' => 'La orden solicitada no existe',
        ],  404);

        return response()->json([
            'status' => 'success',
            'data' => $order,
        ], 200);
    }
}
