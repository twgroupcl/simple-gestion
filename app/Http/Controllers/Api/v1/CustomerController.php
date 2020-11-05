<?php

namespace App\Http\Controllers\Api\v1;

use DateTime;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $birthday = new DateTime($request['birthday']);
        $birthday = $birthday->format('d-m-Y');

        $json_value = [
            'prefix' => $request['prefix'],
            'gender' => $request['gender'],
            'birthday' => $birthday,
        ];

        if ($request['custom_attributes']) {
            $json_value= array_merge($json_value, json_decode($request['custom_attributes'], true));
        }

        if ($request['sii_activity']) {
            $activitiesData = [
                [ 'activity_name' => $request['sii_activity'] ],
            ];
        }

        DB::beginTransaction();
        
        try {
            $customer = Customer::create([
                'uid' => $request['uid'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'cellphone' => $request['cellphone'],
                'password' => $request['uid'],
                'is_company' => $request['taxable'],
                'notes' => $request['notes'],
                'extra' => $request['extra'],
                'status' => $request['status'] ?? 1,
                'customer_segment_id' => 1,
                'addresses_data' => $request['addresses'],
                'activities_data' => $activitiesData ?? null,
                'json_value' => $json_value,
                'company_id' => auth()->user()->companies()->first()->id,
            ]);

        } catch(QueryException $exception) {
            
            DB::rollBack();
            return response()->json([ 
                    'status' => 'error', 
                    'message' => $exception 
                ], 400);
        }

        DB::commit();

        return response()->json([
            'status' => 'success',
            'data' => $customer,
        ], 200);
    }
}
