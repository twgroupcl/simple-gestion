<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SellerStoreRequest;
use App\Models\Seller;

class SellerController extends Controller
{
    public function index()
    {
        if (backpack_user()) {
            return redirect()->route('backpack');
        } else {
            return view('seller.register');
        }
    }

    public function store(SellerStoreRequest $request)
    {
        $sellerAddresses = json_encode([
            [
                'street' => $request['street'],
                'number' => $request['number'],
                'subnumber' => $request['subnumber'] ? $request['subnumber'] : '',
                'commune_id' => $request['commune_id'],
            ]
        ], true);

        $request['addresses_data'] = $sellerAddresses;
        $request['company_id'] = 1;

        Seller::create($request->all());

        return view('seller.register')->with('success', 'Tu solicitud ha sido enviada con éxito. Pronto nos contactaremos contigo.');
    }
}
