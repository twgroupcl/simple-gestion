<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Seller;
use App\Http\Controllers\Controller;
use Backpack\Settings\app\Models\Setting;
use App\Http\Requests\Frontend\SellerStoreRequest;

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
        $request['company_id'] = Setting::get('default_company');

        $request['uid'] = strtoupper(
            str_replace('.', '', $request['uid'])
        );
        $request['password'] = $request['uid'];

        Seller::create($request->all());

        return view('seller.register')->with('success', 'Tu solicitud ha sido enviada con éxito. Pronto nos contactaremos contigo.');
    }
}
