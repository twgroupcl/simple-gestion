<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
            ]
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