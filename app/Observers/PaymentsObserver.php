<?php

namespace App\Observers;

use App\Models\Payments;
use Illuminate\Support\Arr;
use PhpParser\Node\Stmt\Else_;

class PaymentsObserver
{
    /**
     * Handle the payments "created" event.
     *
     * @param  \App\Payments  $payments
     * @return void
     */
    public function created(Payments $payments)
    {
        //
    }

    /**
     * Handle the payments "updated" event.
     *
     * @param  \App\Payments  $payments
     * @return void
     */
    public function updated(Payments $payments)
    {
    }

    public function updating(Payments $payments)
    {
        $currentDataPayments = Payments::find($payments->id);
        if (isset($payments->data_payment['payment_method'])) {
            if($currentDataPayments->data_payment != null){
                $currentData = $currentDataPayments->data_payment;
                $keyArr = array_keys($currentData);
                $endKey = end($keyArr); 
                $tmpCurrentDataPayment[$endKey] = $payments->data_payment;
                $tmpDataFee[$endKey] = $payments->data_fee;
                $tmpDataFee[$endKey]['data_fee'][$tmpCurrentDataPayment[$endKey]['id_fee']]['status_fee'] = 2;
                $tmpCurrentDataPayment[$endKey]['id_fee'] = $tmpDataFee[$endKey]['data_fee'][$tmpCurrentDataPayment[$endKey]['id_fee']]['id_fee'];
                $arrResult = array_merge($currentData,$tmpCurrentDataPayment);
                $payments->data_payment = $arrResult;
                $payments->data_fee = $tmpDataFee[$endKey];
                $payments->amount_paid += $tmpCurrentDataPayment[$endKey]['amount_payment']; 
                if($payments->amount_paid == $payments->amount_total){
                    $payments->status = 2;
                }
            }else{
                $tmpDataPayment[$payments->data_payment['id_fee']] = $payments->data_payment;
                $tmpDataFee = $payments->data_fee;
                $tmpDataFee['data_fee'][$payments->data_payment['id_fee']]['status_fee'] = 2;
                $idFee = $tmpDataFee['data_fee'][$payments->data_payment['id_fee']]['id_fee'];
                $tmpDataPayment[$payments->data_payment['id_fee']]['id_fee'] = $idFee;
                $payments->amount_paid = $tmpDataFee['data_fee'][$payments->data_payment['id_fee']]['amount'];
                $payments->data_payment = $tmpDataPayment;          
                $payments->data_fee = $tmpDataFee;     
                if($payments->amount_paid == $payments->amount_total){
                    $payments->status = 2;
                }
            } 
        }else{
            $paymentData = $payments->data_payment;
            $paymentData = $currentDataPayments->data_payment;
            $payments->data_payment = $paymentData;
        }
    }

    /**
     * Handle the payments "deleted" event.
     *
     * @param  \App\Payments  $payments
     * @return void
     */
    public function deleted(Payments $payments)
    {
        //
    }

    /**
     * Handle the payments "restored" event.
     *
     * @param  \App\Payments  $payments
     * @return void
     */
    public function restored(Payments $payments)
    {
        //
    }

    /**
     * Handle the payments "force deleted" event.
     *
     * @param  \App\Payments  $payments
     * @return void
     */
    public function forceDeleted(Payments $payments)
    {
        //
    }
}
