<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderErrorLog;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Validator;

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

    public function updateStatus(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [ 
            'status' => [
                'required', 
                Rule::in([
                    Order::ORDER_STATUS_AVAILABLE_FOR_PICKUP,
                    Order::ORDER_STATUS_CONFIRMED,
                    Order::ORDER_STATUS_DELIVERED,
                    Order::ORDER_STATUS_DISPATCHED,
                    Order::ORDER_STATUS_IN_PREPARATION,
                    Order::ORDER_STATUS_INVOICED_DOCUMENT,
                ]),
            ],
        ]);
      
        if ($validator->fails()) {
          return response()->json([ 'status' => 'error', 'message' => $validator->errors() ], 400);
        }
        
        $order = Order::find($id);

        if (!$order) return response()->json([ 
            'status' => 'error', 
            'message' => 'La orden solicitada no existe',
        ],  404);

        $order->order_status = $request->status;

        $order->save();

        DB::table('orders_status_history')->insert([
            'order_id' => $order->id,
            'order_status' => $request->status,
            'created_at' =>  now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'data' => null,
            'message' => 'Estado de orden actualizado',
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
        $orderLog = OrderErrorLog::where('order_id', $id);

        if (!$orderLog->count()) return response()->json([ 
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
