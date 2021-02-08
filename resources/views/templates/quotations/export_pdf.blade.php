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

    pre {
        white-space: pre-wrap;
    }

    p {
        font-size: 12px;
    }

    li {
        font-size: 12px;
    }

    /* .page-break {
            page-break-after: always;
    } */

</style>

</head>
<body>
<header>
        <div style="float: left;">{{ $now->format('d/m/Y h:m A')  }}</div>
        <div style="float: right;">{{ $title }} | N/P {{ $quotation->code }}</div>
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
        @if ($quotation->branch->companies->first()->logo)
        {{-- <img style="max-height: 70px" src="https://twgroup.cl/app/uploads/2020/08/LOGO_PRINCIPAL.png" /> --}}
        <img style="max-height: 70px" src="{{ asset($quotation->branch->companies->first()->logo) }}" />
        @else 
        <h2 style="margin-top:45px">{{ $quotation->branch->companies->first()->name }}</h3>
        @endif
    </div>

    <div class="company-info">
        <p class="p-estrecho">{{ $quotation->branch->companies->first()->name }}</p>
        <p class="p-estrecho">{{ $quotation->branch->address }}</p>
        <p class="p-estrecho">RUT {{ $quotation->branch->companies->first()->uid }}</p>
    </div>
</div> 


<div>
    <table width="100%" style="min-height: 130px">
    <tr>

        <td width="67%" class="top-td">
            <div class="direccion-facturacion-titulo">
                <strong>Dirección de facturación del cliente</strong>
            </div>
            <p>
                <p class="p-estrecho">{{ $quotation->first_name }} {{ $quotation->last_name }}</p>
                <p class="p-estrecho">{{ $quotation->uid }} </p>
                @if ($quotation->customer->addresses->count() > 0)<p class="p-estrecho">{{ $quotation->customer->addresses->first()->street }} {{ $quotation->customer->addresses->first()->number }}</p> @endif
                @if (!empty($quotation->address))<p class="p-estrecho">{{ $quotation->address->commune->name }}</p> @endif
                <p class="p-estrecho">@if ($quotation->phone) Teléfono: {{  $quotation->phone  }} @endif</p>
            </p>
        </td>
        <td width="31%" class="top-td">
            <table>
                <tr>
                    <td style="text-align: left">Fecha de cotización:</td>
                    <td style="text-align: right">{{ $creation_date->format('d/m/Y') }}</td>
                </tr>
                @if ($quotation->expiry_date)
                <tr>
                    <td style="text-align: left">Fecha de vencimiento:</td>
                    <td style="text-align: right">{{ $due_date->format('d/m/Y') }}</td>
                </tr> 
                @endif
                <tr>
                    <td style="text-align: left">Número de cotización:</td>
                    <td style="text-align: right">#{{ $quotation->code }}</td>
                </tr>
                @if ($quotation->reference)
                <tr>
                    <td style="text-align: left">Referencia de cotización:</td>
                    <td style="text-align: right">{{$quotation->reference }}</td>
                </tr>
                @endif
            </table>
        </td>
    </tr>

  </table>
</div>

<br>


    {!! $quotation->preface !!}
    
  <br>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th width="35%">Producto / Servicio</th>
        <th>Cant.</th>
        <th>Precio $</th>
        @if ($quotation->has_discount_per_item)
        <th>Desc. $</th>  
        @endif
        @if ($quotation->has_tax_per_item)
        <th>Impuesto $</th>
        @endif
        <th>Subtotal $</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($quotation->quotation_items as $key =>$item)
        <tr>
          <th scope="row" class="top-td">{{ $key + 1 }}</th>
          <td>
              {{ $item['name'] }}
              <p class="item-description">{{ $item['description'] }}</p>
          </td>
          <td align="right" class="top-td">{{ $item['qty'] }}</td>
          <td align="right" class="top-td">{{ currencyFormat($item['price'], 'CLP', true) }}</td>
          @if ($quotation->has_discount_per_item)
          <td align="right" class="top-td">{{ currencyFormat($item['discount_total'], 'CLP', true) }}</td>
          @endif
          @if ($quotation->has_tax_per_item)
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
                @if ($quotation->notes)
                <div class="direccion-facturacion-titulo">
                    <strong>Notas adicionales:</strong>
                </div>
                <p>
                    <p>
                        {{ $quotation->notes }}
                    </p>
                </p> 
                @elseif ($quotation->include_payment_data && $quotation->branch->companies->first()->payment_data)
                    <div class="direccion-facturacion-titulo">
                        <strong>Datos de pago:</strong>
                    </div>
                    <pre>{!! $quotation->branch->companies->first()->payment_data !!}</pre>
                @endif
            </td>
            <td width="25%" ></td>
            <td class="top-td">
                <table align="right">
                    <tbody>
                            <tr>
                                <td align="right" class="size-totals"><strong>Subtotal $</strong></td>
                                <td align="right">{{ currencyFormat($quotation->sub_total, 'CLP', false)  }}</td>
                            </tr>
                            @if ($quotation->discount_amount > 0)
                            <tr>
                                <td align="right" class="size-totals"><strong>Descuento general $</strong></td>
                                <td align="right">-{{ currencyFormat($quotation->discount_amount, 'CLP', false) }}</td>
                            </tr>
                            @endif
                            @if ($quotation->tax_type == 'A')
                            <tr>
                                <td align="right" class="size-totals"><strong>IVA $</strong></td>
                                <td align="right">{{ currencyFormat($quotation->tax_amount, 'CLP', false) }}</td>
                            </tr>  
                            @endif
                            @if ($quotation->tax_type == 'H')
                            <tr>
                                <td align="right" class="size-totals"><strong>Retencion $</strong></td>
                                <td align="right">-{{ currencyFormat($quotation->tax_amount, 'CLP', false) }}</td>
                            </tr>      
                            @endif
                            @if ($quotation->has_tax_per_item)
                            <tr>
                                <td align="right" class="size-totals"><strong>Impuestos adic. $</strong></td>
                                <td align="right">{{ currencyFormat($quotation->tax_specific, 'CLP', false) }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td align="right" class="size-totals"><strong>Total $</strong></td>
                                <td align="right" class="gray">{{ currencyFormat($quotation->total, 'CLP', false) }}</td>
                            </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<br>

@if ($quotation->include_payment_data && $quotation->notes && $quotation->branch->companies->first()->payment_data)
<table>
    <tbody>
        <tr>
            <td>
                <div class="direccion-facturacion-titulo">
                    <strong>Datos de pago:</strong>
                </div>
                <pre>{!! $quotation->branch->companies->first()->payment_data !!}</pre>
            </td>
        </tr>
    </tbody>
</table>
@endif


</div>
</body>
</html>