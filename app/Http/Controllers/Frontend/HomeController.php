<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        //return redirect('/seller/register');
        //return view('vendor');
        return view('customer.order');
    }

    public function productDetail(Request $request)
    {
        $product = Product::where('url_key', $request->slug)->firstorfail();
        return view('product', compact('product'));
    }
}
