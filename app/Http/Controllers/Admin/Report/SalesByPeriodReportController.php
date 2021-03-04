<?php

namespace App\Http\Controllers\Admin\Report;

use Carbon\Carbon;
use App\Models\Invoice;
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
class SalesByPeriodReportController extends BaseController
{
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    public function index()
    {

        $columns = [
            'Folio',
            'Tipo de Dto.',
            'Fecha',
            'RUT',
            'Nombre cliente',
            'Monto neto',
            'IVA',
            'Total',
        ];

        $data = Invoice::all();

        return view('backpack::reports.salesbyperiod', compact('columns', 'data'));
    }

    public function loadData(Request $request) {
        $fromDate = $request->input('from');
        $toDate = $request->input('to');
        //@TODO filter NC total and NC partials

        $query = Invoice::whereNotNull('folio')->where('invoice_status', Invoice::STATUS_SEND);

        if (!empty($fromDate)) {
            $query->where('invoice_date', '>=', $fromDate);
        }

        if (!empty($toDate)) {
            $query->where('invoice_date', '<=', $toDate);
        }

        $data = $query->with('invoice_type')->get()->map( function ($invoice) {
            $customInvoice = new \stdClass();
            $customInvoice->folio = $invoice->folio;
            $customInvoice->invoice_date = $invoice->invoice_date;
            $customInvoice->type = $invoice->invoice_type->code;
            $customInvoice->net = $invoice->net;
            $customInvoice->tax_amount = $invoice->tax_amount;
            $customInvoice->total = $invoice->total;
            $customInvoice->customer_uid = $invoice->uid;
            $customInvoice->customer_name = $invoice->first_name . ' ' . $invoice->last_name;
            return $customInvoice;
        })->toArray();

        //if (!empty($request->input('status')) && $request->input('status') != 'all') {
        //    $query->where('quotation_status', $request->input('status'));
        //}

        //if (!empty($request->input('from')) && !empty($request->input('to'))) {
        //    $query->where('quotation_date', '>=', $request->input('from'));
        //    $query->where('quotation_date', '<=', $request->input('to'));
        //}

        //// Formatear data
        //$result = $query->get();
        //$data = [];

        //foreach ($result as $item) {
        //    $quotation_date = new Carbon($item->quotation_date);

        //    $data[] = [
        //        'id' => $item->id,
        //        'quotation_date' => $quotation_date->format('d-m-Y'),
        //        'uid' => $item->uid,
        //        'name' => $item->customer->full_name,
        //        'quotation_status' => $item->quotation_status_text,
        //        'total' => '$ ' . number_format($item->total, 0, ',', '.'),
        //    ];
        //}

        return $data;
    }
}
