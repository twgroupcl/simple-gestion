<?php

namespace App\Services\Covepa;

use Carbon\Carbon;
use App\Models\Order;

class CovepaService
{
    private $baseUrl = 'http://216.155.76.46:8080/ServApi/rest';

    private $shippingMapping = [
        'picking' => 1,
        'chilexpress' => 2,
    ];

    private function makeRequest($url, $method, array $data = [], array $headers = [])
    {
        $client = new \GuzzleHttp\Client();

        $defaultHeaders = [
            'Content-Type' => 'application/json',
        ];

        $request = [
            'headers' => array_merge($defaultHeaders, $headers),
            //'http_errors' => false,
        ];

        if (!empty($data)) {
            $request = array_merge($request, $data);
        }

        try {
            $response = $client->request($method, $url, $request);
            return $response;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $error = $e->getResponse()->getBody()->getContents();
            \Log::error('ClientException: ' . $error);
            return ['error_message' => $error];
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            $error = $e->getResponse()->getBody()->getContents();
            \Log::error('ServerException: ' . $error);
            return ['error_message' => $error];
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            \Log::error('RequestException: ' . $e->getMessage());
            return ['error_message' => $e->getMessage()];
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            $error = $e->getMessage();
            \Log::error('ConnectException: ' . $error);
            return ['error_message' => $error];
        } catch (\Exception $e) {
            $error = $e->getMessage();
            \Log::error('Exception: ' . $error);
            return ['error_message' => $error];
        }
    }

    public function createOrder($order)
    {
        $endpoint = $this->baseUrl . '/ordenventa/';
        $method = 'POST';
        $orderData = $this->prepareOrderData($order, $method);

        $response = $this->makeRequest($endpoint, $method, $orderData);

        if (is_array($response) && array_key_exists('error_message', $response)) {
            throw new Exception($response['error_message']);
        }

        /* $dataResponse = $response->getBody()->getContents();

        return json_decode($dataResponse, true); */

        return $response;
    }

    /**
     * Convierte una orden en un arreglo con la estructura de datos
     * aceptada por la API de Covepa para registrar una nueva venta
     */
    public function prepareOrderData(Order $order) : array
    {

        // Calcular
        $net = 0;
        $iva = 0;
        $total = 0;

        $itemsDetails = [];
        $shippingDetails = [];

        foreach ($order->order_items() as $index => $item) {
            $net = round($item->total * 100 / 119, 2);
           /*  $iva = $net * 0.19;
            $net = $net + $item->total - ($net + $iva); */
            
            $detail = [
                "VTADET_CORREL" => $index + 1,
                "ARTICU_CODIGO" => $item->sku, // Preguntar si es el SKU u otro tipo de codigo
                "VTADET_UMARTI" => "UN", // Preguntar que unidad usaremos
                "VTADET_CANTID" => $item->qty,
                "VTADET_BODEGA" => 1,
                "VTADET_PREUNI" => $item->product->price,
                "VTADET_PREVTA" => $item->price, // Preguntar si es unitario
                "VTADET_EXENTO" => 0,
                "VTADET_MONETO" => $net,
                "VTADET_MONTOT" => $item->total,
                "VTADET_OIMPTO" => 0,
                "VTADET_VALIVA" => 19,
                "ARTICU_NOMBRE" => $item->name,
            ];

            $shipping = [
                "VTAPLA_TIPENT" => $this->shippingMapping[$order->shipping->code],
                "VTAPLA_CORREL" => $index + 1,
                "ARTICU_CODIGO" => $item->sku, // Preguntar si es el sku u otro codigo
                "VTAPLA_FECENT" => "20/08/2020", // Preguntar, no esta contemplado
                "BODEGA_CODIGO" => $item->product->inventories->first()->code, // Preguntar, utilizar el mismo codigo de la bodega que ellos setearon?
                "VTAPLA_CANTID" => $item->qty,
                "VTPLDI_DIRECC" => "Calle de prueba 999", // Direccion de entrega
                "COMUNA_CODIGO" => 1, // Codigo de la comuna mapeado
                "CIUDAD_CODIGO" => 1, // Codigo de la ciudad mapeado
                "VTPLDI_CONTN1" => "Scarlett Novakovich", // Nombre de contacto
                "VTPLDI_CONTF1" => "988884455", // Telefono de contado
                "VTPLDI_CONTN2" => "", // Nombre contacto alternativo
                "VTPLDI_CONTF2" => "", // Numero de telefono alternativo
                "VTPLDI_NOMDIR" => "", // Nombre de la direccion ?
                "VTPLDI_REFERE" => "", // Referencia o comentario
                "VTPLDI_COOGPS" => "0",
                "VTPLDI_DISTAN" => 0
            ];

            $itemsDetails[] = $detail;
            $shippingDetails[] = $shipping;
        }


        $order->
        $paymentDetails = [
            [
                "FORPGO_CODIGO" => 26, // 10 transferencia, 15 tarj credito, 26 tarje debito
                "VTAPGO_CORREL" => 1,
                "VTAPGO_MONPGO" => $order->total,
                "VTAPGO_NCUOTA" => 1, // numero de cuotas
                "VTAPGO_FECUOT" => Carbon::now()->format('d/m/Y'), // fecha primera cuota
                "VTAPGO_NRDCPG" => 987654, // Confirmar si es 
                "SUJETO_RUTDUE" => 15903349, // Rut cliente que paga
                "SUJETO_RUTSUJ" => 15903349 // Rut del documento de venta
            ]
        ];

        $extraDetails = [
            [
                "VTAEXT_CODIGO" => "",
                "VTAEXT_VALOR" => ""
            ]
        ];


        $orderData = [
            "VTAGEN_VTAREL" => $order->id,
            "DOCMTO_CODTRI" => "26", // Preguntar
            "VTAGEN_FECDOC" => Carbon::now()->format('d/m/Y'),
            "SUJETO_RUTSUJ" => 15903349,
            "SUJSUC_CODIGO" => 0, // Preguntar, codigo sucursal
            "VTAGEN_OCONRO" => 0, // Preguntar, Nro Orden compra cliente
            "VTAGEN_SUCNRO" => 0, // Preguntar, Sucursal cotizacion
            "VTAGEN_COTNRO" => 0, // Preguntar, nro cotizacion
            "TIPVAL_COD023" => 1, 
            "VTAGEN_OIMPTO" => 0,
            "VTAGEN_EXENTO" => 0,
            "VTAGEN_MONETO" => $net,
            "VTAGEN_MONIVA" => $iva,
            "VTAGEN_MONTOT" => $total,
            "VTAGEN_OBSERV" => "", 
            "VTAGEN_RUTRET" => "13326453", // Rut cliente que retira, buscar
            "VTAGEN_NOMRET" => "Scarlett Novakovich", // Nomre cliente que retira, buscar
            "VTAGEN_FECTRL" => Carbon::now()->format('d/m/Y h:i:s'),
            "VTADIR_DIRECC" => "Calle de facturacion 123", // Direccion de facturacion
            "CIUDAD_CODIGO" => 1, // Codigo de ciudad, utilizar mapeo provisto por covepa
            "VTADIR_NOMCIU" => "PUERTO MONTT", // Nombre Ciudad
            "COMUNA_CODIGO" => 1, // Codigo de comuna
            "VTADIR_NOMCOM" => "PUERTO MONTT", // Nombre de comuna
            "VTADIR_FONSUJ" => 933332211, // Telefono del cliente
            "VTADIR_NOMFAN" => "EMPRESA 66555444", // nombre cliente
            "TIPVAL_COD055" => 1292, // Codigo giro del cliente, 0 si es natural, de donde sale el codigo
            "VTADET" => $itemsDetails,
            "VTAPLA" => $shippingDetails ,
            "VTAPGO" => $paymentDetails,
            "VTAEXT" => $extraDetails,
        ];
    }
}
