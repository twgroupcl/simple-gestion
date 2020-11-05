<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\CustomerRequest;

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

    public function store(CustomerRequest $request)
    {

        try {
            $customer = Customer::create([
                'uid' => $request['uid'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'phone' => $request['telephone'],
                'cellphone' => $request['cellphone'],
                'password' => null, // ?????
                'is_company' => $request['taxable'],
                'notes' => $request['notes'],
                'status' => $request['status'] ?? 1,
                'customer_segment_id' => null, // ????
                'company_id' => auth()->user()->companies()->first()->id,
            ]);

        } catch(QueryException $exception) {
            
            return response()->json([ 
                    'status' => 'error', 
                    'message' => $exception 
                ], 400);
        }

        return response()->json([
            'status' => 'success',
            'data' => $customer,
        ], 200);
        
    }
}
