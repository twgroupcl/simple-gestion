@php
use App\Models\Commune;
use App\Models\Product;

/* $addressData = $order->json_value;


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
 */


 $company = $seller->company;
 $customerAddress = $order->customer()->first()->addresses()->first();

@endphp
{{--
@extends('layouts.print')
@push('styles') --}}

{{-- @endpush --}}
{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
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

    </style>
</head>
<body class="m-0 p-0">
     {{-- Seller    --}}
     <div class="row">
         <div class="col-12">
             {{$company->name}}
         </div>
     </div>
     <div class="row">
        <div class="col-12">
            {{$company->uid}}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            Giro: Procesamiento de datos, hospedaje
            y actividades conexas
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            Limache 3421, oficina 703, Viña del Mar
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            BOLETA ELECTRÓNICA N° {{$order->id}}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            Fecha: {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('j/m/Y') }}
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-12">
           Receptor: {{$order->uid}}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {{$order->first_name . ' ' .$order->last_name}}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {{ $customerAddress->street . ' '. $customerAddress->number .' ('. $customerAddress->commune->name.')'}}
        </div>
    </div>

    <br>
    <br>
            <div>
                @php
                $total = 0 ;
                $subtotal = 0;
                $subtotalshipping = 0;
                @endphp
                @foreach ($items as $item)

                    @php
                    $product = Product::where('id',$item->product_id)->first();
                    // $subtotal += ($item->price * $item->qty);
                    // $subtotalshipping += ($item->shipping_total * $item->qty) ;
                    // $total += ($item->price * $item->qty) + ($item->shipping_total * $item->qty);
                    @endphp
                    <div class="row " style="display:flex;">
                        <div class="col-10" >
                            {{-- <p> {{$product->seller->visible_name}}</p> --}}
                            {{ $product->name }}
                            {{-- <img class="width-5" src="{{ public_path() . '/' . $product->getFirstImagePath() }}" width="15%"> --}}
                        </div>
                        {{-- <td width="40%" class="product-item">
                            <p><strong>Precio : </strong>{{ currencyFormat($item->price ? $item->price : 0, 'CLP', true) }}
                            </p>
                            <p><strong>Cantidad : </strong>{{ $item->qty }}</p>

                        </td> --}}
                        <div class="col-2" style="text-align: right" >
                            {{ currencyFormat($item->price * $item->qty + $item->shipping_total * $item->qty ? $item->price * $item->qty + $item->shipping_total * $item->qty : 0, 'CLP', true) }}

                        </div>
                    </div>
                    <br>
                    <br>
                @endforeach
                <div class="row m-0 p-0"  style="display:flex;">
                    <div class="col-6" align="left">
                        <strong>NETO :</strong>
                    </div>
                    <div class="col-6" style="text-align: right" >
                        <strong> {{ currencyFormat($order->sub_total ? $order->sub_total : 0, 'CLP', true) }}</strong>
                    </div>
                </div>
                <div class="row m-0 p-0"  style="display:flex;">
                    <div class="col-6" align="left">
                        <strong>IVA :</strong>
                    </div>
                    <div class="col-6" style="text-align: right" >
                        <strong> {{ currencyFormat(($order->total - $order->sub_total) ? ($order->total - $order->sub_total) : 0, 'CLP', true) }}</strong>
                    </div>
                </div>
                <div class="row m-0 p-0"  style="display:flex;">
                    <div class="col-6" align="left">
                        <strong>TOTAL :</strong>
                    </div>
                    <div class="col-6" style="text-align: right" >
                        <strong> {{ currencyFormat($order->total ? $order->total : 0, 'CLP', true) }}</strong>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <img src="{{public_path().'/img/misc/bar-code.png'}}" alt="">
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center" style="text-align:center;">
                   <p>
                    Timbre Electrónico SII<br>
                    Resolución 0 de 2019<br>
                    Verifique documento:<br>
                    www.sii.cl
                   </p>
                </div>
            </div>

</body>
</html>
