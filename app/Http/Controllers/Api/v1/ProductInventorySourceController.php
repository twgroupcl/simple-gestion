<?php

namespace App\Http\Controllers\Api\v1;

use App\User;
use App\Models\Branch;
use App\Models\Seller;
use Illuminate\Http\Request;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Support\Facades\DB;
use App\Models\ProductInventorySource;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\ProductInventorySourceRequest;

class ProductInventorySourceController extends Controller
{

    public function store(ProductInventorySourceRequest $request)
    {

        $error = false;
        $errorMessage = '';
        
        try {

            DB::beginTransaction();

            $productInventorySource = ProductInventorySource::create([
                'code' => $request['code'],
                'name' => $request['name'],
                'description' => $request['description'],
                'commune_id' => $request['commune_id'],
                'address_street' => $request['street'],
                'address_number' => $request['number'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'contact_first_name' => $request['contact_name'], // La request no manda un last name
                'contact_email' => $request['contact_email'],
                'contact_phone' => $request['contact_number'],
                'json_value' => $request['custom_attributes'],
                'company_id' => auth()->user()->companies->first()->id,
            ]);

            $seller = Seller::create([
                'uid' => Rut::set(rand(1000000, 25000000))->fix()->format(Rut::FORMAT_WITH_DASH),
                'email' => $request['contact_email'],
                'visible_name' => $request['name'],
                'name' => $request['contact_name'],
                'seller_category_id' => 1,
                'password' => $request['code'],
                'status' => $request['status'] ?? 1,
                'company_id' => auth()->user()->companies->first()->id,
                'is_approved' => 1,
            ]);

            // Create branch
            $branch = Branch::create([
                'name' => $request['name'],
                'address' => $request['street'] . ' ' . $request['number'],
                'unique_hash' => uniqid(),
            ]);

            $branch->companies()->attach(auth()->user()->companies->first()->id);

            // Asign user to branch
            User::where('email', $request['contact_email'])->first()->branches()->attach($branch->id);

            // Asing branch to warehouse
            $productInventorySource->branch_id = $branch->id;
            $productInventorySource->update();

           DB::commit();

        } catch(\Illuminate\Database\QueryException $exception) {
            DB::rollBack();
            $error = true;
            $errorMessage = $exception;
        }

        if ($error) return response()->json([ 'status' => 'error', 'message' => $errorMessage ], 400);

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

    public function showByCode(Request $request)
    {
        $productInventorySource = ProductInventorySource::where('code', $request['code'])->first();

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
