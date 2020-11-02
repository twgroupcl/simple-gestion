@extends('backpack::blank')

@section('header')
    {{-- <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active"> {{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section> --}}
@endsection
@section('content')

@php
  Widget::add([
    'type'        => 'view',
    'view'        => 'backpack::reports.general-amounts',
  ]);
@endphp


@php
  Widget::add([
    'type'        => 'view',
    'view'        => 'backpack::reports.sellers',
  ]);
@endphp

@php
  Widget::add([
    'type'        => 'view',
    'view'        => 'backpack::reports.orders',
  ]);
@endphp

@php
  // Widget::add([ 
  //   'type'       => 'chart',
  //   'controller' => \App\Http\Controllers\Admin\Charts\NumberSellersApprovedChartController::class,
  // ]);
@endphp
@stop
