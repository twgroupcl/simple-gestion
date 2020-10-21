<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        //return redirect('/seller/register');
        $products = Product::where('status','=','1')->with('seller')->limit(6)->get();
        return view('marketplace', compact('products'));
    }
}
