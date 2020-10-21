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
        Seller::create($request->all());

        return redirect(backpack_url('login'))->with('success', 'Usted se ha registrado con éxito.');
    }
}
