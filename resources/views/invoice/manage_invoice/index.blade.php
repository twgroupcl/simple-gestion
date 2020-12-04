@extends(backpack_view('blank'))

@php use \App\Models\Invoice; @endphp

@section('header')

@endsection

@section('content')


@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.details',
    ]);
@endphp

@php
    Widget::add([ 'type' => 'column_break' ]);
@endphp

@include('invoice.manage_invoice.actions')

@endsection
