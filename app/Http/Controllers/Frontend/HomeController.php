<?php

namespace App\Http\Controllers\Frontend;

use App\User;
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
        return redirect('/seller/register');
        //$products = Product::where('status', '=', '1')->where('is_approved', '=', '1')->where('parent_id', '=', null)->with('seller')->with('categories')->orderBy('id', 'DESC')->limit(6)->get();
        //return view('marketplace', compact('products'));
    }

    public function getAllProducts()
    {
        $products = Product::where('status', '=', '1')->where('is_approved', '=', '1')->where('parent_id', '=', null)->with('seller')->with('categories')->orderBy('id', 'DESC')->get();
        return view('shop-grid', compact('products'));
    }

    public function productDetail(Request $request)
    {
        $product = Product::where('url_key', $request->slug)->firstorfail();
        return view('product', compact('product'));
    }

    public function searchProduct(Request $request)
    {
        $idCategory = $request->category;
        if ($idCategory != 0) {
            $products = Product::where('status', '=', '1')->where('is_approved', '=', '1')->where('parent_id', '=', null)->where('name', 'LIKE', '%' . $request->product . '%')->whereHas('categories', function ($query) use ($idCategory) {
                return $query->where('product_category_id', '=', $idCategory);
            })->paginate(12);
        } else {
            $products = Product::where('status', '=', '1')->where('is_approved', '=', '1')->where('parent_id', '=', null)->where('name', 'LIKE', '%' . $request->product . '%')->with('categories')->paginate(12);
        }
        return view('shop-grid', compact('products'));
    }

    public function getProductsByCategory(Request $request)
    {
        if ($request->category == 0) {
            $category = false;
            $products = Product::where('status', '=', '1')->where('is_approved', '=', '1')->where('parent_id', '=', null)->with('categories')->paginate(12);
        } else {
            $category = ProductCategory::where('id', '=', $request->category)->with('products')->first();
        }
        $products = ($category) ? $category->products : $products;

        return view('shop-grid', compact('products'));
    }

    public function getSeller(Request $request)
    {
        $seller         = Seller::where('id', '=', $request->id)->with('seller_category')->with('company')->first();
        $products       = Product::where('seller_id', '=', $request->id)->where('status', '=', '1')->where('is_approved', '=', '1')->where('parent_id', '=', null)->get();
        $countProduct   = Product::where('seller_id', '=', $request->id)->where('parent_id', '=', null)->where('status', '=', '1')->where('is_approved', '=', '1')->get()->count();
        return view('vendor', compact('seller', 'products', 'countProduct'));
    }

    public function getFaq()
    {
        $faqs = FaqAnswer::where('status', '=', '1')->with('faq_topic')->get();
        $faqTopic = FaqTopic::get();
        return view('faq', compact('faqs', 'faqTopic'));
    }
}
