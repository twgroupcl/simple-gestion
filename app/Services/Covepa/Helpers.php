<?php

namespace App\Services\Covepa;

use Carbon\Carbon;
use App\Models\Order;

class Helpers {

    /**
     * Mapeo con el tipo de pago con Covepa
     * 10 transferencia
     * 15 tarj credito
     * 26 tarje debito
     */
    const TYPE_PAYMENT_MAPPING = [
        'VD' => 26,
        'VN' => 15,
        'VC' => 15,
        'SI' => 15,
        'S2' => 15,
        'NC' => 15,
        'VP' => 15,
    ];

    public static function getPaymentArray(Order $order) : array
    {
        $payment = $order->order_payments->first(); 
        $rut = str_replace('.', '', $order->uid);
        $rut = str_replace('-', '', $rut);

        if ($payment->method === 'tbkplus') {
            $details = json_decode($payment->json_in, true);
            $authCode = (int) $details['data']['detailOutput']['authorizationCode'];
            $quotes = $details['data']['detailOutput']['sharesNumber'] == 0 ? 1 : $details['data']['detailOutput']['sharesNumber'];
            $paymentType = self::TYPE_PAYMENT_MAPPING[$details['data']['detailOutput']['paymentTypeCode']];   
        }

        return [
            [ 
                "FORPGO_CODIGO" => $paymentType,
                "VTAPGO_CORREL" => 1,
                "VTAPGO_MONPGO" => (double) $order->total,
                "VTAPGO_NCUOTA" => $quotes, // numero de cuotas
                "VTAPGO_FECUOT" => Carbon::now()->format('d/m/Y'), // fecha primera cuota
                "VTAPGO_NRDCPG" => $authCode, // Confirmar si es autorizacion de transbank
                "SUJETO_RUTDUE" => $rut, // Rut cliente que paga @todo sanitizar
                "SUJETO_RUTSUJ" => $rut // Rut del documento de venta
            ]
        ];
    }
}