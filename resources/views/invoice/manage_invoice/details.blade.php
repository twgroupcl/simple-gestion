<div class="row">
    <h3>Detalles del documento:</h3>
</div>

@foreach (Alert::getMessages() as $type => $messages)
    @foreach ($messages as $message)
        <div class="alert alert-{{ $type }}">{{ $message }}</div>
    @endforeach
@endforeach
<div class="container-fluid animated fadeIn card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <p><strong>Nombre: </strong>
                    {{$invoice->first_name}}
                </p>
            </div>
            <div class="col-md-3">
                <p><strong>Total: </strong>
                    {{ currencyFormat($invoice->total, defaultCurrency(), true) }}
                </p>
            </div>
            <div class="col-md-3">
                <p><strong>Fecha: </strong>
                {{$invoice->invoice_date}}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Folio: </strong>
                    {{$invoice->folio ?? 'Documento aun no enviado al SII'}}
                </p>
            </div>
            <div class="col-md-6">
                <p><strong>Código de documento: </strong>
                    {{$invoice->dte_code ?? "S/código"}}
                </p>
            </div>
        </div>
        @if ($invoice->dte_status)
        <div class="row">
            <div class="col-md-6">
                <p>
                    <strong>Estado del envio al SII del documento (detalle):</strong>
                    {{ $invoice->dte_status['revision_detalle'] }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>
                    <strong>Estado del envio al SII del documento (estado):</strong>
                    {{ $invoice->dte_status['revision_estado'] }}
                </p>
            </div>
        </div>
        @endif
        
        @if (($invoice->invoice_status == App\Models\Invoice::STATUS_TEMPORAL) || (isset($invoice->folio) &&
              $invoice->invoice_status == App\Models\Invoice::STATUS_SEND))
            <div class="row">
                @if ($invoice->invoice_type->code === 39 || $invoice->invoice_type->code === 41)
                <embed src="{{ route('invoice.get-pdf', ['invoice' => $invoice, 'tipoPapel' => 57]) }}" type="application/pdf" width="70%" height="400px" />
                @else 
                <embed src="{{ route('invoice.get-pdf', ['invoice' => $invoice, 'tipoPapel' => 0]) }}" type="application/pdf" width="70%" height="400px" />
                @endif
            </div>

            @if ($invoice->invoice_status == App\Models\Invoice::STATUS_TEMPORAL)
            <div class="row mt-2">
                <div class="col">
                    <a href="{{ url('admin/invoice/'.$invoice->id.'/edit') }}" class="" > 
                        Editar
                    </a>
                </div>
            </div>
            @endif
        @endif
    </div>
</div>
