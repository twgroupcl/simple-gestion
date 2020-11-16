<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InvoiceRequest;
use Illuminate\Http\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\{Invoice, InvoiceType, CustomerAddress};
use App\Services\DTE\DTEService;
/**
 * Class InvoiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ManageInvoiceCrudController extends CrudController
{
    public function index(Invoice $invoice)
    {
        return view('invoice.manage_invoice.index', compact('invoice'));
    }

    public function sendTemporaryDocument(Request $request, Invoice $invoice)
    {
        $service = new DTEService();
        $response = $service->tempDocument($invoice);

        if ($response->getStatusCode() === 200) {
            $content = json_decode($response->getBody()->getContents(), true);
            $code = array_key_exists('codigo', $content) ? $content['codigo'] : null;
            $invoice->invoice_status = Invoice::STATUS_TEMPORAL;
            $invoice->dte_code = $code;
            $invoice->updateWithoutEvents();
            \Alert::add('success', 'Se ha enviado el documento con éxito')->flash();
        } else {
            \Alert::add('warning', 'Hubo un problema al enviar el documento')->flash();
        }

        return redirect()->action([self::class, 'index'], ['invoice' => $invoice]);
    }

    public function deleteTemporaryDocument(Request $request, Invoice $invoice)
    {
        $service = new DTEService();
        $response = $service->deleteTemporalDocument($invoice);

        if ($response->getStatusCode() === 200) {
            //@todo update status
            $invoice->toDraft();
            $invoice->updateWithoutEvents();
            \Alert::add('success', 'Se ha eliminado el documento temporal con éxito')->flash();
        } else {
            \Alert::add('warning', 'Hubo un problema al eliminar el documento')->flash();
        }

        return redirect()->action([self::class, 'index'], ['invoice' => $invoice]);
    }

    public function getPDF(Request $request, Invoice $invoice)
    {
        if (!isset($invoice->dte_code)) {
            
            return redirect('index');
        }
        $service = new DTEService();
        $response = $service->getPDF($invoice);

        $pdfContent = $response->getBody()->getContents();

        //@todo check
        return response()->make($pdfContent, 200, [
            'Content-Type' =>  'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$invoice->dte_code . '.pdf"'
        ]);

        //\Alert::add('success', 'Descargar pdf')->flash();
        //return redirect()->action(
        //    [self::class, 'index'],
        //    ['invoice' => $invoice->id]
        //);
    }

    public function createRealDocument(Request $request, Invoice $invoice)
    {
        if (!isset($invoice->dte_code)) {
            return redirect('index');
        }
        //check if emisor have folios. "disponibles >0 "

        $service = new DTEService();
        $response = $service->generateDTE($invoice);

        $contentResponse = $response->getBody()->getContents();
        ddd($contentResponse, $response);
        return redirect()->action([self::class, 'index'], ['invoice' => $invoice->id]);
    }
}
