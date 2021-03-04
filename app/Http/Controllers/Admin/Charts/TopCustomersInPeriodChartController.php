<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

/**
 * Class TopCustomersInPeriodChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TopCustomersInPeriodChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        //$this->chart->labels([
        //    '1', '2', '3', '4', '5', '6', '7', '8', '9'
        //]);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/top-customers-in-period'));

        // OPTIONAL
        // $this->chart->minimalist(false);
        // $this->chart->displayLegend(true);
    }

    /**
    * Respond to AJAX calls with all the chart data points.
    *
    * @return json
    */
    public function data()
    {
        //$users_created_today = \App\Models\Customer::with('invoices')->get()
        //->map(function ($customer) {
        //    $customer->total = $customer->invoices->sum('total');
        //    return $customer;
        //})->sortBy(['total', 'DESC'])->take(10);
        $request = request();
        $fromDate = $request->from ?? null; 
        $toDate = $request->to ?? null; 
        //$customersTotal = \App\Models\Invoice::query();
        //if (isset($fromDate)) {
        //    $customersTotal = $customersTotal->where('invoice_date', '>=', $fromDate);
        //}

        //if (isset($toDate)) {
        //    $customersTotal = $customersTotal->where('invoice_date', '<=', $toDate);
        //    debug("reducir");
        //}
        
        //$customersTotal = $customersTotal->with('customer')
        //    ->select('customer_id',\DB::raw('SUM(total) as total_invoices'))
        //    ->groupBy('customer_id')->orderBy('total_invoices', 'DESC')
        //    ->get()->pluck('total_invoices', 'customer_id')->take(10);
        $customers = \App\Models\Customer::whereHas('invoices', 
            function($query) use($fromDate, $toDate) {
                if (isset($fromDate)) {
                    $query->where('invoice_date', '>=', $fromDate);
                }

                if (isset($toDate)) {
                    $query->where('invoice_date', '<=', $toDate);
                }
            }
        )->withCount('invoices')->get()->map(function ($customer) {
            $customer->buy_total = $customer->invoices->sum('total');
            $customer->full_name = $customer->full_name;
            return $customer;

        })->sortByDesc('buy_total')
          ->pluck('buy_total', 'full_name')
          ->take(10);


        foreach ($customers as $customerId => $total) {
            //$customerName = \App\Models\Customer::find($customerId)->first_name;
            $this->chart->dataset($customerId, 'bar', [$total])
                 ->color('rgba(205, 32, 31, 1)')
                 ->backgroundColor(
                     'rgba('.rand(1,255).', '.rand(1,255).', '.rand(1,255).', 0.4)'
                 );
        }
       
    }
}
