@if ($invoice->invoice_type->code === 39 || $invoice->invoice_type->code === 41)
<a href="{{ route('invoice.get-pdf', ['invoice' => $invoice, 'tipoPapel' => 57]) }}" target="_blank" class="btn btn-primary">
    <i class="la la-send"></i> Imprimir comprobante
</a>
@else
<a href="{{ route('invoice.get-pdf', ['invoice' => $invoice, 'tipoPapel' => 0]) }}" target="_blank" class="btn btn-primary">
    <i class="la la-send"></i> Imprimir comprobante
</a>
@endif