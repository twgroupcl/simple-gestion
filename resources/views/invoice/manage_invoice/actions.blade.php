@php use \App\Models\Invoice; @endphp

@php
    Widget::add([
        'type' => 'title',
        'text' => 'Acciones'
    ]);
@endphp

@can('canCreateTempDocument', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.create_temporary_document',
        'wrapper' => [
            'class' => 'mr-1 mb-2',
        ]
    ]);
@endphp
@endcan


@can('doEdit', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.go_to_edit',
        'wrapper' => [
            'class' => 'mr-1 mb-2',
        ]
    ]);
@endphp
@endcan

@can('doDownloadTemporalPDF', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.get_temporal_pdf',
        'wrapper' => [
            'class' => 'mr-1 mb-2',
        ]
    ]);
@endphp
@elsecan('doDownloadRealPDF', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.get_real_pdf',
        'wrapper' => [
            'class' => 'mr-1 mb-2',
        ]
    ]);
@endphp
@endcan

{{-- status invoice --}}
@can('doDeleteDocument', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.delete_temporary_document',
        'wrapper' => [
            'class' => 'mr-1 mb-2',
        ]
    ]);
@endphp
@endcan

@can('doShowTempDocument', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.create_real_document',
        'wrapper' => [
            'class' => 'mr-1 mb-2',
        ]
    ]);
@endphp
@endcan

@can('doUpdateDocumentStatus', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.update_dte_status',
        'wrapper' => [
            'class' => 'mr-1 mb-2',
        ]
    ]);
@endphp
@endcan

@can('doDownloadRealPDF', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.issue_credit_note',
        'wrapper' => [
            'class' => 'mr-1 mb-2',
        ]
    ]);
@endphp
@endcan    
