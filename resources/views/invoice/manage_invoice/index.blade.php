@extends('backpack::blank')

@php use \App\Models\Invoice; @endphp

@section('header')

@endsection

@section('content')


@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.details'
    ]);
@endphp

@can('canCreateTempDocument', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.create_temporary_document'
    ]);
@endphp
@endcan

@can('doEdit', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.go_to_edit',
    ]);
@endphp
@endcan

@can('doDownloadPDF', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.get_pdf',
    ]);
@endphp
@endcan

{{-- status invoice --}}
@can('doDeleteDocument', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.delete_temporary_document',
    ]);
@endphp
@endcan

@can('doShowTempDocument', $invoice)
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.create_real_document',
    ]);
@endphp
@endcan

@endsection
