<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Seller;
use Backpack\CRUD\app\Http\Controllers\BaseController;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SalesReportController extends BaseController
{

    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    public function index()
    {
        $request = request();

        // $period = $this->getPeriod();

        $data = [];
        $subscriptionPlan = null;
        $sellers = Seller::orderBy('visible_name')->get();
        $data = $this->getData($request);
        if ($request->wantsJson()) {
            return json_encode($data);
        } else {
            return view('backpack::reports.index', compact('data', 'subscriptionPlan', 'sellers'));
        }
    }

    private function getPeriod()
    {
        $request = request();

        if ($request->wantsJson()) {
            $from = $request->from ?? today()->subDays(14);
            $to = $request->to ?? today();

        } else {
            $from = today()->subDays(14);
            $to = today();
        }

        return Carbon::parse($from)->daysUntil($to);
    }

    private function getData(Request $request)
    {
        $data = [];
        $period = $this->getPeriod();
        $requestSellerId = -1;
        if (backpack_user()->hasRole('Vendedor marketplace')) {
            $requestSellerId = Seller::where('user_id', backpack_user()->id)->firstOrFail()->id;
        }
        else {
            if (isset($request->seller)) {
                $requestSellerId = $request->seller;
            } else {
                $requestSellerId = -1;
            }
        }

        $sales = null;

        if ($requestSellerId == -1) {

             $sales = Order::whereHas('order_items')->whereBetween(
            'created_at',
            [$period->first()->startOfDay(),
            $period->last()->endOfDay()]
            )->with(['order_items.seller' => function($query){
                $query->groupBy('id');
            }])->get();

        } else {
            $sales = Order::whereHas('order_items'
            , function ($query) use ($requestSellerId) {
                $query->where('seller_id', $requestSellerId);
            }
            )->whereBetween(
                'created_at',
                [$period->first()->startOfDay(),
                    $period->last()->endOfDay()]
            )->with(['order_items.seller' => function($query) use ($requestSellerId){
                $query->where('id',$requestSellerId)->groupBy('id');
            }])->get();
        }




        foreach ($sales as $order) {



            $itemSale = [] ;
            if (isset($order->order_items)) {
                $sellers = $order->order_items->groupBy('seller_id');
                if ($requestSellerId == -1) {
                    $sellers = $order->order_items->groupBy('seller_id'); //collec de items por vendedor

                 }else{
                    $sellers = $order->order_items->where('seller_id',$requestSellerId)->groupBy('seller_id'); //collec de items por vendedor
                 }

                $sellers->map(function ($orderItems) {
                    $totalOrder = 0;
                    $totalCommission = 0;
                    $sellerName = null;
                    foreach ($orderItems as $orderItem) {
                        if (empty($sellerName)) {
                            $sellerName = $orderItem->seller->visible_name;
                        }
                        $totalCommission = ($orderItem->sub_total + $orderItem->shipping_total) * 0.11;
                        $totalOrder += ($orderItem->sub_total + $orderItem->shipping_total);
                    }
                    $orderItems->totalOrder = $totalOrder;
                    $orderItems->totalCommission = $totalCommission;
                    $orderItems->totalFinal = $totalOrder - $totalCommission;
                    $orderItems->sellerName = $sellerName;
                    return $orderItems;
                });


                foreach ($sellers as $sellerId=>$seller) {
                    $itemSale['id'] = $order->id;
                    $itemSale['seller'] = $seller->sellerName;
                    $itemSale['created_at'] = $order->created_at;
                    $itemSale['total'] = $seller->totalOrder;
                    $itemSale['totalCommission'] = $seller->totalCommission;
                    $itemSale['totalFinal'] = $seller->totalFinal;
                    array_push($data, $itemSale);
                }
            }


        }

        return $data;
    }

}
