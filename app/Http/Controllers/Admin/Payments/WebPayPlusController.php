<?php
namespace App\Http\Controllers\Admin\Payments;

use session;
use Carbon\Carbon;
use App\Models\Plans;
use App\Models\Customer;
use App\Models\Currency;
use Transbank\Webpay\Webpay;
use App\Models\PlanSubscription;
use Transbank\Webpay\Configuration;
use App\Http\Controllers\Controller;
use App\Models\PlanSubscriptionPayment;

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

        $subscription = PlanSubscription::where('id', $subscriptionId)->first();
        $plan = $subscription->plan;
        $amount = $plan->price;

        $sessionId = session()->getId();

        $buyOrder = $subscription->id;
        $returnUrl = url('admin/payment/subscription/result');
        $finalUrl =  url('admin/payment/subscription/detail/');
        $response = $this->transaction->initTransaction(
            $amount, $buyOrder, $sessionId, $returnUrl, $finalUrl);
        //Register payment
        $subscriptionPayment = new PlanSubscriptionPayment();
        $data = [
            'event' => 'init transaction',
            'data' => $response,
            'buyOrder' => $buyOrder,
            'sessionId' => $sessionId,
            'amount' => $amount,
        ];

        $subscriptionPayment->plan_subscription_id = $subscription->id;
        $subscriptionPayment->method = 1;
        $subscriptionPayment->method_title = 'WebPayPlus Normal';
        $subscriptionPayment->json_out = json_encode($data);
        $subscriptionPayment->date_out = Carbon::now();
        $subscriptionPayment->save();

        if (!isset($response->url)) {
            $result = null;
            return view('vendor.backpack.base.payment.failed');
        } else {
            return view('vendor.backpack.base.payment.redirect', compact('response'));
        }

    }

    public function subscriptionResultPayment()
    {
        $tokenWs = request()->input("token_ws");
        $result = $this->transaction->getTransactionResult($tokenWs);

        if (!isset($result->buyOrder)) {
            return redirect('/admin');
        }
        $sessionId = $result->sessionId;
        session()->setId($sessionId);
        session()->start();

        $planSubscriptionId = $result->buyOrder;

        $orderpayment = PlanSubscriptionPayment::where('plan_subscription_id', $planSubscriptionId)->first();
        $data = [
            'event' => 'result transaction',
            'token' => $tokenWs,
            'data' => $result,

        ];
        $orderpayment->json_in = json_encode($data);
        $orderpayment->date_in = Carbon::now();
        $orderpayment->save();

        $output = $result->detailOutput;
        if ($output->responseCode == 0) {
            $subscription = PlanSubscription::where('id', $planSubscriptionId)->first();
            return view('vendor.backpack.base.payment.result', compact('subscription'));
        } else {

            return view('vendor.backpack.base.payment.failed', compact('result'));
        }

    }

    public function subscriptionCustomerPayment($subscriptionId)
    {

        $subscription = PlanSubscription::where('id', $subscriptionId)->first();
        $plan = $subscription->plan;
        $amount = $plan->price;

        $sessionId = session()->getId();

        $buyOrder = $subscription->id;
        $returnUrl = url('payment/subscription/result');
        $finalUrl =  url('payment/subscription/detail');
        $response = $this->transaction->initTransaction(
            $amount, $buyOrder, $sessionId, $returnUrl, $finalUrl);
        //Register payment
        $subscriptionPayment = new PlanSubscriptionPayment();
        $data = [
            'event' => 'init transaction',
            'data' => $response,
            'buyOrder' => $buyOrder,
            'sessionId' => $sessionId,
            'amount' => $amount,
        ];

        $subscriptionPayment->plan_subscription_id = $subscription->id;
        $subscriptionPayment->method = 1;
        $subscriptionPayment->method_title = 'WebPayPlus Normal';
        $subscriptionPayment->json_out = json_encode($data);
        $subscriptionPayment->date_out = Carbon::now();
        $subscriptionPayment->save();

        if (!isset($response->url)) {
            $result = null;
            return view('payments.transbank.webpay.plus.failed');
        } else {
            return view('payments.transbank.webpay.plus.redirect', compact('response'));
        }

    }

    public function subscriptionResultCustomerPayment()
    {
        $tokenWs = request()->input("token_ws");
        $result = $this->transaction->getTransactionResult($tokenWs);

        if (!isset($result->buyOrder)) {
            return redirect()->route('customer.subscription.plans');
        }
        $sessionId = $result->sessionId;
        session()->setId($sessionId);
        session()->start();

        $planSubscriptionId = $result->buyOrder;

        $orderpayment = PlanSubscriptionPayment::where('plan_subscription_id', $planSubscriptionId)->first();
        $data = [
            'event' => 'result transaction',
            'token' => $tokenWs,
            'data' => $result,

        ];
        $orderpayment->json_in = json_encode($data);
        $orderpayment->date_in = Carbon::now();
        $orderpayment->save();

        $output = $result->detailOutput;
        if ($output->responseCode == 0) {
            $subscription = PlanSubscription::where('id', $planSubscriptionId)->first();
            
            $customer = Customer::where('user_id',$subscription->user_id)->first();
            $plan = Plans::where('id', $subscription->plan_id)->first();
            $currency = Currency::where('id',$plan->currency)->first();
            $starts_at = explode(' ',$subscription->starts_at);
            $ends_at = explode(' ',$subscription->ends_at);

            $dataSubscription = [
                'plan_id' => $subscription->plan_id,
                'price' => $plan->price,
                'start_date' => $starts_at[0],
                'end_date' => $ends_at[0]
            ];
            $customer->subscription_data = json_encode($dataSubscription);
            $customer->save();
            
            return view('payments.transbank.webpay.plus.result')->with('data', $planSubscriptionId);
        } else {
            return view('payments.transbank.webpay.plus.failed', compact('result'));
        }

    }

    public function subscriptionDetailPayment($subscriptionId)
    {

    }

    public function subscriptionDetailCustomerPayment($subscriptionId)
    {

    }

    // public function subscriptionTestPayment($subscriptionId)
    // {
    //     $subscription = PlanSubscription::where('id', $subscriptionId)->first();
    //     return view('vendor.backpack.base.payment.result', compact('subscription'));

    // }

    
}
