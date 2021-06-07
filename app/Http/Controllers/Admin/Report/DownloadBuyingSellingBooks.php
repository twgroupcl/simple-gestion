<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Requests\ExportBookRequest;
use App\Http\Controllers\Controller;
use App\Services\DTE\DTEService;
use App\Models\Company;

class DownloadBuyingSellingBooks extends Controller
{
    //
    public function index()
    {
        return view('backpack::reports.download_bys_books');
    }

    public function csvBook(ExportBookRequest $request)
    {
        $period = $request->input('period');
        $type = $request->input('type');

        $rut = Company::findOrFail(backpack_user()->current()->company->id)->uid;
        $dteService = new DTEService();
        $response = $dteService->downloadBook($period, $type, $rut);

        if ($response->getStatusCode() == 200) {
            $fileName = 'ventas_' . $period . '.csv';
            $storagePath = \Storage::disk('local')->put('exports/' . $fileName, $response->getBody()->getContents());
            return response()->download(\Storage::disk('local')->path('exports/' . $fileName))->deleteFileAfterSend(true);
        } else {
            \Alert::warning('No se pudo encontrar el documento. RUT: ' . $rut)->flash();
            return back()->withInput();
        }
    }
}
