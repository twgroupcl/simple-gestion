<?php

namespace App\Services\Covepa;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Commune;
use App\Services\Covepa\Helpers;

class CovepaService
{
    private $baseUrl = 'http://216.155.76.46:8080/ServApi/rest';

    private $shippingMapping = [
        'picking' => 1,
        'free_shipping' => 1, //@todo eliminar esto
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

        // @todo de que manera se debe incluir el costo del shipping

        // Amount calculations
        $net = round($order->total * 100 / 119, 2);
        $iva = $order->total - $net;
        $total = (double) $order->total;

        // Shipping address
        $fullName = $order->first_name . ' ' . $order->last_name;
        $address = $order->json_value['addressShipping'];
        $fullAddress = $address->address_street . ' ' . $address->address_number . ' ' . $address->address_office;
        $commune = Commune::find($address->address_commune_id);
        
        // Invoice address
        $invoiceAddress = $order->json_value['addressInvoice']->status ? $order->json_value['addressInvoice'] : $address; 
        $fullInvoiceAddress = $invoiceAddress->address_street . ' ' . $invoiceAddress->address_number . ' ' . $invoiceAddress->address_office;
        $invoiceCommune = Commune::find($invoiceAddress->address_commune_id);
        $invoiceFullName = empty($invoiceAddress->first_name) ? $fullName : $invoiceAddress->first_name . ' ' . $invoiceAddress->last_name;

        $itemsDetails = [];
        $shippingDetails = [];

        foreach ($order->order_items as $index => $item) {
            $net = round($item->total * 100 / 119, 2);

            $detail = [
                "VTADET_CORREL" => $index + 1,
                "ARTICU_CODIGO" => $item->sku, // Preguntar si es el SKU u otro tipo de codigo
                "VTADET_UMARTI" => "UN", // Preguntar que unidad usaremos
                "VTADET_CANTID" => $item->qty,
                "VTADET_BODEGA" => 1,
                "VTADET_PREUNI" => round($item->product->price, 2),
                "VTADET_PREVTA" => round($item->price, 2), // Preguntar si es unitario
                "VTADET_EXENTO" => 0,
                "VTADET_MONETO" => $net,
                "VTADET_MONTOT" => (double) $item->total,
                "VTADET_OIMPTO" => 0,
                "VTADET_VALIVA" => 19,
                "ARTICU_NOMBRE" => $item->name,
            ];

            $shipping = [
                "VTAPLA_TIPENT" => $this->shippingMapping[$item->shipping->code],
                "VTAPLA_CORREL" => $index + 1,
                "ARTICU_CODIGO" => $item->sku, // Preguntar si es el sku u otro codigo
                "VTAPLA_FECENT" => "20/08/2020", // Preguntar, no esta contemplado, fecha de entrega
                "BODEGA_CODIGO" => $item->product->inventories->first()->code, // Preguntar, utilizar el mismo codigo de la bodega que ellos setearon?
                "VTAPLA_CANTID" => $item->qty,
                "VTPLDI_DIRECC" => $fullAddress,
                "COMUNA_CODIGO" => 1, // Codigo de la comuna mapeado
                "CIUDAD_CODIGO" => 1, // Codigo de la ciudad mapeado
                "VTPLDI_CONTN1" => $fullName,
                "VTPLDI_CONTF1" => $order->cellphone,
                "VTPLDI_CONTN2" => "", // Nombre contacto alternativo
                "VTPLDI_CONTF2" => $order->phone,
                "VTPLDI_NOMDIR" => "", // Nombre de la direccion ??
                "VTPLDI_REFERE" => "", // Referencia o comentario, buscar donde esta gaurdado
                "VTPLDI_COOGPS" => "0",
                "VTPLDI_DISTAN" => 0
            ];

            $itemsDetails[] = $detail;
            $shippingDetails[] = $shipping;
        }

        $paymentDetails = Helpers::getPaymentArray($order);

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
            // Esto no lo tenemos almacenado
            "VTAGEN_RUTRET" => "13326453", // Rut cliente que retira, buscar
            // Buscar en que parte se esta guardando el nombre del que retira
            "VTAGEN_NOMRET" => $order->first_name . ' ' . $order->last_name, // Nomre cliente que retira, buscar
            "VTAGEN_FECTRL" => Carbon::now()->format('d/m/Y h:i:s'),
            "VTADIR_DIRECC" => $fullInvoiceAddress, // Direccion de facturacion, todo de aqui es facturacion
            "CIUDAD_CODIGO" => 1, // Codigo de ciudad, utilizar mapeo provisto por covepa
            "VTADIR_NOMCIU" => $invoiceCommune->name, // Nombre Ciudad
            "COMUNA_CODIGO" => 1, // Codigo de comuna
            "VTADIR_NOMCOM" => $invoiceCommune->name, // Nombre de comuna
            "VTADIR_FONSUJ" => empty($invoiceAddress->cellphone) ? $order->cellphone : $invoiceAddress->cellphone, // Telefono del cliente
            "VTADIR_NOMFAN" => $invoiceFullName, // nombre cliente
            // Codigo de ellos o de nosotros
            "TIPVAL_COD055" => 1292, // Codigo giro del cliente, 0 si es natural, de donde sale el codigo
            "VTADET" => $itemsDetails,
            "VTAPLA" => $shippingDetails ,
            "VTAPGO" => $paymentDetails,
            "VTAEXT" => $extraDetails,
        ];

        return $orderData;
    }
}
