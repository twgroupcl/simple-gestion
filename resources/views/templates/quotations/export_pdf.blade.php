<!doctype html>
<html lang="eS">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{{ $title }}</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: lightgray
    }

    .h3-titulo {
        margin-bottom: 6px;
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
        margin: 20px;
    }

    .size-totals {
    }
</style>

</head>
<body>
<div class="container">
<header>
    <h3 class="h3-titulo">{{ $quotation->seller->visible_name }}</h3>
  <table width="100%" style="min-height: 130px">
    <tr>
        {{-- <td valign="top">LOGO</td> --}}
        <td width="65%">
            <p class="p-estrecho">{{ $quotation->seller->visible_name }}</p>
            <p class="p-estrecho">{{ $quotation->seller->addresses->first()->street }}</p>
            <p class="p-estrecho">{{ $quotation->seller->addresses->first()->number }}</p>
            <p class="p-estrecho">RUT {{ $quotation->seller->uid }}</p>
            <p class="p-estrecho">{{ $quotation->seller->phone }}</p>
            <p class="p-estrecho">{{$quotation->seller->email }}</p>
        </td>
        <td width="30%">
            <p class="p-estrecho"><strong>Fecha de cotización</strong>: {{ $creation_date->format('d/m/Y') }}</p>
            <p class="p-estrecho"><strong>Fecha de vencimiento</strong>: {{ $due_date->format('d/m/Y') }}</p>
            <p class="p-estrecho"><strong>Numero de cotizacion</strong>: #{{ $quotation->id }}</p>
            @if ($quotation->code)
            <p class="p-estrecho"><strong>Referencia de cotizacion</strong>: {{$quotation->code }}</p>
            @endif
        </td>
    </tr>

  </table>
</header>
  <table width="100%">
    <tr>
        <td width="30%">
            <div class="direccion-facturacion-titulo">
                <strong>Direccion de facturación del cliente</strong>
            </div>
            <p>
                <p class="p-estrecho">{{ $quotation->first_name }} {{ $quotation->last_name }}</p>
                <p class="p-estrecho">{{ $quotation->uid }} </p>
                <p class="p-estrecho">{{ $quotation->customer->addresses->first()->street }} {{ $quotation->customer->addresses->first()->number }}</p>
                <p class="p-estrecho">{{ $quotation->address->commune->name }}</p>
                <p class="p-estrecho">@if ($quotation->phone) Telefono: {{  $quotation->phone  }} @endif</p>
            </p>
        </td>
        {{-- <td>
            <div class="direccion-facturacion-titulo">
                <strong>Direccion de envio</strong>
            </div>
            <p>
                <p class="p-estrecho">Fecha de cotización: 15/20/2015</p>
                <p class="p-estrecho">Fecha de fencimiento: 15/20/2015</p>
                <p class="p-estrecho">Numero de cotizacion: #4532</p>
                <p class="p-estrecho">Referencia de cotizacion: REF-44533</p>
            </p>
        </td> --}}
    </tr>

  </table>

  <br/>

  @if (strlen($quotation->preface) < 1000)
  <table>
    <tbody>
        <tr>
            <td>
              {!! $quotation->preface !!}
            </td>
        </tr>
    </tbody>
  </table> 
  @endif
  

  <br>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th width="20%">Producto / Servicio</th>
        <th>Cantidad</th>
        <th>Precio unitario $</th>
        @if ($quotation->has_discount_per_item)
        <th>Descuento $</th>  
        @endif
        @if ($quotation->has_tax_per_item)
        <th>Impuesto adicional</th>
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

    {{-- <tfoot>
        <tr class="tabla-totales">
            <td colspan="6"></td>
            <td align="right">Subtotal $</td>
            <td align="right">{{ $quotation->sub_total }}</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td align="right">Descuento $</td>
            <td align="right">-{{ $quotation->discount_total }}</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td align="right">Envio $</td>
            <td align="right">-{{ $quotation->shipping_total }}</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td align="right">Impuestos $</td>
            <td align="right">{{ $quotation->tax_total }}</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td align="right">Total $</td>
            <td align="right" class="gray">$ {{ $quotation->total }}</td>
        </tr>
    </tfoot> --}}
  </table>

  <br>
  <table class="bottom-table" width="100%">
    <tbody>
        <tr>
            <td class="top-td" width="40%">
                @if ($quotation->notes)
                <div class="direccion-facturacion-titulo">
                    <strong>Notas adicionales:</strong>
                </div>
                <p>
                    <p>
                        {{ $quotation->notes }}
                    </p>
                </p> 
                @endif
            </td>
            <td width="29%" ></td>
            <td class="top-td">
                <table>
                    <tbody>
                            <tr>
                                <td align="right" class="size-totals"><strong>Subtotal $</strong></td>
                                <td align="right">{{ currencyFormat($quotation->sub_total, 'CLP', true)  }}</td>
                            </tr>
                            <tr>
                                <td align="right" class="size-totals"><strong>Descuento general $</strong></td>
                                <td align="right">-{{ currencyFormat($quotation->discount_amount, 'CLP', true) }}</td>
                            </tr>
                            {{-- <tr>
                                <td align="right"><strong>Envio $</strong></td>
                                <td align="right">-{{ $quotation->shipping_total }}</td>
                            </tr> --}}
                            @if ($quotation->tax_type == 'A')
                            <tr>
                                <td align="right" class="size-totals"><strong>IVA $</strong></td>
                                <td align="right">{{ currencyFormat($quotation->tax_amount, 'CLP', true) }}</td>
                            </tr>  
                            @endif
                            @if ($quotation->tax_type == 'H')
                            <tr>
                                <td align="right" class="size-totals"><strong>Retencion $</strong></td>
                                <td align="right">-{{ currencyFormat($quotation->tax_amount, 'CLP', true) }}</td>
                            </tr>      
                            @endif
                            @if ($quotation->has_tax_per_item)
                            <tr>
                                <td align="right" class="size-totals"><strong>Impuestos adicionales $</strong></td>
                                <td align="right">{{ currencyFormat($quotation->tax_specific, 'CLP', true) }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td align="right" class="size-totals"><strong>Total $</strong></td>
                                <td align="right" class="gray">{{ currencyFormat($quotation->total, 'CLP', true) }}</td>
                            </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<br>

@if ($quotation->include_payment_data)
<table>
    <tbody>
        <tr>
            <td>
                Datos de pago
            </td>
        </tr>
    </tbody>
</table>
@endif

@if (strlen($quotation->preface) >= 1000)
  <table>
    <tbody>
        <tr>
            <td>
              {!! $quotation->preface !!}
            </td>
        </tr>
    </tbody>
  </table> 
  @endif

</div>
</body>
</html>