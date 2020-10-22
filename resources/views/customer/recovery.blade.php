@extends('layouts.base')

@section('content')
<!-- Page title-->
<!-- Page Content-->
<div class="container py-4 py-lg-5 my-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <h2 class="h3 mb-4">¿Olvidaste tu contraseña?</h2>
            <p class="font-size-md">Cambia tu contraseña en tres sencillos pasos. Esto ayuda a mantener segura tu nueva contraseña.</p>
            <ol class="list-unstyled font-size-md">
                <li><span class="text-primary mr-2">1.</span>Indícanos tu email en el formulario de abajo.</li>
                <li><span class="text-primary mr-2">2.</span>Te enviaremos un código temporal al email.</li>
                <li><span class="text-primary mr-2">3.</span>Usa ese código para cambiar tu contraseña.</li>
            </ol>
            <div class="card py-2 mt-4">
                <div class="row justify-content-md-center mt-3">
                    @if (isset($error))
                    <div class="alert alert-danger alert-with-icon" role="alert">
                        <div class="alert-icon-box">
                            <i class="alert-icon czi-check-circle"></i>
                        </div>
                        {{ $error }}
                    </div>
                    @endif

                    @if (isset($success))
                    <div class="alert alert-success alert-with-icon" role="alert">
                        <div class="alert-icon-box">
                            <i class="alert-icon czi-check-circle"></i>
                        </div>
                        {{ $success }}
                    </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('customer.frontend.recovery') }}" class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="email">Ingresa tu email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email') }}" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Obtener código</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
