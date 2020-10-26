<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return redirect('/seller/register');
        //$products = Product::where('status','=','1')->where('parent_id','=', null)->with('seller')->with('categories')->orderBy('id','DESC')->limit(6)->get();
        //return view('marketplace', compact('products'));
    }

    public function getAllProducts()
    {
        $products = Product::where('status','=','1')->with('seller')->with('categories')->orderBy('id','DESC')->get();
        return view('shop-grid', compact('products'));
    }

    public function productDetail(Request $request)
    {
        $product = Product::where('url_key', $request->slug)->firstorfail();
        return view('product', compact('product'));
    }

    public function searchProduct(Request $request)
    {
        $products = Product::where('status','=','1')->where('name','LIKE','%'.$request->product.'%')->get();
        return view('shop-grid', compact('products'));
    }

    public function getProductsByCategory(Request $request){
        $category = ProductCategory::where('id','=',$request->category)->with('products')->first();
        $products = ($category)?$category->products:'';
        return view('shop-grid',compact('products'));
    }

    public function getSeller(Request $request){
        $seller         = Seller::where('id','=',$request->id)->with('seller_category')->with('company')->first();
        $products       = Product::where('seller_id','=',$request->id)->get();
        $user           = User::where('id','=',$seller->user_id)->first();
        $countProduct   = Product::where('seller_id','=',$request->id)->where('parent_id','=',null)->get()->count();
        return view('vendor',compact('seller','products','countProduct','user'));
    }


}
