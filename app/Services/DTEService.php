<?php

namespace App\Services;

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

        $data = $this->processInvoice(33, $invoice);
        

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
            ddd ($e->getResponse());
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $e->getResponse();
            //ddd($e->getResponse(), $e, $request);
        } catch (Exception $e) {
            ddd($e);
        }
    }

    private function processInvoice(int $typeDTE, Invoice $invoice)
    {
        $seller = $invoice->seller;
        $customerAddress = $invoice->address;
        //dd($customerAddress, $invoice);
    
        $items = $invoice->invoice_items;
        $itemsDTE = [];

        foreach ($items as $item) {
            $itemsDTE[] = [
                'NmbItem' => $item->name,
                'QtyItem' => $item->qty,
                'PrcItem' => isset($item->custom_price) ? $item->custom_price : $item->price
            ];
        }

        return [
            'Encabezado' => [
                'IdDoc' => [
                    'TipoDTE' => $typeDTE,
                ],
                'Emisor' => [
                    'RUTEmisor' => $seller->uid,
                ],
                'Receptor' => [
                    'RUTRecep' => $invoice->uid,
                    'RznSocRecep' => $invoice->first_name . ' ' . $invoice->last_name,
                    'GiroRecep' => 'Informática', // this is required in 33
                    'DirRecep' => $customerAddress->street . ' ' . $customerAddress->number . 
                                !empty($customerAddress->subnumber) ? 
                                    $customerAddress->subnumber : 
                                    '',
                    'CmnaRecep' => $customerAddress->commune->name,
                ],
            ],
            'Detalle' => $itemsDTE
        ];
    }
}
