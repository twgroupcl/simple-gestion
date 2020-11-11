@extends('layouts.base')

@section('content')
<!-- Page Title-->
<div class="page-title-overlap bg-dark pt-4 bg-cp-gradient">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        {{-- <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a></li>
                    <li class="breadcrumb-item text-nowrap"><a href="#">Account</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Profile info</li>
                </ol>
            </nav>
        </div> --}}
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-light mb-0">Información del perfil</h1>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container pb-5 mb-2 mb-md-3">
    <div class="row">
        @include('customer.sidebar')
        <!-- Content  -->
        <section class="col-lg-8">
            <!-- Toolbar-->
            <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
                <h6 class="font-size-base text-light mb-0">Actualice los datos de su perfil a continuación:</h6>
                <a class="btn btn-primary btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="czi-sign-out mr-2"></i> Cerrar sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <!-- Profile form-->
            <form action="{{ route('customer.update', ['customer' => $customer]) }}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $customer->id }}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Plan <span class="text-danger">*</span></label>
                            <select name="plan_id" class="form-control select-plan">
                                <option value="">Seleccionar plan</option>
                                @foreach($plans as $plan)
                                    <option value="{{$plan->id}}">{{$plan->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account-email">Precio</label>
                            <input class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Fecha de inicio</label>
                            <input type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Fecha de fin</label>
                            <input type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="mt-2 mb-3">
                        <div class="d-flex flex-wrap justify-content-end align-items-center">
                            <input class="btn btn-primary mt-3 mt-sm-0" type="submit" value="Suscribir">
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection