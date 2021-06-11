<?php

namespace App\Http\Controllers\Admin\Dte;

use Illuminate\Http\Request;
use App\Services\DTE\DTEService;
use App\Http\Controllers\Controller;
use App\Models\InterchangeLog;

class InterchangeController extends Controller
{
    public function index()
    {
        //$dteService = new DTEService();
        //$interchanges = $dteService->getIntercambios($rut, 1);
        //$interchanges = $dteService->getDTEIntercambios($rut, 1);
        return view('interchanges.list', [
            'columns' => [
                '',
                'Código Intercambio',
                'Rut emisor',
                'Receptor',
                'Dirección del Receptor',
                'Rut receptor',
                'Tipo',
                'Folio',
                'Emisor',
                'Emisión',
                'Neto',
                'IVA',
                'Total',
                'Estado',
            ],
            'data' => [],//$interchanges->getBody()->getContents(),
            'message' => null,
        ]);
        if ($interchanges->getStatusCode() == 200) {
        }

        $message = 'Error';
        if ($interchanges->getStatusCode() == 404) {
            $message = $interchanges->getBody()->getContents();
            $message = 'No se encuentra el recurso';
        }

        return view('interchanges.list', [
            'data' => [],
            'message' => $message,
        ]);

    }

    public function view(Request $request, int $code)
    {
        $dteService = new DTEService();
        $rut = Company::findOrFail(backpack_user()->current()->company->id)->uid;
        $interchange = $dteService->getIntercambio($rut, $code);
        if ($interchange->getStatusCode() == 200) {
            return view('interchanges.view', [ 'data' => json_decode($interchange->getBody()->getContents()) ]);
        }

        return error(404);

    }

    public function loadData(Request $request) {
        $dteService = new DTEService();

        // filters
        // status
        $interchangesStatus = !empty($request->input('status')) ? $request->input('status') : 'all';
        if($interchangesStatus != 2 && $interchangesStatus != 1) {
            $interchangesStatus = 0;
        }

        // date range
        $initEmitDate = null;
        $endEmitDate = null;
        if (!empty($request->input('from')) && !empty($request->input('to'))) {
            $initEmitDate = $request->input('from');
            $endEmitDate = $request->input('to');
        } 
        // end filters

        // get interchanges from libredte
        $rut = Company::findOrFail(backpack_user()->current()->company->id)->uid;
        $interchanges = $dteService->getDTEIntercambios($rut, $interchangesStatus, $initEmitDate, $endEmitDate);
        $data = [];
        // get types names by code
        $types = \App\Models\DteDocumentType::all()->pluck('name','code');

        // if response is valid prepare response for front and return data.
        if ($interchanges->getStatusCode() == 200) {
            $intercambios = json_decode($interchanges->getBody()->getContents(), true)['Intercambios'];
            $DTE = [];
            foreach($intercambios as $interchange) {
                $documents = $interchange['Documentos'];
                foreach($documents as $document) {
                    $document['interchange'] = $interchange['DteIntercambio'];
                    $DTE[] = $document;
                }
            }

            foreach ($DTE as $document) {
                $data[] = [
                    'interchange_code' => $document['interchange']['codigo'],
                    'folio' => $document['Encabezado']['IdDoc']['Folio'],
                    'dte_type' => $types[$document['Encabezado']['IdDoc']['TipoDTE']],
                    'emit_date' => $document['Encabezado']['IdDoc']['FchEmis'],
                    'emitter' => $document['Encabezado']['Emisor']['RznSoc'],
                    'emitter_rut' => $document['Encabezado']['Emisor']['RUTEmisor'],
                    'receiver' => $document['Encabezado']['Receptor']['RznSocRecep'],
                    'receiver_rut' => $document['Encabezado']['Receptor']['RUTRecep'],
                    'receiver_address' => $document['Encabezado']['Receptor']['DirRecep'],
                    'net' => $document['Encabezado']['Totales']['MntNeto'],
                    'iva' => $document['Encabezado']['Totales']['IVA'],
                    'total' => $document['Encabezado']['Totales']['MntTotal'],
                    'status' => $document['interchange']['estado'] === 0 ? '<i class="fas fa-check-circle fa-fw text-success"></i>Conforme' : '',
                ];
            }
        }

        return $data;
    }

    public function send(Request $request)
    {
        $option = $request->sendOption;
        $documents = $request->documents;
        if(!isset($documents) || count($documents) <= 0) {
            return response()->json([
                'message' => 'No ha seleccionado ningun documento',
            ], 422);
        }

        if(!isset($option)) {
            return response()->json([
                'message' => 'Debe seleccionar un estado',
            ], 422);
        }

        if(!isset($request->period)) {
            return response()->json([
                'message' => 'Debe seleccionar un period',
            ], 422);
        }

        $dtes = [];
        $glosas = [
            'ERM' => 'Otorga recibo de mercaderías o servicios',
            'ACD' => 'Acepta contenido del documento',
            'RCD' => 'Reclamo al contenido del documento',
            'RFP' => 'Reclamo por falta parcial de mercaderías',
            'RFT' => 'Reclamo por falta total de mercaderías',
        ];
        $types = \App\Models\DteDocumentType::all()->pluck('code','name');

        $interchangeLog = new InterchangeLog();
        try {
            foreach($documents as $document) {
                $dtes['Documentos'][$document['interchange_code']][] = [
                    'Folio' => $document['folio'],
                    'TipoDTE' => $types[$document['dte_type']],
                    'FchEmis' => $document['emit_date'],
                    'RUTEmisor' => $document['emitter_rut'],
                    'RUTRecep' => $document['receiver_rut'],
                    'MntTotal' => $document['total'],
                    'rcv_accion_codigo' => $option,
                    'rcv_accion_glosa'=> $glosas[$option],
                ];
                $dtes['Recinto'][$document['interchange_code']] = $document['receiver_address'];
            }
            $dtes['periodo'] = $request->period;


            $interchangeLog->data_send = json_encode($dtes);
            $interchangeLog->period = $dtes['periodo'];
            $interchangeLog->status_code = $option;
            $interchangeLog->datetime_send = now();

            $dteService = new DTEService();
            // response message example, group by code
            //$string = '{ "1": {
            //    "email": {
            //        "status": true
            //    },
            //    "resultado": "T33F66: Acci\u00ef\u00bf\u00bdn autorizada solo para empresa receptora",
            //    "status": 200
            //}}';
            $rut = Company::findOrFail(backpack_user()->current()->company->id)->uid;
            $interchanges = $dteService->sendIntercambios($rut, $dtes);

            $interchangeLog->response = json_encode(json_decode($interchanges->getBody()->getContents(), true));
            $interchangeLog->response_status = $interchanges->getStatusCode();
            $interchangeLog->datetime_response = now();
            $interchangeLog->save();

            if ($interchanges->getStatusCode() == 200) {
              return response()->json(json_decode($interchanges->getBody()->getContents()), 200);
            }

            return response()->json(['message' => 'Ocurrió un error al enviar la petición'], 500);

        } catch (\Exception $e) {
            \Log::warning('Hubo un error al intentar enviar los documentos. MESSAGE-Exception:::' . $e->getMessage());
            $interchangeLog->save();
            return response()->json(['message' => 'Ocurrió un error al enviar la petición'], 500);
        }
    }
}
