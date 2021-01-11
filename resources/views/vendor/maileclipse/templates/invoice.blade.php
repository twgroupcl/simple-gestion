<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Plain Jane Text</title>
    <style type="text/css">
        /* Based on The MailChimp Reset INLINE: Yes. */
        /* Client-specific Styles */
        #outlook a {
            padding: 0;
        }

        /* Force Outlook to provide a "view in browser" menu link. */
        body {
            width: 100% !important;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        /* Prevent Webkit and Windows Mobile platforms from changing default font sizes.*/
        .ExternalClass {
            width: 100%;
        }

        /* Force Hotmail to display emails at full width */
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        /* Forces Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */
        #backgroundTable {
            margin: 0;
            padding: 0;
            width: 100% !important;
            line-height: 100% !important;
        }

        /* End reset */
        /* Some sensible defaults for images
          Bring inline: Yes. */

        img {
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a img {
            border: none;
        }

        .image_fix {
            display: block;
        }

        /* Yahoo paragraph fix
          Bring inline: Yes. */
        p {
            margin: 1em 0;
        }

        /* Hotmail header color reset
          Bring inline: Yes. */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: black !important;
        }

        h1 a,
        h2 a,
        h3 a,
        h4 a,
        h5 a,
        h6 a {
            color: blue !important;
        }

        h1 a:active,
        h2 a:active,
        h3 a:active,
        h4 a:active,
        h5 a:active,
        h6 a:active {
            color: red !important;
            /* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
        }

        h1 a:visited,
        h2 a:visited,
        h3 a:visited,
        h4 a:visited,
        h5 a:visited,
        h6 a:visited {
            color: #000;
            color: purple !important;
            /* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */
        }

        /* Outlook 07, 10 Padding issue fix
          Bring inline: No.*/
        table td {
            border-collapse: collapse;
        }

        /* Remove spacing around Outlook 07, 10 tables
          Bring inline: Yes */
        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }


        /* Global */
        * {
            margin: 0;
            padding: 0;
        }

        body {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            width: 100% !important;
            height: 100%;
            font-family: Cambria, Utopia, "Liberation Serif", Times, "Times New Roman", serif;
            font-weight: 400;
            font-size: 100%;
            line-height: 1.6;
        }

        /* Styling your links has become much simpler with the new Yahoo.  In fact, it falls in line with the main credo of styling in email and make sure to bring your styles inline.  Your link colors will be uniform across clients when brought inline.
          Bring inline: Yes. */
        a {
            color: #348eda;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        p,
        ul,
        ol {
            /* This fixes Gmail's terrible text rendering  */
            font-family: Cambria, Utopia, "Liberation Serif", Times, "Times New Roman", serif;
            font-weight: 400;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            margin: 20px 0 10px;
            color: #000;
            line-height: 1.2;
        }

        h1 {
            font-size: 32px;
        }

        h2 {
            font-size: 26px;
        }

        h3 {
            font-size: 22px;
        }

        h4 {
            font-size: 18px;
        }

        h5 {
            font-size: 16px;
        }

        p,
        ul,
        ol {
            margin-bottom: 10px;
            font-weight: normal;
            font-size: 16px;
            line-height: 1.4;
        }

        ul li,
        ol li {
            margin-left: 5px;
            list-style-position: inside;
        }

        /* Body */
        table.body-wrap {
            width: 100%;
            padding: 30px;
        }


        /* Footer */
        table.footer-wrap {
            width: 100%;
            clear: both !important;
        }

        .footer-wrap .container p {
            font-size: 12px;
            color: #666;
        }

        table.footer-wrap a {
            color: #999;
        }


        /* Give it some responsive love */
        .container {
            display: block !important;
            max-width: 600px !important;
            margin: 0 auto !important;
            /* makes it centered */
            clear: both !important;
        }

        /* Set the padding on the td rather than the div for Outlook compatibility */
        .body-wrap .container {
            padding: 30px;
        }

        /* This should also be a block element, so that it will fill 100% of the .container */
        .content {
            max-width: 600px;
            margin: 0 auto;
            display: block;
        }

        /* Let's make sure tables in the content area are 100% wide */
        .content table {
            width: 100%;
        }

        body {
            background: #f2f2f2;
            font-family: museoRounded, Roboto, Helvetica, Arial, sans-serif;
            font-weight: 300;
            font-size: 16px;
            color: #323E4D;
            width: 1100px;
            margin: 0 auto;
        }

        #header {
            margin-top: 50px;
            float: left;
            width: 250px;
            padding-right: 50px;
        }

        #header .logo {
            padding-bottom: 10px;
        }

        #header .logo img {
            object-fit: contain;
            object-position: left;
        }

        #content {
            margin-top: 50px;
            word-wrap: break-word;
            width: 100%;
        }

        #merchant_data {
            font-weight: 300;
            line-height: 1.5em;
            word-wrap: break-word;
        }

        #receipt_data_table {
            width: 375px;
            float: left;
            margin-right: 75px;
        }

        #elv_data_table {
            float: right;
            width: 250px;
            text-align: right;
        }

        #elv_data_table td:last-child {
            width: 125px;
        }

        #card_data {
            width: 250px;
            float: right;
            text-align: right;
        }

        #signature {
            width: 50%;
            margin: auto;
        }

        #signature img {
            width: 100%;
            height: 100%;
        }

        #signature_text {
            font-weight: 300;
        }

        #declaration {
            font-weight: 300;
            margin: auto;
            text-align: center;
            line-height: 1.5em;
        }

        #declaration_elv {
            font-weight: 300;
            margin: auto;
            font-size: 0.75em;
            line-height: 1.5em;
        }

        #footer {
            margin-top: 10px;
            margin-bottom: 10px;
            font-weight: 300;
            padding-left: 50px;
            padding-right: 50px;
        }

        #footer .logo {
            width: 100px;
            height: 40px;
        }

        #footer>a {
            text-decoration: none;
            color: #5C8BCC;
        }

        .logo img,
        .logo svg {
            width: 100%;
            height: 100%;
        }

        .tx-headers {
            font-weight: 500;
            font-size: 1.5em;
            color: #fe696a;
            line-height: 1.25em;
        }

        .tx-time {
            font-weight: 300;
            line-height: 1.5em;
        }

        .amount {
            padding-top: 2%;
            padding-bottom: 2%;
            clear: both;
            font-weight: 300;
        }

        .amount_name {
            text-align: left;
            font-weight: 500;
        }

        .amount_value {
            text-align: right;
            font-weight: 500;
        }

        #amounts {
            width: 100%;
            border-collapse: collapse;
        }

        #amounts td {
            padding-top: 1%;
            padding-bottom: 1%;
        }

        #amounts tr:last-child {
            font-size: 1.5em;
        }

        #amounts td:first-child {
            width: 25%;
        }

        #amounts td:last-child {
            text-align: right;
        }

        #products_table {
            /*padding-bottom: 5%;*/
            width: 100%;
            font-size: 0.875em;
            font-weight: 300;
            text-align: right;
            line-height: 1.8em;
        }

        #products_table thead th {
            font-weight: 600;
            padding-bottom: 10px;
            border-style: none;
            border-bottom: 1px solid #F0F2F5;
        }

        #products_table tbody tr:first-child td {
            padding-top: 10px;
        }

        #products_table th:first-child {
            text-align: left;
            width: 50%;
        }

        #products_table th:nth-child(2) {
            width: 15%;
        }

        #products_table th:nth-child(3) {
            width: 20%;
        }

        #products_table th:nth-child(4) {
            width: 15%;
        }

        #products_table td:first-child {
            word-wrap: break-word;
            text-align: left;
        }

        #paid_statement,
        #verification_text {
            line-height: 1.125em;
            text-align: center;
        }

        #reminder {
            color: #140000;
            font-weight: 500;
            font-size: 0.75em;
            line-height: 1.125em;
        }

        #not_a_purchase_receipt {
            color: #140000;
            font-weight: 500;
            font-size: 1.0em;
            line-height: 1.125em;
        }

        #business_name {
            font-weight: 500;
            font-size: 1.125em;
            line-height: 1.5em;
        }

        #map {
            display: block;
            clear: both;
        }

        #map>a {
            color: #5C8BCC;
            text-decoration: none;
        }

        #geolocation {
            padding: 30px;
            width: auto;
            margin: 0 auto;
        }

        #geolocation>img {
            max-width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #emv_data_table {
            width: 100%;
        }

        #emv_data_table td:first-child {
            width: 60%;
            vertical-align: top;
        }

        #emv_data_table td:last-child {
            word-wrap: break-word;
            word-break: break-all;
        }

        #footer_text {
            float: left;
            padding-bottom: 5%;
        }

        #custom_footer_text {
            padding-top: 20px;
        }

        .line {
            margin-top: 1%;
            margin-bottom: 1%;
            display: block;
            clear: both;
            width: 100%;
            background: #000000;
            border: 1px solid #F0F2F5;
        }

        .small {
            font-size: 0.875em;
            line-height: 1.125em;
        }

        .medium {
            font-size: 1.125em;
            line-height: 1.125em;
        }

        .large {
            font-size: 1.5em;
            line-height: 1.125em;
        }

        .spacer {
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .white-box {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 2px 10px 0 rgba(0, 0, 0, 0.03);
            background-color: #ffffff;
            overflow: auto;
            border-bottom: 1px dashed #F0F2F5;
            border-radius: 10px;
            padding: 50px;
        }

        .receipt-data {
            font-weight: 300;
            line-height: 1.5em;
        }

        .spacer-mini {
            text-align: right;
            padding-top: 5px;
        }

        .spacer-small {
            padding-top: 15px;
        }

        .spacer-medium {
            padding-top: 25px;
        }

        .spacer-large {
            padding-top: 50px;
        }

        .hide {
            display: none;
        }

        #content {
            display: table;
        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 767px) {

            body {
                width: 90%;
            }

            #header {
                margin: 0 auto;
                float: none;
                padding: 5%;
            }

            #header .logo {
                margin: auto;
            }

            #content {
                margin: 0 auto;
                float: none;
                width: auto;
            }

            .white-box {
                padding: 15px;
            }

            #footer {
                float: none;
                margin-left: 0px;
                padding: 15px;
                padding-top: 0px;
            }

            #receipt_data_table {
                width: 100%;
                margin-right: 0px;
                margin-bottom: 30px;
                float: none;
                border-spacing: 0px;
            }

            #card_data,
            #elv_data_table {
                width: 100%;
                float: left;
                text-align: left
            }

            #receipt_data_table td:first-child,
            #elv_data_table td:first-child {
                width: 50%;
            }

            #merchant_data,
            #sale_header,
            #sale_timestamp,
            #map {
                text-align: center;
            }

            .spacer-mini {
                padding-top: 2px;
            }

            .spacer-small {
                padding-top: 5px;
            }

            .spacer-medium {
                padding-top: 8px;
            }

            .spacer-large {
                padding-top: 15px;
            }
        }

        @media only screen and (min-device-width: 768px) and (max-device-width: 1280px) {
            body {
                width: 90%;
            }

            #header {
                margin-top: 5%;
                width: 27%;
                padding-right: 3%;
            }

            #header .logo {
                width: 205px;
                height: 82px;
            }

            #content {
                margin-top: 5%;
                width: 70%;
            }

            #receipt_data_table {
                width: 275px;
                float: left;
                margin-right: 0px;
                margin-bottom: 25px;
                border-spacing: 0px;
            }

            #card_data {
                float: right;
                display: inline-block;
            }

            #card_data,
            #elv_data_table {
                width: 150px;
            }

            #sale_header {
                float: left;
            }

            #sale_timestamp {
                float: right;
            }

            #footer {
                padding: 5%;
                padding-top: 0px;
            }

            .white-box {
                padding: 5%;
            }

            .spacer-mini {
                padding-top: 4px;
            }

            .spacer-small {
                padding-top: 10px;
            }

            .spacer-medium {
                padding-top: 20px;
            }

            .spacer-large {
                padding-top: 35px;
            }
        }

        @media only print {
            body {
                background: none;
                font-size: 24px;
            }

            #header {
                margin: 0 auto;
                margin-left: 50px;
                float: none;
                width: auto;
                overflow: auto;
                padding-top: 50px;
                padding-bottom: 50px;
            }

            #header .logo {
                float: right;
            }

            #content {
                margin: 0 auto;
                float: none;
                width: auto;
                display: block;
            }

            #merchant_data {
                float: left;
                word-break: break-word;
                width: 700px;
            }

            #signature {
                width: 400px;
            }

            #signature svg,
            #signature img {
                width: 400px;
                height: 200px;
            }

            #footer {
                float: none;
                margin-left: 0px;
                font-size: 0.75em;
            }

            #footer_text {
                padding-bottom: 0px;
            }

            #footer .logo {
                margin-right: 10px;
            }

            /* wkhtmltopdf requires absolute width and height for SVG images */
            #footer svg,
            #footer img {
                width: 100px;
                height: 40px;
            }

            .no-print {
                display: none;
            }

            .white-box {
                box-shadow: none;
                border: none;
                background: none;
                padding: 50px;
            }
        }
    </style>
</head>

<body>
    <div id="header">
        <div class="logo sumup_logo">
          <img
            src="{{ asset('img/logos/logo-crcp.png') }}"
            alt="CRCP" />
        </div>
    </div>

    <div id="content">
        <div class="white-box receipt-data">
            <table id="receipt_data_table">
                <tbody>

                    <tr id="customer_id">
                        <td>Nombre vendedor:</td>
                        <td>{{ $invoice->seller->name }}</td>
                    </tr>

                    @if ($invoice->order)
                    <tr id="order_id">
                        <td>Nº de orden:</td>
                        <td>#{{ $invoice->order->id }}</td>
                    </tr>
                    @endif

                </tbody>
            </table>

            <div id="card_data">


                <div id="cardholder_name">
                    Datos del cliente
                </div>



                <div id="cardholder_name">
                    @if($invoice->first_name || $invoice->last_name)
                        {{ $invoice->fist_name  . ' ' . $invoice->last_name }}
                    @else
                        {{ optional($invoice->customer)->fullName }}
                    @endif
                </div>



                <div id="entry_mode">
                    {{ $invoice->uid }}
                </div>



                <div id="entry_mode">
                    {{ $invoice->email ?? '' }}
                </div>




            </div>

        </div>

        <div class="white-box">
            <div id="sale_header" class="tx-headers">
                Venta
            </div>

            <div id="sale_timestamp" class="tx-time">
                {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y H:i') }}
            </div>


            <div class="spacer-large"></div>




            <table class="amounts_table" width="100%">
                <tbody>
                    <tr>
                        <td colspan="2" style="border-bottom: 2px solid #F0F2F5">
                            <div class="spacer-mini"></div>

                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <div class="">
                              Nombre
                            </div>

                        </th>
                        <th colspan="2">
                            <div class="spacer-mini">
                              Cantidad
                            </div>

                        </th>
                        <th colspan="2">
                            <div class="spacer-mini">
                              P. unitario
                            </div>

                        </th>
                        <th colspan="2">
                            <div class="spacer-mini">
                              Total
                            </div>

                        </th>
                    </tr>

                    @foreach ($invoice->invoice_items as $item)
                        <tr>
                            <td colspan="2">
                                <div class="">
                                  {{ $item->name }}
                                </div>

                            </td>
                            <td colspan="2">
                                <div class="spacer-mini">
                                  {{ $item->qty }}
                                </div>

                            </td>
                            <td colspan="2">
                                <div class="spacer-mini">
                                  {{ currencyFormat($item->price, 'CLP', true) }}
                                </div>

                            </td>
                            <td colspan="2">
                                <div class="spacer-mini">
                                  {{ currencyFormat($item->total, 'CLP', true) }}
                                </div>

                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="2" style="padding-bottom: 50px; border-bottom: 4px solid #F0F2F5">
                            <div class="spacer-mini"></div>
                        </td>
                        <td colspan="2" style="border-bottom: 4px solid #F0F2F5">
                            <div class="spacer-mini"></div>
                        </td>
                    </tr>
                  
                    @if ($invoice->tax_amount)
                    <tr id="sale_without_tip_amount" class="amount large">
                        <td class="amount_name" colspan="6" style="padding: 10px 0px 10px 0px">IVA:</td>
                        <td class="amount_value" colspan="2">{{ currencyFormat($invoice->tax_amount, 'CLP', true) }}</td>
                    </tr>
                    @endif
                    <tr id="sale_without_tip_amount" class="amount large">
                        <td class="amount_name" colspan="6">TOTAL:</td>
                        <td class="amount_value" colspan="2">{{ currencyFormat($invoice->total, 'CLP', true) }}</td>
                    </tr>
                </tbody>
            </table>


        </div>

        <div class="white-box">


            <div class="spacer-large"></div>



            <div id="declaration">
                Acepto el pago de la cantidad mencionada conforme al acuerdo con el emisor de la tarjeta
            </div>

            <div class="spacer-large"></div>

            <div class="spacer-large"></div>


        </div>

    </div>
    </tbody>
    </table>
</body>

</html>