@php
use App\Models\Product;
@endphp
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Neopolitan Invoice Email</title>
    <!-- Designed by https://github.com/kaytcat -->
    <!-- Robot header image designed by Freepik.com -->

    <style type="text/css">
        @import url(http://fonts.googleapis.com/css?family=Droid+Sans);

        /* Take care of image borders and formatting */

        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a {
            text-decoration: none;
            border: 0;
            outline: none;
            color: #bbbbbb;
        }

        a img {
            border: none;
        }

        /* General styling */

        td,
        h1,
        h2,
        h3 {
            font-family: Helvetica, Arial, sans-serif;
            font-weight: 400;
        }

        td {
            text-align: center;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100%;
            height: 100%;
            color: #37302d;
            background: #ffffff;
            font-size: 16px;
        }

        table {
            border-collapse: collapse !important;
        }

        .headline {
            color: #ffffff;
            font-size: 36px;
        }

        .force-full-width {
            width: 100% !important;
        }

        .force-width-80 {
            width: 80% !important;
        }

        .direccion-facturacion-titulo {
            margin-botom: 5px;
        }

        .direccion-envio-titulo {
            margin-botom: 5px;
        }

    </style>

    <style type="text/css" media="screen">
        @media screen {

            /*Thanks Outlook 2013! http://goo.gl/XLxpyl*/
            td,
            h1,
            h2,
            h3 {
                font-family: 'Droid Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
            }
        }

    </style>

    <style type="text/css" media="only screen and (max-width: 480px)">
        /* Mobile styles */
        @media only screen and (max-width: 480px) {

            table[class="w320"] {
                width: 320px !important;
            }

            td[class="mobile-block"] {
                width: 100% !important;
                display: block !important;
            }


        }

    </style>
</head>

<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none"
    bgcolor="#ffffff">
    <table class="force-full-width" cellspacing="0" cellpadding="0" align="center">
        <tbody>
            <tr>
                <td align="center" valign="top" bgcolor="#ffffff" width="100%">
                    <center>
                        <table class="w320" style="margin: 0 auto;" width="600" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top">
                                        <table class="force-full-width" style="margin: 0 auto;" cellspacing="0"
                                            cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td style="font-size: 30px; text-align: center;"><br /><img
                                                            src="{{ asset('img/logos/logo-crcp.png') }}"
                                                            alt="CRCP" /><br /><br /></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="force-full-width" style="margin: 0 auto;padding-top:15px;"
                                            cellspacing="0" cellpadding="0" bgcolor="#f5774e">
                                            <tbody>
                                                <tr style="padding-top:15px;">
                                                    <td> <br><br> </td>
                                                </tr>
                                                <tr style="padding-top:15px;">
                                                    <td> <img src="{{ asset($logo) }}" alt="" width="" height="" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="headline">{{ $title }}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <!-- [if mso]>
                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#178f8f">
                          <w:anchorlock/>
                          <center>
                        {{-- <![endif]--> <a
                                                                style="background-color: #178f8f; border-radius: 4px; color: #ffffff; display: inline-block; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; line-height: 50px; text-align: center; text-decoration: none; width: 200px; -webkit-text-size-adjust: none;"
                                                                href="../../../">My Account</a>
                                                            <!-- [if mso]>
                          </center> --}}
                        </v:roundrect>
                      <![endif]-->
                                                        </div>
                                                        <br /><br />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="force-full-width" style="margin: 0 auto;padding-top:15px;"
                                            cellspacing="0" cellpadding="0" bgcolor="#f5774e">
                                            <tbody>
                                                <tr style="padding-top:15px;">
                                                    <td>
                                                        <table class="force-width-80" style="margin: 0 auto;"
                                                            cellspacing="0" cellpadding="0" bgcolor="#f5774e">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="headline">Orden #{{ $orderData['id'] }}
                                                                    </td>
                                                                    <td style="text-align: right">
                                                                        <strong>Fecha </strong>{{ $orderData['fecha'] }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="force-full-width" style="margin: 0 auto;" cellspacing="0"
                                            cellpadding="0" bgcolor="#f5774e">
                                            <tbody>
                                                <tr>
                                                    <td style="background-color: #f5774e;">
                                                        <center>
                                                            <table class="force-width-80" style="margin: 0 auto;"
                                                                cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td width="50%">
                                                                        @if ($addressShipping)
                                                                            <div class="direccion-envio-titulo">
                                                                                <p><strong>Dirección de envío</strong>
                                                                                </p>
                                                                            </div>
                                                                            <p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">
                                                                                RUT: {{ $orderData['uid'] }}
                                                                            </p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">
                                                                                {{ $orderData['first_name'] . ' ' . $orderData['last_name'] }}
                                                                            </p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">
                                                                                {{ $addressShipping->address_street . ' ' . $addressShipping->address_number . ' ' . $addressShipping->address_office }}
                                                                            </p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">
                                                                                {{ $communeShipping->name }}
                                                                            </p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">
                                                                                Teléfono: {{ $orderData['cellphone'] }}
                                                                            </p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">
                                                                                {{ $orderData['email'] }}
                                                                            </p>
                                                                            </p>
                                                                        @endif
                                                                    </td>
                                                                    <td width="50%">
                                                                        @if ($addressInvoice && $addressInvoice->address_street)
                                                                            <div class="direccion-facturacion-titulo">
                                                                                <p><strong>Direccion de facturación
                                                                                    </strong></p>
                                                                            </div>
                                                                            <p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">
                                                                                RUT: {{ $addressInvoice->uid }}
                                                                            </p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">
                                                                                {{ $addressInvoice->first_name . ' ' . $addressInvoice->last_name }}
                                                                            </p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">
                                                                                {{ $addressInvoice->address_street . ' ' . $addressInvoice->address_number . ' ' . $addressInvoice->address_office }}
                                                                            </p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">
                                                                                @if ($communeInvoice)
                                                                                    {{ $communeInvoice->name }}
                                                                                @endif
                                                                            </p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">
                                                                                Teléfono:
                                                                                {{ $addressInvoice->cellphone }}
                                                                            </p>
                                                                            <p
                                                                                style="margin-left: 10px;text-align: left">

                                                                                {{ $addressInvoice->email }}
                                                                            </p>
                                                                            </p>
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                            <table class="force-width-80" style="margin: 0 auto;"
                                                                cellspacing="0" cellpadding="0">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="30%"
                                                                            style="color: #ffffff; background-color: #ac4d2f; padding: 10px 0px;">
                                                                            Producto </th>
                                                                        <th width="10%"
                                                                            style="color: #ffffff; background-color: #ac4d2f; padding: 10px 0px;">
                                                                            Cant. </th>
                                                                        <th width="15%"
                                                                            style="color: #ffffff; background-color: #ac4d2f; padding: 10px 0px;">
                                                                            Precio </th>
                                                                        <th width="15%"
                                                                            style="color: #ffffff; background-color: #ac4d2f; padding: 10px 0px;">
                                                                            Envío </th>
                                                                        <th width="30%"
                                                                            style="color: #ffffff; background-color: #ac4d2f; padding: 10px 0px;">
                                                                            Subtotal </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    {{-- <tr>
                                                                        <td class="mobile-block"><br /><br />
                                                                            <table class="force-full-width"
                                                                                cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td
                                                                                            style="color: #ffffff; background-color: #ac4d2f; padding: 10px 0px;">
                                                                                            Plan</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td
                                                                                            style="color: #933f24; padding: 10px 0px; background-color: #f7a084;">
                                                                                            Silver Plan</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td class="mobile-block"><br /><br />
                                                                            <table class="force-full-width"
                                                                                cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td
                                                                                            style="color: #ffffff; background-color: #ac4d2f; padding: 10px 0px;">
                                                                                            Period</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td
                                                                                            style="color: #933f24; padding: 10px 0px; background-color: #f7a084;">
                                                                                            August</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td class="mobile-block"><br /><br />
                                                                            <table class="force-full-width"
                                                                                cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td
                                                                                            style="color: #ffffff; background-color: #ac4d2f; padding: 10px 0px;">
                                                                                            Amount</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td
                                                                                            style="color: #933f24; padding: 10px 0px; background-color: #f7a084;">
                                                                                            $50.00</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr> --}}
                                                                    @php

                                                                    $subtotal = 0;
                                                                    $totalshipping =0;
                                                                    $total = 0 ;
                                                                    @endphp
                                                                    @foreach ($orderItems as $item)
                                                                        @php
                                                                        $product =
                                                                        Product::where('id',$item->product_id)->first();
                                                                        $subtotal += $item->sub_total;
                                                                        $totalshipping += $item->shipping_total;
                                                                        $total += $item->sub_total +
                                                                        $item->shipping_total;
                                                                        @endphp
                                                                        <tr>
                                                                            <td class="mobile-block"
                                                                                style="word-wrap: break-word;">
                                                                                <span
                                                                                style="font-size: 12px; word-wrap: break-word;">
                                                                                {{ $product->seller->name }}</span>
                                                                                <br>
                                                                                <img src="{{ asset($product->getFirstImagePath()) }}"
                                                                                    width="15%"> <br />
                                                                                <span
                                                                                    style="font-size: 12px; word-wrap: break-word;">
                                                                                    {{ $product->name }}</span>
                                                                            </td>
                                                                            <td class="mobile-block">
                                                                                {{ $item->qty }}
                                                                            </td>
                                                                            <td class="mobile-block"
                                                                                style="text-align: right">
                                                                                {{ currencyFormat($item->price ? $item->price : 0, 'CLP', true) }}
                                                                            </td>
                                                                            <td class="mobile-block"
                                                                                style="text-align: center; font-size: 0.8em">
                                                                                @if ($item->shipping_total == 0)
                                                                                    <br>
                                                                                    @if ($item->shipping_method)
                                                                                        ({{ $item->shipping_method->title }})
                                                                                    @endif

                                                                                @else
                                                                                    @if ($item->shipping_method)
                                                                                        ({{ $item->shipping_method->title }})
                                                                                    @endif
                                                                                    {{ currencyFormat($item->shipping_total ? $item->shipping_total : 0, 'CLP', true) }}
                                                                                @endif

                                                                            </td>
                                                                            <td class="mobile-block"
                                                                                style="text-align: right">
                                                                                {{ currencyFormat($item->sub_total + $item->shipping_total ? $item->sub_total + $item->shipping_total : 0, 'CLP', true) }}
                                                                            </td>
                                                                        </tr>

                                                                    @endforeach
                                                                    <tr>
                                                                        <td colspan="4" style="text-align: right">

                                                                        </td>
                                                                        <td style="text-align: right">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4" style="text-align: right">

                                                                        </td>
                                                                        <td style="text-align: right">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4" style="text-align: right">
                                                                            <strong>Subtotal</strong>
                                                                        </td>
                                                                        <td style="text-align: right">
                                                                            {{ currencyFormat($subtotal ? $subtotal : 0, 'CLP', true) }}
                                                                        </td>
                                                                    </tr>
                                                                    @if($totalshipping > 0)
                                                                    <tr>
                                                                        <td colspan="4" style="text-align: right">
                                                                            <strong>Envío</strong>
                                                                        </td>
                                                                        <td style="text-align: right">
                                                                            {{ currencyFormat($totalshipping ? $totalshipping : 0, 'CLP', true) }}
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <td colspan="4" style="text-align: right">
                                                                            <strong>Total</strong>
                                                                        </td>
                                                                        <td style="text-align: right">
                                                                            {{ currencyFormat($total ? $total : 0, 'CLP', true) }}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            @if ($paymentData)
                                                                <table class="force-width-80" style="margin: 0 auto;"
                                                                    cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td
                                                                                style="color: #933f24; text-align: left; border-bottom: 1px solid #933f24;">
                                                                                <br /><br />
                                                                                Método de pago seleccionado:
                                                                                <br /><br />
                                                                            </td>
                                                                            <td
                                                                                style="color: #933f24; text-align: left; border-bottom: 1px solid #933f24;">
                                                                                <br /><br />
                                                                                {{ $paymentData['title'] }}
                                                                                <br /><br />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td
                                                                                style="color: #933f24; text-align: left; border-bottom: 1px solid #933f24;">
                                                                                <br /><br />
                                                                                Fecha de pago:
                                                                                <br /><br />
                                                                            </td>
                                                                            <td
                                                                                style="color: #933f24; text-align: left; border-bottom: 1px solid #933f24;">
                                                                                <br /><br />
                                                                                {{ $paymentData['date'] }}
                                                                                <br /><br />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td
                                                                                style="color: #933f24; text-align: left; border-bottom: 1px solid #933f24;">
                                                                                <br /><br />
                                                                                Importe Total:
                                                                                <br /><br />
                                                                            </td>
                                                                            <td
                                                                                style="color: #933f24; text-align: left; border-bottom: 1px solid #933f24;">
                                                                                <br /><br />
                                                                                {{ $paymentData['total'] }}
                                                                                <br /><br />
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            @endif
                                                            @if ($shippingMessage)
                                                                <table class="force-width-80" style="margin: 0 auto;"
                                                                    cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td
                                                                                style="text-align: left; color: #933f24;">

                                                                                <br /><br /><br />
                                                                                {{ $shippingMessage }}
                                                                                <br /><br /><br />
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            @endif
                                                        </center>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="force-full-width" style="margin: 0px auto; height: 75px;"
                                            cellspacing="0" cellpadding="0" bgcolor="#414141">
                                            <tbody>
                                                <tr style="height: 19px;">
                                                    <td style="background-color: #414141; height: 19px; width: 600px;">
                                                        &nbsp;</td>
                                                </tr>
                                                {{-- <tr style="height: 28px;">
                                                    <td
                                                        style="color: #bbbbbb; font-size: 12px; height: 28px; width: 600px;">
                                                        <a href="#">Ver en navegador</a><br /><br />
                                                    </td>
                                                </tr> --}}
                                                <tr style="height: 28px;">
                                                    <td
                                                        style="color: #bbbbbb; font-size: 12px; height: 28px; width: 600px;">
                                                        &copy; 2020 Todos los derechos reservados -
                                                        {{ config('app.name') }}<br /><br />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </center>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
