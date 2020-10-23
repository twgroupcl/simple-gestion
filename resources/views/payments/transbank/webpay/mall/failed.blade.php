@extends('layouts.base')
@section('content')
@php
$response = json_decode($order->order_payments->first()->json_in);

@endphp

    <div class="content">
        <div class="row mt-5 ">
            <div class="col-8 mx-auto">
                <div class="row">
                    <div class="col-12">
                        <div class="display-4">Recibimos un error al realizar su pago</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="">Motivo

                            @switch($response->data->VCI)
                                @case('TSN'): 'Autenticación fallida'
                                    @break
                                @case('TO'): 'Tiempo máximo excedido para autenticación'
                                    @break
                                @case('ABO'): 'Autenticación abortada por tarjetahabiente'
                                    @break
                                @case('U3'): 'Error interno en la autenticación'
                                    @break
                                @case('NP'): 'No Participa, probablemente por ser una tarjeta extranjera que no participa en el
                                programa 3DSecure'
                                    @break
                                @case('ACS2'): 'Autenticación fallida extranjera'
                                    @break
                                @case('INV'): 'Autenticación inválida'
                                    @break
                                @case('EOP'): ' Error Operativo'
                                    @break
                                @default : 'Error Operativo'
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
