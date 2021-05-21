<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderErrorLog;
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

    public function fetchErrorLogs(Request $request)
    {
        $orderLogs = OrderErrorLog::orderBy('created_at', 'DESC')->get();

        return [
            'status' => 'success',
            'data' => $orderLogs,
        ];

        return $orderLogs;
    }

    public function fetchErrorLog($id)
    {
        $orderLog = OrderErrorLog::where('order_id', $id)->first();

        if (!$orderLog) return response()->json([ 
            'status' => 'error', 
            'message' => 'La orden solicitada no existe',
        ],  404);

        return [
            'status' => 'success',
            'data' => $orderLog,
        ];

        return $orderLogs;
    }
}
