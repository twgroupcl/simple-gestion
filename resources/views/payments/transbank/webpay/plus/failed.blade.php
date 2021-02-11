@extends('layouts.base')
@section('content')

    <div class="content">
        <div class="row mt-5 ">
            <div class="col-8 mx-auto">
                <div class="row">
                    <div class="col-12">

                        <h1 class="woocommerce-thankyou-order-received h4 pb-3 text-center">Lo sentimos , tu operación no pudo ser realizada</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{-- <div class="">Motivo

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
                        </div> --}}

                        <div class="pt-5">
                            <div class="card py-3 mt-sm-3">
                                <div class="card-body text-center">
                                    {{-- <h2 class="h4 pb-3">Gracias por su pedido!</h2>
                                    --}}
                                    <p class="font-size-sm mb-2">Encontramos un error en la operación. por favor intenta nuevamente.
                                    </p>
                                    {{-- <p class="font-size-sm mb-2">Asegúrese de anotar su número de pedido,
                                        que es <span class='font-weight-medium'>#{{ $order->id }}</span></p>
                                    --}}
                                    <!--

                                    <a class="btn btn-primary mt-3"
                                        href="{{ route('transbank.webpayplus.redirect', ['order' => $order]) }}">Intenta nuevamente</a>
                                    -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
