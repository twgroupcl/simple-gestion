@extends('backpack::blank')

@section('header')

@endsection

@section('content')


@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.details'
    ]);
@endphp

{{-- @if (!isset($invoice->dte_code))--}}
@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.create_temporary_document'
    ]);
@endphp
{{--@endif--}}

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
@endsection
