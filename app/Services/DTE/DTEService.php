<?php

namespace App\Services\DTE;

use Illuminate\Support\Facades\Validator;
use App\Rules\RutRule;
use \App\Models\Invoice;
use App\Models\Company;
use \GuzzleHttp\{
    Psr7\Response as GuzzleResponse,
    Client
};

class DTEService
{
    protected $url;
    protected $token;
    protected $headers;
    protected $client;

    public function __construct()
    {
        $company = Company::findOrFail(backpack_user()->current()->company->id);

        if (!$company->dte_token) {
            abort(400, 'La empresa no tiene asignado un token DTE');
        }

        $this->client = new \GuzzleHttp\Client();
        $this->url = config('dte.url') . '/api';
        $this->token = $company->dte_token;
        $this->headers = [
            'Authorization' => 'Basic ' . $this->token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    /**
     * Generate temp document in libredte from services
     * Require invoice with type (code ex. 33)
     *
     * @param $invoice invoice to generate temporal document
     * @return Response guzzlehttp response
     */
    public function tempDocument(Invoice $invoice)
    {
        $url = $this->url . '/dte/documentos/emitir?normalizar=1&formato=json&links=0&email=0';
        $method = 'POST';
        
        $dte = DTEFactory::init($invoice->invoice_type->code, $invoice);

        $data = $dte->toArray();
        
        $headers = $this->headers;
        return self::exec($url, $data, $headers, $method);
        
    }

    /**
     * Generate REAL DTE with temporal document
     *
     * @param invoice $invoice with temporal document pre-created
     * @todo create exception
     * @throws Exception if dte_code isnt set
     */
    public function generateDTE(Invoice $invoice)
    {
        $method = 'POST';
        //retry 10 times send SII. With 0 send "automatically"
        $url = $this->url . '/dte/documentos/generar?getXML=0&links=0&email=0&retry=10&gzip=0';

        if (! isset($invoice->dte_code) ) {
            throw new Exception('Identifier code not exists');
        }

        $data = [
            'emisor' => rutWithoutDV($invoice->company->uid),
            'receptor' => rutWithoutDV($invoice->uid), // without DV
            'dte' => $invoice->invoice_type->code, // required type
            'codigo' => $invoice->dte_code
        ];

        $headers = $this->headers;

        return self::exec($url, $data, $headers, $method);
    }

    public function deleteTemporalDocument(Invoice $invoice)
    {
        $method = 'GET';
        $customerUid = rutWithoutDV($invoice->uid);
        $sellerUid = rutWithoutDV($invoice->company->uid);

        $url = $this->url . '/dte/dte_tmps/eliminar/' .
            $customerUid . '/' .
            $invoice->invoice_type->code . '/' . 
            $invoice->dte_code . '/' .
            $sellerUid;

        $headers = $this->headers;

        return self::exec($url, [], $headers, $method);
    }

    public function getRealPDF(Invoice $invoice, $tipoPapel = 0)
    {
        $method = 'GET';
        $customerUid = rutWithoutDV($invoice->uid); 
        $sellerUid = rutWithoutDV($invoice->company->uid);

        $url = $this->url . '/dte/dte_emitidos/pdf/' .
            $invoice->invoice_type->code . '/' . 
            $invoice->folio . '/' .
            $sellerUid . 
            '?papelContinuo=' . $tipoPapel . '&copias_tributarias=1&copias_cedibles=1&cedible=0&compress=0&base64=0';

        $headers = $this->headers;

        return self::exec($url, [], $headers, $method);
    }

    public function getTemporalPDF(Invoice $invoice, $tipoPapel = 0)
    {
        $method = 'GET';
        $customerUid = rutWithoutDV($invoice->uid); 
        $sellerUid = rutWithoutDV($invoice->company->uid);
        $url = $this->url . '/dte/dte_tmps/pdf/' . 
            $customerUid . '/' .
            $invoice->invoice_type->code . '/' . 
            $invoice->dte_code . '/' .
            $sellerUid . '?cotizacion=0&papelContinuo=' . $tipoPapel . '&compress=0';

        $headers = $this->headers;

        return self::exec($url, [], $headers, $method);
    }

    /**
     * Return if exists folios availables
     *
     * @param Invoice $invoice
     * @return bool
     */
    public function foliosAvailables(Invoice $invoice) : bool
    {
        $method = 'GET';
        $url = $this->url . '/dte/admin/dte_folios/info/' .
            $invoice->invoice_type->code . '/' .
            rutWithoutDV($invoice->company->uid);

        $headers = $this->headers;

        $response = self::exec($url, [], $headers, $method);

        if ($response->getStatusCode() === 200) {
            $response = $response->getBody()->getContents();
            $response = json_decode($response, true);

            return array_key_exists('disponibles', $response) && $response['disponibles'] > 0;
        }

        return false;
    }

    /**
     * Get the updated status of the DTE
     * 
     */
    public function getDteUpdatedStatus(Invoice $invoice)
    {
        $method = 'GET';

        $url = $this->url . '/dte/dte_emitidos/actualizar_estado/' .
            $invoice->invoice_type->code . '/' .
            $invoice->folio . '/' . 
            rutWithoutDV($invoice->company->uid) . 
            '?usarWebservice=1';

        $headers = $this->headers;

        $response = self::exec($url, [], $headers, $method);

        return $response;
    }

    public function getSalesReport(string $emitterRut, string $period)
    {
        
        $rutRule = new RutRule();
        $validator = \Validator::make([
            'emitter' => $emitterRut,
        ], [
            'emitter' => $rutRule
        ]);
        
        if ($validator->fails()) {
            throw new \Exception('Error, invalid RUT');
        }

        $method = 'POST';
        $url = $this->url . '/dte/dte_emitidos/buscar/' . rutWithoutDV($emitterRut);

        $headers = $this->headers;

        $data = [
         	'receptor'=> null,
            'razon_social'=> null,
            'dte'=> null,
            'folio'=> null,
            'fecha'=> null,
            'total'=> null,
            'usuario'=> null,
            'fecha_desde'=> null,
            'fecha_hasta'=> null,
            'total_desde'=> null,
            'total_hasta'=> null,
            'sucursal_sii'=> null,
            'periodo' => $period,
            'receptor_evento'=> null,
            'cedido'=> null,
        ];

        $response = self::exec($url, $data, $headers, $method);

        return $response;
    }

    public function getDataEmittedDocument(Invoice $invoice) : GuzzleResponse
    {
        $method = 'GET';

        $url = $this->url . '/dte/dte_emitidos/info/' .
            $invoice->invoice_type->code . '/' .
            $invoice->folio . '/' . 
            rutWithoutDV($invoice->company->uid) . 
            '?getXML=0&getDetalle=0&getDatosDte=1&getTed=0&getResolucion=0&getEmailEnviados=0';

        $headers = $this->headers;

        $response = self::exec($url, [], $headers, $method);

        return $response;
    }

    public function getDataEmittedDocumentUnstructure($typeCode, $folio, $rutEmitter) : GuzzleResponse
    {
        $method = 'GET';

        $url = $this->url . '/dte/dte_emitidos/info/' .
            $typeCode. '/' .
            $folio . '/' . 
            rutWithoutDV($rutEmitter) . 
            '?getXML=0&getDetalle=0&getDatosDte=1&getTed=0&getResolucion=0&getEmailEnviados=0';

        $headers = $this->headers;

        $response = self::exec($url, [], $headers, $method);

        return $response;

    }

    public static function exec($url, $data = [], array $headers =[], $method = null) : GuzzleResponse
    {
        try {
            $client = new \GuzzleHttp\Client();
    
            $request = [
                'headers' => $headers
            ];

            if (! empty($data) ) {
                $request['json'] = $data;
            }

            $response = $client->request($method, $url, $request);

            return ($response);

        } catch (\GuzzleHttp\Exception\ServerException $e) {
            ddd ($e->getResponse(), $e->getResponse()->getBody()->getContents());
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $e->getResponse();
            //ddd($e->getResponse(), $e, $request);
        } catch (Exception $e) {
            ddd($e);
        }
    }
    
}
