@extends('layouts.base')

@section('content')
    <!-- Page Title-->
    <div class="page-title-overlap bg-light-blue pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
                <h1 class="h3 text-light mb-0">Tu carro</h1>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    @livewire('cart.preview', ['cart' => $cart])
@endsection
