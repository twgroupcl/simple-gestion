<?php

namespace App\Services\Covepa;

use Exception;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Commune;
use Illuminate\Support\Facades\Cache;
use App\Services\Covepa\Helpers as CovepaHelper;

class CovepaService
{
    const CACHE_SECONDS_API_TOKEN = 3600;
    
    private $baseUrl = 'http://216.155.76.46:8080/ServApi/rest';

    private $shippingMapping = [
        'picking' => 5,
        'chilexpress' => 1,
    ];

    private function makeRequest($url, $method, array $data = [], array $headers = [], $useAuth = true)
    {
        $client = new \GuzzleHttp\Client();

        $token = $useAuth ? $this->getToken() : null;

        $defaultHeaders = [
            'Content-Type' => 'application/json',
            'Authorization' => "$token",
            'Accept'     => 'application/json',
        ];

        $request = [
            'headers' => array_merge($defaultHeaders, $headers),
            'http_errors' => false,
        ];

        if (!empty($data)) {
            $request = array_merge($request, ['json' => $data]);
        }

        try {
            $response = $client->request($method, $url, $request);

            if (in_array($response->getStatusCode(), [400, 401, 500])) {
                \Log::warning('Codigo de error en peticion realizada a covepa', [
                    'url' => $url,
                    'status_code' => $response->getStatusCode(),
                    'response_headers' => $response->getHeaders(),
                    'request_headers' => array_merge($defaultHeaders, $headers),
                ]);
            }

            return $response;
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

    public function getToken()
    {

        if (Cache::get('covepa.auth.token') === null) {
            Cache::forget('covepa.auth.token');
        }

        $token = Cache::remember('covepa.auth.token', self::CACHE_SECONDS_API_TOKEN, function() {

            $credentials = [
                'usuario' => config('covepa.credentials.user'),
                'password' => config('covepa.credentials.password'),
            ];

            $response = $this->makeRequest($this->baseUrl . '/auth', 'POST', $credentials, [], false);

            if (is_array($response) && array_key_exists('error_message', $response)) {
                \Log::error('Error getting auth token');
                throw new Exception($response['error_message']);
            }

            $response = json_decode($response->getBody()->getContents(), true);

            if ($response['resultado'] === false) {
                return null;
            }

            return $response['token'];
        });

        return $token;
    }

    public function createOrder($order)
    {
        $endpoint = $this->baseUrl . '/ordenventa/';
        $method = 'POST';
        $orderData = $this->prepareOrderData($order, $method);

        $response = $this->makeRequest($endpoint, $method, $orderData);

        if (is_array($response) && array_key_exists('error_message', $response)) {
            \Log::error('error creating order', ['data' => $orderData]);
            throw new Exception($response['error_message']);
        }

        return $response->getBody()->getContents();
    }

    public function getCustomer($id)
    {
        $endpoint = $this->baseUrl . '/clientes/' . $id;
        $method = 'GET';

        $response = $this->makeRequest($endpoint, $method);

        if (is_array($response) && array_key_exists('error_message', $response)) {
            throw new Exception($response['error_message']);
        }

        return $response;
    }

    public function updateCustomerEmail($id, $email)
    {
        $endpoint = $this->baseUrl . '/clientes/' . $id;
        $method = 'POST';
        $data = [
            'email' => $email,
        ];

        $response = $this->makeRequest($endpoint, $method, $data);

        if (is_array($response) && array_key_exists('error_message', $response)) {
            throw new Exception($response['error_message']);
        }

        return $response;
    }

    public function createCustomer(array $customerData)
    {
        $endpoint = $this->baseUrl . '/clientes';
        $method = 'POST';

        $response = $this->makeRequest($endpoint, $method, $customerData);

        if (is_array($response) && array_key_exists('error_message', $response)) {
            throw new Exception($response['error_message']);
        }

        return $response;
    }

    /**
     * Convierte una orden en un arreglo con la estructura de datos
     * aceptada por la API de Covepa para registrar una nueva venta
     * 
     */
    public function prepareOrderData(Order $order) : array
    {
        // Amount calculations
        $total = round($order->total);
        $net = round($total * 100 / 119);
        $iva = $total - $net;

        // Shipping address
        $rutWithoutDV = rutWithoutDV($order->uid);
        $fullName = $order->first_name . ' ' . $order->last_name;
        $address = $order->json_value['addressShipping'];
        $fullAddress = $address->address_street . ' ' . $address->address_number . ' ' . $address->address_office;
        $commune = Commune::find($address->address_commune_id);
        
        // Invoice address
        $invoiceAddress = $order->json_value['addressInvoice']->status ? $order->json_value['addressInvoice'] : $address; 
        $invoiceRut = empty($invoiceAddress->uid) ?  $rutWithoutDV : rutWithoutDV($invoiceAddress->uid);
        $fullInvoiceAddress = $invoiceAddress->address_street . ' ' . $invoiceAddress->address_number . ' ' . $invoiceAddress->address_office;
        $invoiceCommune = Commune::find($invoiceAddress->address_commune_id);
        $invoiceFullName = empty($invoiceAddress->first_name) ? $fullName : $invoiceAddress->first_name . ' ' . $invoiceAddress->last_name;
        $invoiceData = $order->getInvoiceData();

        $fullInvoiceAddress = substr($fullInvoiceAddress, 0, 50);

        $itemsDetails = [];
        $shippingDetails = [];

        foreach ($order->order_items as $index => $item) {
            $netItem = round($item->sub_total * 100 / 119, 2);

            $detail = [
                "VTADET_CORREL" => $index + 1,
                "ARTICU_CODIGO" => $item->sku,
                "VTADET_UMARTI" => 0,
                "VTADET_CANTID" => $item->qty,
                "VTADET_BODEGA" => $item->product->inventories->first()->code,
                "VTADET_PREUNI" => round($item->product->price, 2),
                "VTADET_PREVTA" => round($item->price, 2),
                "VTADET_EXENTO" => 0,
                "VTADET_MONETO" => (int) $netItem,
                "VTADET_MONTOT" => (int) $item->sub_total,
                "VTADET_OIMPTO" => 0,
                "VTADET_VALIVA" => 19,
                "ARTICU_NOMBRE" => $item->name,
            ];

            $shipping = [
                "VTAPLA_TIPENT" => $this->shippingMapping[$item->shipping->code],
                "VTAPLA_CORREL" => $index + 1,
                "ARTICU_CODIGO" => $item->sku,
                "VTAPLA_FECENT" => now()->add($order->company->delivery_days_max, 'days')->format('d/m/Y'),
                "BODEGA_CODIGO" => $item->product->inventories->first()->code,
                "VTAPLA_CANTID" => $item->qty,
                "VTPLDI_DIRECC" => $fullAddress,
                "COMUNA_CODIGO" => CovepaHelper::COMMUNE_MAPPING[$commune->id]['id_commune'],
                "CIUDAD_CODIGO" => CovepaHelper::COMMUNE_MAPPING[$commune->id]['id_city'],
                "VTPLDI_CONTN1" => $fullName,
                "VTPLDI_CONTF1" => $order->phone,
                "VTPLDI_CONTF2" => $order->cellphone,
                "VTPLDI_REFERE" => $address->address_details,
                "VTPLDI_COOGPS" => "0",
                "VTPLDI_DISTAN" => 0
            ];

            $itemsDetails[] = $detail;
            $shippingDetails[] = $shipping;
        }

        // Costo de envio si es envio Chilexpress
        // Como todos los items de la orden deben tener el mismo tipo de envio
        // podemos verificar el tipo denvio por la orden con el primer item
        if ($order->order_items->first()->shipping->code === 'chilexpress') {
            $itemsDetails[] = [
                "VTADET_CORREL" => count($itemsDetails) + 1,
                "ARTICU_CODIGO" => 308245,
                "VTADET_UMARTI" => "UN",
                "VTADET_CANTID" => 1,
                "VTADET_BODEGA" => $order->order_items->first()->product->inventories->first()->code,
                "VTADET_PREUNI" => (int) $order->shipping_total, 
                "VTADET_PREVTA" => (int) $order->shipping_total, 
                "VTADET_EXENTO" => 0,
                "VTADET_MONETO" => round($order->shipping_total * 100 / 119),
                "VTADET_MONTOT" => (int) $order->shipping_total, 
                "VTADET_OIMPTO" => 0,
                "VTADET_VALIVA" => 19,
                "ARTICU_NOMBRE" => "DESPACHO DOMICILIO ECOMMERCE",
            ];

            $shippingDetails[] = [
                "VTAPLA_TIPENT" => $this->shippingMapping[$order->order_items->first()->shipping->code],
                "VTAPLA_CORREL" => count($shippingDetails) + 1,
                "ARTICU_CODIGO" => 308245,
                "VTAPLA_FECENT" => now()->add($order->company->delivery_days_max, 'days')->format('d/m/Y'),
                "BODEGA_CODIGO" => $order->order_items->first()->product->inventories->first()->code,
                "VTAPLA_CANTID" => 1,
                "VTPLDI_DIRECC" => $fullAddress,
                "COMUNA_CODIGO" => CovepaHelper::COMMUNE_MAPPING[$commune->id]['id_commune'],
                "CIUDAD_CODIGO" => CovepaHelper::COMMUNE_MAPPING[$commune->id]['id_city'],
                "VTPLDI_CONTN1" => $fullName,
                "VTPLDI_CONTF1" => $order->phone,
                "VTPLDI_CONTF2" => $order->cellphone,
                "VTPLDI_REFERE" => $address->address_details,
                "VTPLDI_COOGPS" => "0",
                "VTPLDI_DISTAN" => 0
            ];
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
            "DOCMTO_CODTRI" => $invoiceData['is_company'] ? '25' : '26',
            "VTAGEN_FECDOC" => Carbon::now()->format('d/m/Y'),

            "SUJSUC_CODIGO" => 0, // codigo sucursal
            "VTAGEN_OCONRO" => 0, // Nro Orden compra cliente
            "VTAGEN_SUCNRO" => 0, // Sucursal cotizacion
            "VTAGEN_COTNRO" => 0, // nro cotizacion

            "TIPVAL_COD023" => 1,
            
            // Montos
            "VTAGEN_OIMPTO" => 0,
            "VTAGEN_EXENTO" => 0,
            "VTAGEN_MONETO" => (int) $net,
            "VTAGEN_MONIVA" => (int) $iva,
            "VTAGEN_MONTOT" => (int) $total,
            "VTAGEN_OBSERV" => "", 

            // Persona que retira
            "VTAGEN_RUTRET" => $rutWithoutDV,  
            "VTAGEN_NOMRET" => $fullName,
            "VTAGEN_FECTRL" => Carbon::now()->format('d/m/Y h:i:s'),

            // Dirección de facturación
            "SUJETO_RUTSUJ" => $invoiceRut,
            "VTADIR_NOMFAN" => $invoiceFullName,
            "VTADIR_DIRECC" => $fullInvoiceAddress,
            "VTADIR_NOMCOM" => $invoiceCommune->name,
            "VTADIR_NOMCIU" => $invoiceCommune->name,
            "CIUDAD_CODIGO" => CovepaHelper::COMMUNE_MAPPING[$invoiceCommune->id]['id_city'],
            "COMUNA_CODIGO" => CovepaHelper::COMMUNE_MAPPING[$invoiceCommune->id]['id_commune'],
            "TIPVAL_COD055" => $invoiceData['is_company'] 
                                        ? (CovepaHelper::GIRO_MAPPING[$invoiceData['business_activity_id']] ?? 0 )
                                        : 0,
            "VTADET" => $itemsDetails,
            "VTAPLA" => $shippingDetails ,
            "VTAPGO" => $paymentDetails,
            "VTAEXT" => $extraDetails,
        ];

        return $orderData;
    }
}
