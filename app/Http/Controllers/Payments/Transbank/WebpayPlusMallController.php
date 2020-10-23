<?php

namespace App\Http\Controllers\Payments\Transbank;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Business;
// use Barryvdh\DomPDF\PDF;
use App\Models\OrderLog;

use App\Models\OrderItem;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Transbank\Webpay\Webpay;
use App\Models\PaymentMethod;
use Barryvdh\DomPDF\Facade as PDF;
use Transbank\Webpay\Configuration;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethodBusiness;
use App\Models\PaymentMethodSeller;

class WebpayPlusMallController extends Controller
{
    const PAYMENT_CODE = 'tbkplusmall';
    private $paymentMethod;
    private $transaction;
    private $returnUrl;
    private $finalUrl;
    private $orderId;


    function __construct()
    {

        $paymentMethodId = null;
        //Get Config Payment Method
        $this->paymentMethod = PaymentMethod::where('code', $this::PAYMENT_CODE)->first();
        if ($this->paymentMethod) {
            $paymentMethodId = $this->paymentMethod->id;
            $wpmConfig = json_decode($this->paymentMethod->json_value);
        }



        $configuration  = new Configuration();

        $configuration->setCommerceCode($wpmConfig[0]->variable_value);
        $configuration->setPublicCert($wpmConfig[1]->variable_value);
        $configuration->setPrivateKey($wpmConfig[2]->variable_value);
        $this->returnUrl = $wpmConfig[3]->variable_value;
        $this->finalUrl = $wpmConfig[4]->variable_value;

        //$transaction = (new Webpay(Configuration::forTestingWebpayPlusMall()))->getMallNormalTransaction();
        $this->transaction = (new Webpay($configuration))->getMallNormalTransaction();
    }

    public function redirect($orderId)
    {

        if (!intval($orderId)) {
            return redirect()->back()->with('error', 'Orden no generada , reintente');
        }
        $this->orderId = $orderId;
        //Get current Order
        $order = Order::where('id', $orderId)->first();


        // Identificador único de orden de compra generada por el comercio mall:
        $buyOrder =  $order->id; // strval(rand(100000, 999999999));
        // Identificador que será retornado en el callback de resultado:
        $sessionId =  $order->id;


        // Lista con detalles de cada una de las transacciones:
        $transactions = array();

        $products_id = OrderItem::whereOrderId($order->id)->select('product_id')->with('order')->get();
        foreach ($products_id as $id) {
            $ids[] = $id['product_id'];
        }



        $sellers_id = Product::whereIn('id', $ids)->select('seller_id')->groupBy('seller_id')->get();

        $sellers = Seller::whereIn('id', $sellers_id)->select('id', 'name')->get();


        // Group by items by businness

        $totalsByBusiness = [];
        foreach ($sellers as $key => $seller) {
            //TODO find payment method by id
            $pmSeller = PaymentMethodSeller::where('payment_method_id', $this->paymentMethod->id)->where('seller_id', $seller->id)->first();

            $totalsBySeller[$key] = array();
            $totalsBySeller[$key]['id'] = $seller->id;
            $totalsBySeller[$key]['storeCode'] = $pmSeller->key;
            $totalsBySeller[$key]['amount'] = 0;
            $totalsBySeller[$key]['status'] = $pmSeller->status;

            foreach ($order->order_items as $item) {

                $product = Product::find($item->product_id);
                if ($seller->id === $product->seller->id) {
                    $totalsBySeller[$key]['amount'] += ($item->price * $item->qty) + $item->shipping_total;
                }
            }
        }

        // Order amount total
        $amountTotal = 0;

        //Add transactions
        foreach ($totalsBySeller  as $seller) {

            // Add transaction
            $transactions[] = array(
                "storeCode" => $seller['storeCode'],
                "amount" => $seller['amount'],
                // Identificador único de orden de compra generada por tienda 1
                "buyOrder" => $seller['id']
            );
            $amountTotal += $seller['amount'];
        }


        $order->total = $amountTotal;

        $order->save();


        $response = $this->transaction->initTransaction($buyOrder, $sessionId, $this->returnUrl, $this->finalUrl, $transactions);


        //Register  order payment

        $orderpayment = new OrderPayment();
        $data = [
            'event' => 'init transaction',
            'data' => $response,
            'transactions' => $transactions
        ];

        $orderpayment->order_id = $order->id;
        $orderpayment->method = $this->paymentMethod->code;
        $orderpayment->method_title = $this->paymentMethod->title;
        $orderpayment->json_out = json_encode($data);
        $orderpayment->date_out = Carbon::now();
        $orderpayment->save();

        //Register  order log

        $orderlog = new OrderLog();
        $orderlog->order_id = $order->id;
        $orderlog->event = 'Inicio de pago';
        $orderlog->save();


        if (!isset($response->url)) {
            return redirect()->back()->with('error', 'Ocurrió un error al generar la url de pago');
        } else {
            return view('payments.transbank.webpay.mall.redirect', compact('response'));
        }
    }

    public function response()
    {



        $result = $this->transaction->getTransactionResult(request()->input("token_ws"));

        if (!isset($result->buyOrder)) {
            return redirect('/');
        }
        $this->orderId = $result->buyOrder;

        //Register  order payment
        $orderpayment = OrderPayment::where('order_id', $this->orderId)->first();
        $data = [
            'event' => 'result transaction',
            'token' => request()->input("token_ws"),
            'data' => $result,

        ];
        $orderpayment->json_in = json_encode($data);
        $orderpayment->date_in = Carbon::now();
        $orderpayment->save();


        //Register  order log

        $orderlog = new OrderLog();

        $orderlog->order_id = $this->orderId;
        $orderlog->event = 'Resultado pago';
        $orderlog->save();


        $order = Order::where('id', $this->orderId)->first();

        $finalresult = false;
        if (is_array($result->detailOutput)) {
            foreach ($result->detailOutput as $output) {
                // Se debe chequear cada transacción de cada tienda del
                // mall por separado:
                if ($output->responseCode == 0) {
                    // Transaccion exitosa, puedes procesar el resultado
                    // con el contenido de las variables result y output.
                    $finalresult = true;
                } else {
                    $finalresult = false;
                }
            }
        } else {

            if ($result->detailOutput->responseCode == 0) {
                // Transaccion exitosa, puedes procesar el resultado
                // con el contenido de las variables result y output.
                $finalresult = true;
            } else {
                $finalresult = false;
            }
        }
        if ($finalresult) {
            return view('payments.transbank.webpay.mall.complete', compact('result', 'order'));
        } else {
            return view('payments.transbank.webpay.mall.failed', compact('result', 'order'));
        }
    }

    public function download($orderId)
    {
        $order = Order::where('id', $orderId)->first();
        $data = [
            'order'=>$order
        ];
        $pdf = PDF::loadView('order.pdf_order', $data);
         return $pdf->download('order_' . $orderId . '.pdf');
    }
}
