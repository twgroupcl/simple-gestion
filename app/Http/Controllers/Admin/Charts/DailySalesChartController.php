<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\Order;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

/**
 * Class DailySalesChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DailySalesChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels(['Hace 6 días', 'Hace 5 días', 'Hace 4 días', 'Hace 3 días', 'Hace 2 días', 'Ayer', 'Hoy']);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/daily-sales'));

        // OPTIONAL
        $this->chart->minimalist(false);
        $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    public function data()
    {
        $sales['today'] = Order::search()->whereDate('created_at', today()->subDays(6))->count();
        $sales['yesterday'] = Order::search()->whereDate('created_at', today()->subDays(5))->count();
        $sales['2_days_ago'] = Order::search()->whereDate('created_at', today()->subDays(4))->count();
        $sales['3_days_ago'] = Order::search()->whereDate('created_at', today()->subDays(3))->count();
        $sales['4_days_ago'] = Order::search()->whereDate('created_at', today()->subDays(2))->count();
        $sales['5_days_ago'] = Order::search()->whereDate('created_at', today()->subDays(1))->count();
        $sales['6_days_ago'] = Order::search()->whereDate('created_at', today())->count();

        $this->chart->dataset('Ventas por día', 'bar',
            array_values($sales)
        )->color('rgb(66, 186, 150, 1)')
            ->backgroundColor('rgb(66, 186, 150, 0.4)');
    }
}