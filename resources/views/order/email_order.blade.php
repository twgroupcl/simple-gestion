@php
    $subtotal = 0;
    $totalshipping =0;
    $total = 0 ;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css" media="screen">
        @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
      </style>
    
      <style type="text/css" media="screen">
        @media screen {
          /* Thanks Outlook 2013! */
          * {
            font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
          }
        }
      </style>
    <style>

        body {
            margin: 0px;
            background-color: #fdca00;
            color: #4c4a4a;
        }

        @media (min-width: 1000px) and (max-width: 2000px) {
            .box-container {
                width: 60%;
                margin-left: 20%;
                margin-right: 20%;
            }

            .items {
            width: 70%;
            margin-left: 15%;
            margin-right: 15%;
            padding-top: 30px; 
            }
        }

        @media (min-width: 0px) and (max-width: 550px) {
            .shipping {
                background: white;
                border: 1px solid #dfdfdf;
                border-radius: 4px 4px 4px 4px;
                line-height: 5px;
                height: 130px;
                margin-bottom: 10px;
            }
            
            .order-info {
                background: white;
                border: 1px solid #dfdfdf;
                border-radius: 4px 4px 4px 4px;
                line-height: 5px;
                height: 130px;
                margin-bottom: 10px;
            }

            .items-table tbody {
                line-height: 16px !important;
            }
        }

        @media (min-width: 551px) {
            .shipping {
            width: 47.5%;
            float: left;
            background: white;
            border: 1px solid #dfdfdf;
            border-radius: 4px 4px 4px 4px;
            line-height: 5px;
            height: 122px;
        }

        .order-info {
            width: 47.5%;
            float: right;
            background: white;
            border: 1px solid #dfdfdf;
            border-radius: 4px 4px 4px 4px;
            line-height: 5px;
            height: 122px;
        }
        }
        .container {
            /* width: 1000px; */
        }
        .top {
            background-color: #fdca00;
            min-height: 330px;
            padding-right: 20px;
            padding-left: 20px;
        }

        .top-title {
            font-weight: 600;
            margin: 18px
        }

        .middle {
            min-height: 300px;
            padding-right: 10px;
            padding-left: 10px;
            background: white;
        }

        .bottom {
            background-color: #fdca00;
            height: 30px;
        }

        

        .box-container {
            /* width: 60%;
            margin-left: 20%;
            margin-right: 20%; */
        }

        .top-title {
            text-align: center;
            font-size: 33px;
            color: #2c2c2c;
        }

        .items {
            /* width: 50%;
            margin-left: 25%;
            margin-right: 25%; */
            padding-top: 30px; 
        }

        thead td {
            text-align: left;
            border-bottom: 1px solid #cccccc;
            color: #4d4d4d;
            font-weight: 700;
            padding-bottom: 6px;
        }

        .items-table tbody {
            line-height: 7px;
            font-size: 14px;
        }

        .summary {
            text-align: end;
        }

        .title-1 {
            padding: 5px 0;
            font-size: 18px;
            line-height: 1.3;
            color: #4d4d4d;
            font-weight: 700;
        }
    </style>
</head>
<body bgcolor="#fdca00">
    <div class="container">
        <div class="top">

            <div style="text-align: center; margin-bottom: 10px; margin-top: 15px;">
                <img src="{{ asset('img/covepa-logo.png') }}" alt="" height="100px">
            </div>
            <div class="top-title">
                <span class="">{{ $title }}</span>
            </div>
    
            <div class="top-description">
            </div>
    
            <div class="box-container">
                <div class="shipping">
                    <div style="padding: 10px;">
                        @if ($order->order_items->first()->shipping->code === 'picking')
                        <span class="title-1">Persona que retira</span>
                        @else
                        <span class="title-1">Dirección de envío</span>
                        @endif
                        
                        <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                        <p>{{ $shippingInfo->address_street }} {{ $shippingInfo->address_number }} {{ $shippingInfo->address_office }}</p>
                        <p>{{ $communeShipping->name }}</p>
                        <p>{{ $order->phone }}</p>
                    </div>
                    
                </div>
                <div class="order-info">
                    <div style="padding: 10px;">
                        <span class="title-1">Orden #{{ $order->id }}</span>
                        <p>Fecha {{ $order->created_at->format('d-m-Y') }}</p>
                        <p>Metodo de pago: {{ $order->order_payments->first()->method_title }}</p>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="middle">
            <div class="items">
                <table style="width: 100%" class="items-table">
                    <thead>
                        <tr>
                            <td colspan="2">Producto</td>
                            <td>Cant.</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($order->order_items as $item)

                        @php
                            $product = App\Models\Product::where('id',$item->product_id)->first();
                            $subtotal = ($product->price * $item->qty);
                            $subtotalshipping = $item->shipping_total;
                            $total += ($product->price * $item->qty) + $item->shipping_total;
                        @endphp

                        <tr>
                            <td>
                                <img src="{{ asset($item->product->getFirstImagePath()) }}" width="80px">
                            </td>

                            <td>
                                <p>{{ $item->name }}</p>
                                <p>{{ currencyFormat($item->price ? $item->price : 0, 'CLP', true) }}</p>
                                @if ($item->shipping)
                                    <p>{{ $item->shipping->title }}</p>
                                @endif
                            </td>

                            <td>{{ $item->qty }}</td>
                            <td>{{ currencyFormat($item->price * $item->qty, 'CLP', true)}}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>

                <div class="summary">
                    <div style="display: inline-block; padding: 15px">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>{{ currencyFormat($order->sub_total ? $order->sub_total : 0, 'CLP', true) }}</td>
                                </tr>
                                @if ($order->shipping_total)
                                <tr>
                                    <td>Envio</td>
                                    <td>{{ currencyFormat($order->shipping_total ? $order->shipping_total : 0, 'CLP', true) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td>{{ currencyFormat($order->total ? $order->total : 0, 'CLP', true) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
    
            
        </div>
    
        <div class="bottom"></div>
    </div>

</body>
</html>