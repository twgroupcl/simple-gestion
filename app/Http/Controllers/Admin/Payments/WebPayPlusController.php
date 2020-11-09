<?php
namespace App\Http\Controllers\Admin\Payments;

use session;
use Transbank\Webpay\Webpay;
use App\Models\PlanSuscription;
use Transbank\Webpay\Configuration;
use App\Http\Controllers\Controller;

class WebPayPlusController extends Controller
{
    const PAYMENT_CODE = 'tbkplusmall';
    private $paymentMethod;
    private $transaction;
    private $returnUrl;
    private $finalUrl;
    private $orderId;

    public function __construct()
    {
        $configuration = new Configuration();

        // $configuration->setEnvironment('PRODUCCION');
        // $configuration->setCommerceCode($wpmConfig[0]->variable_value);
        // $configuration->setPublicCert($wpmConfig[1]->variable_value);
        // $configuration->setPrivateKey($wpmConfig[2]->variable_value);
        //   $this->returnUrl = $wpmConfig[3]->variable_value;
        //   $this->finalUrl = $wpmConfig[4]->variable_value;

        $this->transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))->getNormalTransaction();
    }

    /* *
     *
     *
     * @param Integer $subscriptionId
     */
    public function subscriptionPayment($subscriptionId)
    {

        $subscription = PlanSuscription::where('id', $subscriptionId)->first();
        $plan = $subscription->plan;
        $amount = $plan->price;

        $sessionId = session()->getId();

        $buyOrder = strval(rand(100000, 999999999));
        $returnUrl = "https://simplegestion.test/admin/payment/subscription/result";
        $finalUrl = "https://simplegestion.test/admin/payment/subscription/detail/";
        $response = $this->transaction->initTransaction(
            $amount, $buyOrder, $sessionId, $returnUrl, $finalUrl);

        if (!isset($response->url)) {
            $result = null;
            return view('vendor.backpack.base.payment.failed');
        } else {
            return view('vendor.backpack.base.payment.redirect', compact('response'));
        }

    }

    public function subscriptionResultPayment()
    {
        $result = $this->transaction->getTransactionResult(request()->input("token_ws"));

        $sessionId = $result->sessionId;
        session()->setId($sessionId);
        session()->start();

    }

    public function subscriptionDetailPayment($subscriptionId)
    {

    }
}
