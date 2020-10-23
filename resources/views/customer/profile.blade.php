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
                            <label for="uid">RUT <span class="text-danger">*</span></label>
                            <input class="form-control uid @error('uid') is-invalid @enderror" type="text" name="uid" id="uid" placeholder="Escribe aquí tu rut" value="{{ old('uid') ?? $customer->uid }}" disabled>
                            <div class="invalid-feedback">Por favor ingresa tu rut.</div>
                            @error('uid')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="first_name">Nombre <span class="text-danger">*</span></label>
                            <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" id="first_name" placeholder="Escribe aquí tu nombre" value="{{ old('first_name') ?? $customer->first_name }}" required>
                            <div class="invalid-feedback">Por favor ingresa tu nombre.</div>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="last_name">Apellido <span class="text-danger">*</span></label>
                            <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" id="last_name" placeholder="Escribe aquí tu apellido" value="{{ old('last_name') ?? $customer->last_name }}" required>
                            <div class="invalid-feedback">Por favor ingresa tu apellido.</div>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account-email">Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" id="account-email" value="{{ $customer->email }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <div class="password-toggle">
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password">
                                <label class="password-toggle-btn">
                                    <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Mostrar contraseña</span>
                                </label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar contraseña</label>
                            <div class="password-toggle">
                                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation">
                                <label class="password-toggle-btn">
                                    <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Mostrar contraseña</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="mt-2 mb-3">
                        <div class="d-flex flex-wrap justify-content-end align-items-center">
                            <input class="btn btn-primary mt-3 mt-sm-0" type="submit" value="Actualizar perfil">
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/rut-formatter.js') }}"></script>
<script>
    $('.uid').rut();
</script>
@endpush
