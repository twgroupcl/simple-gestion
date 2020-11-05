<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class CustomerController extends Controller
{
    public function show(Request $request)
    {
        $customer = Customer::find($request['id']);

        if (!$customer) return response()->json([ 
            'status' => 'error', 
            'message' => 'El customer no existe',
        ],  404);

        return response()->json([
            'status' => 'success',
            'data' => $customer,
        ], 200);
    }
}
