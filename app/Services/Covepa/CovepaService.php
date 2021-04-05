<?php

namespace App\Services\Covepa;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Commune;
use App\Services\Covepa\Helpers as CovepaHelper;

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

        return $response;
    }

    /**
     * Convierte una orden en un arreglo con la estructura de datos
     * aceptada por la API de Covepa para registrar una nueva venta
     * 
     * @todo de que manera se debe incluir el costo del shipping
     */
    public function prepareOrderData(Order $order) : array
    {
        // Amount calculations
        $net = round($order->total * 100 / 119, 2);
        $iva = $order->total - $net;
        $total = (double) $order->total;

        // Shipping address
        $rut = rutWithoutDV($order->uid);
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
                "COMUNA_CODIGO" => CovepaHelper::COMMUNE_MAPPING[$commune->id]['id_commune'],
                "CIUDAD_CODIGO" => CovepaHelper::COMMUNE_MAPPING[$commune->id]['id_city'],
                "VTPLDI_CONTN1" => $fullName,
                "VTPLDI_CONTF1" => $order->cellphone,
                "VTPLDI_CONTF2" => $order->phone,
                "VTPLDI_REFERE" => $address->address_details,
                "VTPLDI_COOGPS" => "0",
                "VTPLDI_DISTAN" => 0
            ];

            $itemsDetails[] = $detail;
            $shippingDetails[] = $shipping;
        }

        $paymentDetails = CovepaHelper::getPaymentArray($order);

        $extraDetails = [
            [
                "VTAEXT_CODIGO" => "",
                "VTAEXT_VALOR" => ""
            ]
        ];

        $orderData = [
            "VTAGEN_VTAREL" => $order->id,
            // Codigo del documento
            "DOCMTO_CODTRI" => "26", // Preguntar, tipo de documento

            "VTAGEN_FECDOC" => Carbon::now()->format('d/m/Y'),
            
            //@todo es posible que esta sea el ID del cliente y no su RUT
            // preguntar
            "SUJETO_RUTSUJ" => $rut,

            "SUJSUC_CODIGO" => 0, // codigo sucursal
            "VTAGEN_OCONRO" => 0, // Nro Orden compra cliente
            "VTAGEN_SUCNRO" => 0, // Sucursal cotizacion
            "VTAGEN_COTNRO" => 0, // nro cotizacion

            "TIPVAL_COD023" => 1,
            
            // Montos
            "VTAGEN_OIMPTO" => 0,
            "VTAGEN_EXENTO" => 0,
            "VTAGEN_MONETO" => $net,
            "VTAGEN_MONIVA" => $iva,
            "VTAGEN_MONTOT" => $total,
            "VTAGEN_OBSERV" => "", 

            // Persona que retira
            //@todo es posible que este sea el RUT sin el digito verificador
            "VTAGEN_RUTRET" => $rut, 
            "VTAGEN_NOMRET" => $fullName,
            "VTAGEN_FECTRL" => Carbon::now()->format('d/m/Y h:i:s'),

            // Dirección de facturación
            "VTADIR_DIRECC" => $fullInvoiceAddress,
            "CIUDAD_CODIGO" => CovepaHelper::COMMUNE_MAPPING[$invoiceCommune->id]['id_city'],
            "VTADIR_NOMCIU" => $invoiceCommune->name,
            "COMUNA_CODIGO" => CovepaHelper::COMMUNE_MAPPING[$invoiceCommune->id]['id_commune'],
            "VTADIR_NOMCOM" => $invoiceCommune->name,
            "VTADIR_FONSUJ" => empty($invoiceAddress->cellphone) ? $order->cellphone : $invoiceAddress->cellphone,
            "VTADIR_NOMFAN" => $invoiceFullName,
            
            // Codigo de ellos o de nosotros
            // Que hacer cuando el cliente es empresa pero no tiene giro porque el giro
            // solo ests disponible para seleccionar en la dirección de facturación, no esta
            // disponible para la direccion de shipping
            "TIPVAL_COD055" => $order->is_company 
                                        ? (empty($invoiceAddress->business_activity_id)
                                            ? 0
                                            : $invoiceAddress->business_activity_id) 
                                        : 0,
            "VTADET" => $itemsDetails,
            "VTAPLA" => $shippingDetails ,
            "VTAPGO" => $paymentDetails,
            "VTAEXT" => $extraDetails,
        ];

        return $orderData;
    }
}
