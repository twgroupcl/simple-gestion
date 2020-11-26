<div class="mx-3 mt-2">
    <div class="row mt-3">
        <div class="col"><h5>Información general</h5></div>
    </div>

    <div class="row">
        <div class="col"><b>Vendedor</b>: {{ $data->seller->visible_name }}</div>
    </div>
    <div class="row">
        <div class="col"><b>Configurado globalmente</b>: {{ $data->is_global ? 'Si' : 'No' }}</div>
    </div>
    @if ($data->commune)    
    <div class="row">
        <div class="col"><b>Comuna</b>: {{ $data->commune->name ?? '' }}</div>
    </div>
    @endif

    <div class="row mt-3">
        <div class="col"><h5>Metodos de envio configurados</h5></div>
    </div>

    @if (!empty($data->active_methods['free_shipping_status']) && $data->active_methods['free_shipping_status'])
    <div class="row">
        <div class="col-md-12"><b>Envio gratis</b></div>
        <div class="col-md-12">
            <ul>
                <li>Precio por paquete: No aplica</li>
            </ul>
        </div>
    </div>
    @endif

    @if (!empty($data->active_methods['picking_status']) && $data->active_methods['picking_status'])
    <div class="row">
        <div class="col-md-12"><b>Retiro en tienda</b></div>
        <div class="col-md-12">
            <ul>
                <li>Precio por paquete: No aplica</li>
            </ul>
        </div>
    </div>
    @endif

    @if (!empty($data->active_methods['flat_rate_status']) && $data->active_methods['flat_rate_status'])
    <div class="row">
        <div class="col-md-12"><b>Tarifa fija</b></div>
        <div class="col-md-12">
            <ul>
                <li>Precio por paquete: {{ currencyFormat(json_decode($data->shipping_methods['flat_rate'], true)[0]['price'], 'CLP', true) }}</li>
            </ul>
        </div>
    </div>
    @endif

    @if (!empty($data->active_methods['chilexpress_status']) && $data->active_methods['chilexpress_status'])
    <div class="row">
        <div class="col-md-12"><b>Chilexpress</b></div>
        <div class="col-md-12">
            <ul>
                <li>Precio por paquete: Calculado de manera automatica por Chilexpress</li>
            </ul>
        </div>
    </div>
    @endif

    @if (!empty($data->active_methods['variable_status']) && $data->active_methods['variable_status'])
    <div class="row">
        <div class="col-md-12"><b>Tarifa variable</b></div>
        <div class="col-md-12">
            <ul>
                <li>Precio por paquete: Para visualizar la tabla precios, ir al "editar" de esta entrada</li>
            </ul>
        </div>
    </div>
    @endif
</div>