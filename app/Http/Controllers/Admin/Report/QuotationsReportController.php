<?php

namespace App\Http\Controllers\Admin\Report;

use Carbon\Carbon;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Backpack\CRUD\app\Http\Controllers\BaseController;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QuotationsReportController extends BaseController
{
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    public function index()
    {

        $columns = [
            '#',
            'Fecha cotización',
            'RUT',
            'Nombre',
            'Estado de cotización',
            'Total',
        ];

        $data = Quotation::all();

        return view('backpack::reports.quotations', compact('columns', 'data'));
    }

    public function loadData(Request $request) {
        $query = Quotation::query()->with('customer');

        if (!empty($request->input('status')) && $request->input('status') != 'all') {
            $query->where('quotation_status', $request->input('status'));
        }

        if (!empty($request->input('from')) && !empty($request->input('to'))) {
            $query->where('quotation_date', '>=', $request->input('from'));
            $query->where('quotation_date', '<=', $request->input('to'));
        }

        // Formatear data
        $result = $query->get();
        $data = [];

        foreach ($result as $item) {
            $quotation_date = new Carbon($item->quotation_date);

            $data[] = [
                'id' => $item->id,
                'quotation_date' => $quotation_date->format('d-m-Y'),
                'uid' => $item->uid,
                'name' => $item->customer->full_name,
                'quotation_status' => $item->quotation_status,
                'total' => '$ ' . number_format($item->total, 0, ',', '.'),
            ];
        }

        return $data;
    }
}
