
@can('canCreateTempDocument', $invoice)
@include('invoice.manage_invoice.create_temporary_document')
@endcan

@can('doShowTempDocument', $invoice)
@include('invoice.manage_invoice.create_real_document')
@endcan

{{-- @can('doEdit', $invoice)
@include('invoice.manage_invoice.go_to_edit')
@endcan --}}

@can('doDownloadTemporalPDF', $invoice)
@include('invoice.manage_invoice.get_temporal_pdf')

@elsecan('doDownloadRealPDF', $invoice)
@include('invoice.manage_invoice.get_real_pdf')
@endcan


{{-- @can('doDeleteDocument', $invoice)
@include('invoice.manage_invoice.delete_temporary_document')
@endcan --}}

@can('doUpdateDocumentStatus', $invoice)
@include('invoice.manage_invoice.update_dte_status')
@endcan

{{-- Foother --}}
<div style="height: 150px"></div>