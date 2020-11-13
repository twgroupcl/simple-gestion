<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Order;
use App\Models\Plans;
use App\Models\Seller;
use Backpack\CRUD\app\Http\Controllers\BaseController;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;

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


            $period = $this->getPeriod();

            $data = [];
            $subscriptionPlan = null;
            if (backpack_user()->hasRole('Vendedor marketplace')) {
                $seller = Seller::where('user_id', backpack_user()->id)->firstOrFail();
                $sellerId = $seller->id;
                $subscription = json_decode($seller->subscription_data);
                $subscriptionPlan = Plans::where('id', $subscription->plan_id)->first();
                if (!is_null($subscription)) {
                    // $sales = OrderItem::where('seller_id', $sellerId)->get()->groupBy('order_id');

                    $sales = Order::whereHas('order_items', function ($query) use ($sellerId) {
                        $query->where('seller_id', 48);
                    })->whereBetween(
                        'created_at',
                        [$period->first()->startOfDay(),
                            $period->last()->endOfDay()]
                    )->get();
                    foreach ($sales as $order) {

                        // $order = Order::where('id', $orderId)->first();
                        $totalOrder = 0;
                        $totalCommission = 0;

                        foreach ($order->order_items as $orderItem) {
                            if ($orderItem->product->categories[0]->commission) {
                                $commissionsCategory = $orderItem->product->categories[0]->commission;
                                if (!is_null($commissionsCategory)) {
                                    $commisions = json_decode($commissionsCategory);

                                    $currentCommission = array_search($subscription->plan_id, array_column($commisions, 'plan_id'));

                                    $commisionProduct = $commisions[$currentCommission];
                                    if ($commisionProduct) {
                                        $totalCommission = $orderItem->price * $commisionProduct->commission / 100;
                                    }
                                }
                                $totalOrder += $orderItem->sub_total;
                            }
                        }
                        $order->total = $totalOrder;
                        $order->totalCommission = $totalCommission;
                        $order->totalFinal = $totalOrder - $totalCommission;

                        array_push($data, $order);
                    }
                }
            }

            if ($request->wantsJson()) {
                return json_encode($data);
            } else {
                return view('backpack::reports.index', compact('data', 'subscriptionPlan'));
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



}
