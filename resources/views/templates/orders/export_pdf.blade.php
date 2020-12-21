<!doctype html>
<html lang="eS">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{{ $title }}</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }

    @page {
        margin-top: 100px;
    }

    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    header {
            position: fixed;
            top: -65px;
            left: 15px;
            right: 30px;
            height: 20px;
            line-height: 20px;
            font-size: 11px;
        }

    .gray {
        background-color: lightgray
    }

    .h3-titulo {
        margin-bottom: 6px;
        margin-top:-30px;
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

    .container {
        margin: 15px;
    }

    .company-info {
        font-size: 12px;
        text-align: right;
        margin-right: 15px;
        margin-top: 35px;
    }

    /* .page-break {
            page-break-after: always;
    } */

</style>

</head>
<body>
<header>
        <div style="float: left;">{{ $now->format('d/m/Y h:m A')  }}</div>
        <div style="float: right;">{{ $title }} | N/P {{ $invoice->id }}</div>
</header>

<div class="container">

<footer>
    {{-- TWGroup &copy; {{ date('Y') }} - <a href="https://www.twgroup.cl" target="_blank">www.twgroup.cl</a> --}}
    <script type="text/php">
        if (isset($pdf)) {
            $text = "{PAGE_NUM} / {PAGE_COUNT}";
            $size = 7;
            $font = $fontMetrics->getFont('DejaVu Sans');
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width + 15);
            $y = $pdf->get_height() - 15;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</footer>

<div style="height: 120px;">
    <div style="float: left; margin-top: -40px">
        <h2 style="margin-top:45px">{{ optional($invoice->seller)->visible_name }}</h3>
    </div>

    <div class="company-info">
    </div>
</div>


<div>
    <table width="100%" style="min-height: 130px">
        <tr>

            <td width="67%" class="top-td">
                <div class="direccion-facturacion-titulo">
                    <strong>Dirección de boleta del cliente</strong>
                </div>
                <div>
                    <p class="p-estrecho">{{ $invoice->first_name }} {{ $invoice->last_name }}</p>
                    <p class="p-estrecho">{{ $invoice->uid }} </p>
                    <p class="p-estrecho">{{ optional($invoice->customer->addresses->first())->street }} {{ optional($invoice->customer->addresses->first())->number }}</p>
                    <p class="p-estrecho">@if ($invoice->phone) Teléfono: {{  $invoice->phone  }} @endif</p>
                </div>
            </td>
            <td width="31%" class="top-td">
                <table>
                    <tr>
                        <td style="text-align: left">Fecha de orden:</td>
                        <td style="text-align: right">{{ $invoice->order->created_at->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de orden:</td>
                        <td style="text-align: right">#{{ $invoice->order->id }}</td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
</div>

<br>

    <table>
        <tbody>
            <tr>
                <td>
                {!! $invoice->preface !!}
                </td>
            </tr>
        </tbody>
    </table

  <br>

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th width="35%">Producto / Servicio</th>
                <th>Cant.</th>
                <th>Precio $</th>
                @if ($invoice->has_discount_per_item)
                <th>Desc. $</th>
                @endif
                @if ($invoice->has_tax_per_item)
                <th>Impuesto $</th>
                @endif
                <th>Subtotal $</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->invoice_items as $key => $item)
                <tr>
                    <th scope="row" class="top-td">{{ $key + 1 }}</th>
                    <td>
                        {{ $item['name'] }}
                        <p class="item-description">{{ $item['description'] }}</p>
                    </td>
                    <td align="right" class="top-td">{{ $item['qty'] }}</td>
                    <td align="right" class="top-td">{{ currencyFormat($item['price'], 'CLP', true) }}</td>
                    @if ($invoice->has_discount_per_item)
                    <td align="right" class="top-td">{{ currencyFormat($item['discount_total'], 'CLP', true) }}</td>
                    @endif
                    @if ($invoice->has_tax_per_item)
                    <td align="right" class="top-td">{{ $item['additional_tax_total'] ? currencyFormat($item['additional_tax_total'], 'CLP', true) : 0 }}</td>
                    @endif
                    <td align="right" class="top-td">{{ currencyFormat($item['total'], 'CLP', true) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <br>
    <table class="bottom-table" width="100%">
        <tbody>
            <tr>
                <td class="top-td" width="45%">
                    @if ($invoice->notes)
                    <div class="direccion-facturacion-titulo">
                        <strong>Notas adicionales:</strong>
                    </div>
                    <p>
                        <p>
                            {{ $invoice->notes }}
                        </p>
                    </p>
                    @elseif ($invoice->include_payment_data)
                        <div class="direccion-facturacion-titulo">
                            <strong>Datos de pago:</strong>
                        </div>
                        <pre>{!! $invoice->payment_data !!}</pre>
                    @endif
                </td>
                <td width="25%" ></td>
                <td class="top-td">
                    <table align="right">
                        <tbody>
                                <tr>
                                    <td align="right" class="size-totals"><strong>Subtotal $</strong></td>
                                    <td align="right">{{ currencyFormat($invoice->sub_total ?? 0, 'CLP', true)  }}</td>
                                </tr>
                                <tr>
                                    <td align="right" class="size-totals"><strong>Descuento general $</strong></td>
                                    <td align="right">-{{ currencyFormat($invoice->discount_amount ?? 0, 'CLP', true) }}</td>
                                </tr>
                                @if ($invoice->tax_type == 'A')
                                <tr>
                                    <td align="right" class="size-totals"><strong>IVA $</strong></td>
                                    <td align="right">{{ currencyFormat($invoice->tax_amount ?? 0, 'CLP', true) }}</td>
                                </tr>
                                @endif
                                @if ($invoice->tax_type == 'H')
                                <tr>
                                    <td align="right" class="size-totals"><strong>Retencion $</strong></td>
                                    <td align="right">-{{ currencyFormat($invoice->tax_amount ?? 0, 'CLP', true) }}</td>
                                </tr>
                                @endif
                                @if ($invoice->has_tax_per_item)
                                <tr>
                                    <td align="right" class="size-totals"><strong>Impuestos adic. $</strong></td>
                                    <td align="right">{{ currencyFormat($invoice->tax_specific ?? 0, 'CLP', true) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td align="right" class="size-totals"><strong>Total $</strong></td>
                                    <td align="right" class="gray">{{ currencyFormat($invoice->total ?? 0, 'CLP', true) }}</td>
                                </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <br>

    @if ($invoice->include_payment_data && $invoice->notes)
    <table>
        <tbody>
            <tr>
                <td>
                    <div class="direccion-facturacion-titulo">
                        <strong>Datos de pago:</strong>
                    </div>
                    <pre>{!! $invoice->payment_data !!}</pre>
                </td>
            </tr>
        </tbody>
    </table>
    @endif


</div>
</body>
</html>