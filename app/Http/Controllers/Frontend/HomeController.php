<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status','=','1')->where('parent_id','=', null)->with('seller')->with('categories')->orderBy('id','DESC')->limit(6)->get();
        return view('marketplace', compact('products'));
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
}
