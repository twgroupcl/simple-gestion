<?php

namespace App\Services\DTE;

use \App\Models\Invoice;
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
        $this->client = new \GuzzleHttp\Client();
        $this->url = config('dte.url') . '/api';
        $this->token = config('dte.api_token');
        $this->headers = [
            'Authorization' => 'Basic ' . $this->token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function tempDocument(Invoice $invoice)
    {
        $url = $this->url . '/dte/documentos/emitir?normalizar=1&formato=json&links=0&email=0';
        $method = 'POST';

        $dte = DTEFactory::init($invoice->invoice_type->code, $invoice);

        $data = $dte->toArray();
        
        $headers = $this->headers;
        return self::exec($url, $data, $headers, $method);
        
    }

    public function generateDTE(Invoice $invoice)
    {
        $method = 'POST';

        $url = $this->url . '/dte/documentos/generar?getXML=0&links=0&email=0&retry=10&gzip=0';

        $data = [
            'emisor' => $invoice->seller->uid,
            'receptor' => $invoice->uid, // without DV
            'dte' => 33, // required type
            'codigo' => '???'
        ];

        $headers = $this->headers;

        return self::exec($url, $data, $headers, $method);
    }

    public function deleteTemporalDocument(Invoice $invoice)
    {
        $method = 'GET';
        $customerUid = rutWithoutDV($invoice->uid);
        $sellerUid = rutWithoutDV($invoice->seller->uid);

        $url = $this->url . '/dte/dte_tmps/eliminar/' .
            $customerUid . '/' .
            $invoice->invoice_type->code . '/' . 
            $invoice->dte_code . '/' .
            $sellerUid;

        $headers = $this->headers;

        return self::exec($url, [], $headers, $method);
    }

    public function getPDF(Invoice $invoice)
    {
        $method = 'GET';
        $customerUid = rutWithoutDV($invoice->uid); 
        $sellerUid = rutWithoutDV($invoice->seller->uid);
        $url = $this->url . '/dte/dte_tmps/pdf/' . 
            $customerUid . '/' .
            $invoice->invoice_type->code . '/' . 
            $invoice->dte_code . '/' .
            $sellerUid . '?cotizacion=0&papelContinuo=0&compress=0';

        $headers = $this->headers;

        return self::exec($url, [], $headers, $method);
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
