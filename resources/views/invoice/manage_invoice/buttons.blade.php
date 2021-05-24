
@if ($invoice->invoice_status == App\Models\Invoice::STATUS_DRAFT)
@include('invoice.manage_invoice.create_temporary_document')
@endif

@if ($invoice->invoice_status == App\Models\Invoice::STATUS_TEMPORAL)
@include('invoice.manage_invoice.create_real_document')
@endif

{{-- @can('doEdit', $invoice)
@include('invoice.manage_invoice.go_to_edit')
@endcan --}}

{{-- @can('doDownloadTemporalPDF', $invoice)
@include('invoice.manage_invoice.get_temporal_pdf')
@endcan --}}

@if (isset($invoice->folio) && $invoice->invoice_status == App\Models\Invoice::STATUS_SEND)
@include('invoice.manage_invoice.get_real_pdf')
@endif


{{-- @can('doDeleteDocument', $invoice)
@include('invoice.manage_invoice.delete_temporary_document')
@endcan --}}

@if (isset($invoice->folio) && $invoice->invoice_status == App\Models\Invoice::STATUS_SEND)
@include('invoice.manage_invoice.update_dte_status')

@if ($invoice->invoice_type->code != 61)
    @include('invoice.manage_invoice.issue_credit_note')
@else
    @include('invoice.manage_invoice.issue_debit_note')
@endif

@endif

{{-- Foother --}}
<div style="height: 150px"></div>
