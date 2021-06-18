@php
use App\Models\Commune;
use App\Models\Product;

$addressData = $order->json_value;


$addressShipping = null;
if(isset($addressData['addressShipping'])){
$addressShipping = $addressData['addressShipping'];
}


$addressInvoice = null;
if(isset($addressData['addressInvoice']) && !empty($addressData['addressInvoice']->first_name)){
$addressInvoice = $addressData['addressInvoice'];
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
{{--
@extends('layouts.print')
@push('styles') --}}
<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }

    table {
        font-size: x-small;
    }

    tfoot tr td {
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: lightgray
    }

    .h3-titulo {
        margin-bottom: 2px;
    }

    .p-estrecho {
        line-height: 5px;
    }

    .item-description {
        font-size: 9px;
        color: #746666;
    }

    .direccion-facturacion-titulo {
        margin-botom: 5px;
    }

    .direccion-envio-titulo {
        margin-botom: 5px;
    }

    .notas {
        margin-top: 0px;
        margin-left: 15px;
    }

    .tabla-totales {
        margin-top: 300px;
    }

    .top-td {
        vertical-align: top;
    }

    .bottom-table {
        margin-top: 20px;
    }

    .product-item {
        border-top: 1px solid lightgray;
    }

    .border-table {
        border: 1px solid lightgray;
    }

    .footer-data {
        position: absolute;
        left: 0;
        bottom: -10;
        width: 100%;
        text-align: center;
    }

    .resume-table {
        background: #f6f9fc;
        width: 100%;
        font-size: 15px;
        border-radius: 4px 4px 4px 4px;
        padding: 20px;
        margin-top: 35px;
        margin-bottom: 35px;
    }
    
    .address-section {
        border: 1px solid #e3e9ef !important;
        border-radius: 0.4375rem;
        padding-left: 15px;
        margin: 5px;
    }

</style>
{{-- @endpush --}}
{{-- @section('content') --}}


<div style="background: #FDCA00; height: 80px; padding-top: 25px; padding-left: 10px">
    <img src="{{ public_path() . '/img/covepa-logo.png' }}" alt="Covepa" height="60px">
</div>

<table width="100%" style="margin-top: 25px;">
    <tr>

        <td width="70%">

            <h3 class="h3-titulo">{{ 'Orden #' . $order->id }}</h3>
        </td>
        <td width="30%">
            <p class="p-estrecho"><strong>Fecha </strong>: {{ $order->created_at->format('d/m/Y H:i:s') }}
            </p>
        </td>
    </tr>

</table>

<br>

<table width="100%" cellspacing="5px">
    <tr>
        <td width="50%"class="address-section" >
            @if ($addressShipping)
                @if ($order->order_items->first()->shipping->code === 'picking')
                <div class="direccion-facturacion-titulo">
                    <p><strong>Persona que retira</strong></p>
                    <p>
                        <p class="p-estrecho">{{ $order->pickup_person_info['uid'] ?? '' }}</p>
                        <p class="p-estrecho">{{ $order->pickup_person_info['name'] ?? '' }}</p>
                        <p class="p-estrecho">{{ $order->pickup_person_info['email'] ?? '' }}</p>
                        <p class="p-estrecho">Teléfono: {{ $order->pickup_person_info['phone'] ?? '' }}</p>
                    </p>
                </div>
                @else
                <div class="direccion-facturacion-titulo">
                    <p><strong>Dirección de envío</strong></p>
                    <p>
                        <p class="p-estrecho">{{ $order->first_name . ', ' . $order->last_name }}</p>
                        <p class="p-estrecho">{{ $addressShipping->address_street . ', ' . $addressShipping->address_number }}</p>
                        <p class="p-estrecho">{{ $communeShipping->name }}</p>
                        <p class="p-estrecho">Teléfono: {{ $order->phone }}</p>
                    </p>
                </div>
                @endif
            @endif
        </td>
        <td width="50%"  @if ($addressInvoice)  class="address-section" @endif>
            @if ($addressInvoice)
                <div class="direccion-facturacion-titulo">
                    <p><strong>Direccion de facturación </strong></p>
                </div>
                <p>
                <p class="p-estrecho">{{ $addressInvoice->first_name . ', ' . $addressInvoice->last_name }}</p>
                <p class="p-estrecho">{{ $addressInvoice->address_street . ', ' . $addressInvoice->address_number }}</p>
                <p class="p-estrecho">
                    @if ($communeInvoice) 
                    {{ $communeInvoice->name }}
                    @endif
                </p>
                <p class="p-estrecho">Teléfono: {{ $addressInvoice->phone }}</p>
                </p>
            @endif
        </td>
    </tr>

</table>   

<h3 class="h3-titulo"> Productos</h3>
<table width="100%">
    @php
    $total = 0 ;
    $subtotal = 0;
    $subtotalshipping = 0;
    @endphp
    @foreach ($order->order_items as $item)
        @php
        $product = Product::where('id',$item->product_id)->first();
        // $subtotal += ($item->price * $item->qty);
        // $subtotalshipping += ($item->shipping_total * $item->qty) ;
        // $total += ($item->price * $item->qty) + ($item->shipping_total * $item->qty);
        @endphp
        <tr class="product-item">
            <td width="15%" class="product-item">
                
                <img class="width-5" src="{{ public_path() . '/' . $product->getFirstImagePath() }}" width="80%">
            </td>
            <td width="40%" class="product-item" style="line-height: 5px">
                <p> {{$product->seller->visible_name}}</p>
                <p><strong>{{ $product->name }}</strong></p>
                <p><strong>Precio : </strong>{{ currencyFormat($item->price ? $item->price : 0, 'CLP', true) }}
                </p>
                <p><strong>Cantidad : </strong>{{ $item->qty }}</p>
                @if($product->is_service == 0)
                <p><strong>Envío :</strong>
                    {{ $item->shipping->title ?? '' }}
                    {{-- @if ($item->shipping_total == 0)
                        {{ $item->shipping->title ?? '' }}
                    @else
                        {{ currencyFormat($item->shipping_total ? $item->shipping_total : 0, 'CLP', true) }}
                    @endif --}}
                </p>
                @endif
            </td>
            <td width="30%" align="right" class="product-item">
                <p> {{ currencyFormat($item->price * $item->qty + $item->shipping_total * $item->qty ? $item->price * $item->qty + $item->shipping_total * $item->qty : 0, 'CLP', true) }}
                </p>
            </td>
        </tr>
    @endforeach
</table>

<div style="padding-right: 50px; padding-left: 50px">
    <table class="resume-table">
        <tbody>
            <tr>
                <td><strong>Subtotal</strong></td>
                <td style="text-align: right"><strong>{{ currencyFormat($order->sub_total ? $order->sub_total : 0, 'CLP', true) }}</strong></td>
            </tr>
            @if ($order->shipping_total != 0)
            <tr>
                <td><strong>Envío</strong></td>
                <td style="text-align: right"><strong>{{ currencyFormat($order->shipping_total ? $order->shipping_total : 0, 'CLP', true) }}</strong></td>
            </tr>
            @endif
            <tr>
                <td><strong>Método de pago</strong></td>
                <td style="text-align: right"><strong>{{ $order->order_payments->first()->method_title }}</strong></td>
            </tr>
            <tr>
                <td><strong>Tipo de despacho</strong></td>
                <td style="text-align: right"><strong>{{ $order->order_items->first()->shipping->title }}</strong></td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td style="text-align: right"><strong>{{ currencyFormat($order->total ? $order->total : 0, 'CLP', true) }}</strong></td>
            </tr>
        </tbody>
    </table>
</div>



</section>
<br />
<br />
<h3> Datos de pago</h3>
<table width="100%" class="border-table">
    <tr>
        <td width="100%">
            <p><strong>Fecha de
                    pago:
                </strong>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_payments->first()->created_at)->format('d/m/Y H:i:s') }}
            </p>
        </td>
    </tr>
    <tr>
        <td width="100%">
            <p><strong>Importe Total: </strong> {{ currencyFormat($order->total ? $order->total : 0, 'CLP', true) }}</p>
        </td>
    </tr>
</table>
<div class="footer-data">
    COVEPA
</div>
