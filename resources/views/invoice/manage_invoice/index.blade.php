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

@if (Gate::inspect('doShowTempDocument', $invoice))
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.create_temporary_document'
    ]);
@endphp
@endif

@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.go_to_edit',
    ]);
@endphp

@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.get_pdf',
    ]);
@endphp


{{-- status invoice --}}
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.delete_temporary_document',
    ]);
@endphp
@endsection
