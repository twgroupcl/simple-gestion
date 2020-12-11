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

        if ($payments->data_payment['payment_method'] != null) { //Solo datos de cuota
            $tmpDataPayment = ($payments->data_payment['payment_method'])?$payments->getDirty():null;
            $paymentCurrent = json_decode($tmpDataPayment['data_payment']);
            $idFee = json_encode(['id_fee' => 1]);
            $paymentCurrent->id_fee = 1;
            $payments->data_payment = $paymentCurrent;
        }else{

        }


        /* foreach($payments->data_fee['data_fee'] as $key => $data_fee){
            if ($payments->data_payment['date_fee'] == $data_fee['date'] && $payments->data_payment['amount_payment'] == $data_fee['amount']) {
                //$info = ['productos' => ['carro' => ['color' => 'azul']]];
                $arr = $payments->data_fee['data_fee'][$key];
                Arr::set($arr, 'status_fee', '2');
                $payments->data_fee['data_fee'][$key] = $arr;
                //dd($payments->data_fee['data_fee'][$key]);
            }
        }
        dd($payments->data_payment,$payments->data_fee); */



        //$data_payment = ($payments->data_payment['date_fee'] != null)?$payments->data_payment:null;
        //$payments->data_payment = $data_payment;
        //$payments->save();
        //$payments->data_payment = $tmpDataPayment;
       // dd($payments->data_payment['data_payment']);
        //$tmpCurrentDataPayment = collect($payments->data_payment);


        //$tmpCurrentDataPayment->push($tmpDataPayment);
        //$payments->data_payment = $tmpCurrentDataPayment;

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
