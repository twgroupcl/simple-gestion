<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\OrderItem;
use App\Models\Product;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

/**
 * Class MostPurchasedProductsChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MostPurchasedProductsChartController extends ChartController
{
    private array $products;

    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        $labels = [];

        $period = $this->getPeriod();

        foreach ($period as $date) {
            if ($date->isToday()) {
                $labels[] = 'Hoy';
            } else {
                $labels[] = $date->toDateString();
            }
        }

        $this->chart->labels($labels);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/most-purchased-products'));
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    public function data()
    {
        $period = $this->getPeriod();

        $this->products = [];

        $product_items_per_date = OrderItem::search(request()->q)
            ->betweenDates(
                $period->first()->startOfDay(),
                $period->last()->endOfDay()
            )
            ->selectRaw('sum(qty) as quantity, product_id, DATE(created_at) as date')
            ->groupBy('date', 'product_id')
            ->having('quantity', '>', 0)
            ->limit(10)
            ->get();

        $product_ids = $product_items_per_date->unique('product_id')->pluck('product_id');

        foreach ($product_ids as $product_id) {
            foreach ($period as $date) {
                $data = $product_items_per_date
                    ->where('date', $date->format('Y-m-d'))
                    ->where('product_id', $product_id)
                    ->first();

                $this->products[$product_id][] = filled($data) ? (int) $data->quantity : 0;
            }
        }
        $product_descriptions = Product::findMany($product_ids);

        foreach ($product_descriptions as $product) {
            $this->chart->dataset($product->name, 'line', $this->products[$product->id])
                ->color('rgb(66, 186, 150)')
                ->backgroundColor('rgba('.rand(1,255).', '.rand(1,255).', '.rand(1,255).', 0.4)');
        }
    }

    private function getPeriod()
    {
        $request = request();

        if ($request->wantsJson()) {
            $from = $request->from ?? today()->subDays(6);
            $to = $request->to ?? today();

        } else {
            $from = today()->subDays(6);
            $to = today();
        }

        return Carbon::parse($from)->daysUntil($to);
    }
}