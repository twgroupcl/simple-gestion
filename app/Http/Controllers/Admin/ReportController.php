<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ReportController extends CrudController
{
    public $data = []; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        //$this->data['title'] = trans('backpack::base.reports'); // set the page title

        $sellers = Seller::all();
        $orders = Order::all();
        $products = Product::all();
        $ordersTop = Order::whereIn('status', [2, 3])->with('order_items')->get()->pluck('order_items')->flatten()->pluck('product')->countBy('id')->sortDesc();

        $this->data = array_merge($this->data, [
            'sellers' => [
                'total' => $sellers->count(),
                'approved' => $sellers->where('is_approved', 1)->count(),
                'rejected' => $sellers->where('is_approved', 2)->count()
            ],
            'orders' => [
                'pending' => $orders->where('status', 1)->count(),
                'total' => $orders->count(),
                'paid' => $orders->where('status', 2)->count(),
                'complete' => $orders->where('status', 3)->count(),
                'amount_total' => $orders->whereIn('status', [2, 3])->sum('total')
                
            ],
            'products' => [
                'total' => $products->count(),
                'approved' => $products->where('is_approved', 1)->count(),
                'rejected' => $products->whereNotNull('is_approved')->where('is_approved', 0)->count(),
                'top_10' => $ordersTop->map(function ($value,$key) use ($ordersTop) {
                        $product = Product::find($key);
                        $product->count = $ordersTop[$product->id];
                        return $product;
                    })->take(10)
            ],
        ]);
        return view('backpack::reports.index', ['data' => $this->data]);
    }

    /**
     * Redirect to the dashboard.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        // The '/admin' route is not to be used as a page, because it breaks the menu's active state.
        return redirect(backpack_url('reports'));
    }
}