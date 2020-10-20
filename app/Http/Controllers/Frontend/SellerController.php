<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

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
}
