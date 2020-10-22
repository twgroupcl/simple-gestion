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
        $products = Product::where('status','=','1')->with('seller')->with('categories')->limit(6)->get();
        return view('marketplace', compact('products'));
    }

    public function productDetail(Request $request)
    {
        $product = Product::where('url_key', $request->slug)->firstorfail();
        return view('product', compact('product'));
    }

    public function searchProduct(Request $request)
    {
        
    } 
}
