@php
use App\Models\Commune;
use App\Models\Product;

$addressData = json_decode($order->json_value);

$addressShipping = null;
if(isset($addressData->addressInvoice)){
    $addressShipping = json_decode($addressData->addressShipping);
}


$addressInvoice = null;
if(isset($addressData->addressInvoice)){
    $addressInvoice = json_decode($addressData->addressInvoice);
}

$communeShipping = null;
$communeInvoice = null;

if($addressShipping){
    $communeShipping = Commune::where('id', $addressShipping->address_commune_id)->first();
}

if($addressInvoice){
    $communeInvoice = Commune::where('id', $addressInvoice->address_commune_id)->first();
}

@endphp
@extends('layouts.base')
@section('content')


    <div class="content">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="row">
                    <div class="col-12">

                        <div class="display-4 text-center">Compra realizada con éxito!</div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-12">

                        <h4 class="">Orden #<strong>{{ $order->id }}</strong> </h4>

                    </div>
                </div>

                <div class="row">
                    @if($addressInvoice)
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12"><strong>Dirección de envío</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-12">{{ $order->first_name . ', ' . $order->last_name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-12">Calle
                                {{ $addressShipping->address_street . ', ' . $addressShipping->address_number . ' ' . $communeShipping->name }}
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($addressShipping)
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12"><strong> Dirección de facturación</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-12">{{ $addressInvoice->first_name . ', ' . $addressInvoice->last_name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-12">Calle
                                {{ $addressInvoice->address_street . ', ' . $addressInvoice->address_number . ' ' . $communeInvoice->name }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                {{-- Products --}}
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12"><strong>Productos</strong></div>
                        </div>
                    </div>
                    @php
                    $total = 0 ;
                    $subtotal = 0;
                    $subtotalshipping = 0;
                    @endphp
                    @foreach ($order->order_items as $item)
                        @php
                        $product = Product::where('id',$item->product_id)->first();
                        $subtotal = ($product->price * $item->qty);
                        $subtotalshipping = $item->shipping_total;
                        $total += ($product->price * $item->qty) + $item->shipping_total;
                        @endphp
                        <div class="col-12">
                            <div class="row mt-3 border-bottom-secondary">
                                <div class="col-md-6 mb-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- //TO-DO url json to image ???? -->
                                            <img class="width-5" src="{{ url($product->getFirstImagePath()) }}">
                                        </div>
                                        <div class="col-md-8">

                                                <span>{{ $product->name }}</span>
                                                <p>Cantidad : {{ $item->qty }}</p>
                                                <p>Precio : {{ currencyFormat($product->price ? $product->price : 0, 'CLP', true)}}</p>
                                                <p>Costo de envio : {{currencyFormat($item->shipping_total? $item->shipping_total: 0 , 'CLP', true)}}</p>
                                            {{-- <div class="col-12">
                                                <span>Cantidad : {{ $item->qty }}</span>
                                                <p> Total ${{ number_format(($product->price * $item->qty), 0, ',', '.') }}</p>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 text-center">
                                    {{-- <p class="fs-1-2">${{ number_format($item->price, 0, ',', '.') }}</p> --}}
                                    {{-- <p> Total ${{ number_format(($product->price * $item->qty), 0, ',', '.') }}</p> --}}
                                    <p>Total {{ currencyFormat(($subtotal + $subtotalshipping) ? ($subtotal + $subtotalshipping) : 0, 'CLP', true)}}</p>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
                {{-- Payment Method --}}
                <div class="row mt-5">

                    <div class="col-12">Método de pago seleccionado: {{ $order->order_payments->first()->method_title }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">Fecha de pago:
                        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_payments->first()->created_at)->format('d/m/Y H:i:s') }}
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-6">Importe Total: ${{ number_format($order->total, 0, ',', '.') }}</div>
                    <div class="col-6"><a href="{{route('transbank.webpayplus.mall.download', ['order' => $order->id])}}" class="btn btn-blue fs-1">Descargar</a></div>
                </div>


            </div>
        </div>
    </div>
@endsection
