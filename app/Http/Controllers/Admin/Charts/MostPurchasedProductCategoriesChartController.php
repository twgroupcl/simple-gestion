<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\ProductCategory;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

/**
 * Class MostPurchasedProductCategoriesChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MostPurchasedProductCategoriesChartController extends ChartController
{
    public $period;
    public $names = [];
    public $quantity = [];

    public function setup()
    {
        $this->chart = new Chart();

        $this->period = $this->getPeriod();

        $categories = ProductCategory::with(['products' => function ($query) {
                $query->withCount(['order_items AS quantity' => function ($query) {
                        $query->select(DB::raw("SUM(qty) as quantity"))
                            ->search()
                            ->betweenDates(
                                $this->period->first()->startOfDay(),
                                $this->period->last()->endOfDay()
                            );
                    }
                ]);
            }])
            ->whereHas('products', function ($query) {
                $query->whereHas('order_items');
            })
            ->limit(10)
            ->get();

            $tmp = $categories->map(function ($category) {
                return [
                    'name' => $category->name,
                    'quantity' => $category->products->sum('quantity')];
            });

        $this->names = $tmp->pluck('name')->toArray();
        $this->quantity = $tmp->pluck('quantity')->toArray();


        // OPTIONAL
        $this->chart->displayAxes(false);
        $this->chart->displayLegend(true);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/most-purchased-product-categories'));

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels($this->names);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    public function data()
    {
        $this->chart->dataset(implode(";", $this->names), 'pie', $this->quantity)
                    ->backgroundColor([
                        'rgb(70, 127, 208)',
                        'rgb(77, 189, 116)',
                        'rgb(96, 92, 168)',
                        'rgb(255, 193, 7)',
                    ]);
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