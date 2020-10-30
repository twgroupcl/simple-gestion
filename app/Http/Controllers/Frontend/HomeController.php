<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Seller;
use App\Models\Product;
use App\Models\FaqTopic;
use App\Models\FaqAnswer;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        //return redirect('/seller/register');
        return view('marketplace');
    }

    public function getAllProducts()
    {
        $products = Product::where('status','=','1')->where('is_approved','=','1')->where('parent_id','=', null)->with('seller')->with('categories')->orderBy('id','DESC')->get();
        $render = ['view' => ''];
        $data = ['category' => $products];

        return view('shop-grid', compact('products','render','data'));
    }

    public function productDetail(Request $request)
    {
        $product = Product::where('url_key', $request->slug)->firstOrFail();

        return view('product', compact('product'));
    }

    public function searchProduct(Request $request)
    {
        $render = ['view' => 'searchProduct'];
        $data = ['category' => $request->category, 'product' => $request->product];

        return view('shop-grid', compact('render', 'data'));
    }

    public function getProductsByCategory(Request $request)
    {
        $render = ['view' => 'searchCategory'];
        $data = ['category' => $request->category];

        return view('shop-grid', compact('render', 'data'));
    }

    public function getSeller(Request $request)
    {
        $seller = Seller::where('id', '=', $request->id)->with('seller_category')->with('company')->first();
        $products = Product::where('seller_id', '=', $request->id)->where('status', '=', '1')->where('is_approved', '=', '1')->where('parent_id', '=', null)->get();
        $countProduct = Product::where('seller_id', '=', $request->id)->where('parent_id', '=', null)->where('status', '=', '1')->where('is_approved', '=', '1')->get()->count();

        return view('vendor', compact('seller', 'products', 'countProduct'));
    }

    public function getFaq()
    {
        $faqs = FaqAnswer::where('status', '=', '1')->with('faq_topic')->get();
        $faqTopic = FaqTopic::get();

        return view('faq', compact('faqs', 'faqTopic'));
    }
}
