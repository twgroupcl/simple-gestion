@extends('layouts.base')

@section('content')
<!-- Page title-->
<!-- Page Content-->
<div class="container py-4 py-lg-5 my-4">
    <div class="row justify-content-md-center mt-3">

        @if (session('error'))
        <div class="alert alert-danger alert-with-icon" role="alert">
            <div class="alert-icon-box">
                <i class="alert-icon czi-check-circle"></i>
            </div>
            {{ session('error') }}
        </div>
        @endif

        @if (session('error_message'))
        <div class="alert alert-danger alert-with-icon" role="alert">
            <div class="alert-icon-box">
                <i class="alert-icon czi-check-circle"></i>
            </div>
            {{ session('error_message') }}
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-with-icon" role="alert">
            <div class="alert-icon-box">
                <i class="alert-icon czi-check-circle"></i>
            </div>
            {{ session('success') }}
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

    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <h2 class="h4 mb-1">Inicia sesión</h2>
                    {{-- <div class="py-3">
                        <h3 class="d-inline-block align-middle font-size-base font-weight-semibold mb-2 mr-2">With social account:</h3>
                        <div class="d-inline-block align-middle"><a class="social-btn sb-google mr-2 mb-2" href="#" data-toggle="tooltip" title="Sign in with Google"><i class="czi-google"></i></a><a class="social-btn sb-facebook mr-2 mb-2" href="#" data-toggle="tooltip" title="Sign in with Facebook"><i class="czi-facebook"></i></a><a class="social-btn sb-twitter mr-2 mb-2" href="#" data-toggle="tooltip" title="Sign in with Twitter"><i class="czi-twitter"></i></a></div>
                    </div>
                    <hr>
                    <h3 class="font-size-base pt-4 pb-2">Or using form below</h3> --}}

                    <form method="POST" action="{{ route('customer.frontend.login') }}">
                        @csrf
                        <div class="input-group-overlay form-group">
                            <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="czi-mail"></i></span></div>
                            <input class="form-control prepended-form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group-overlay form-group">
                            <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="czi-locked"></i></span></div>
                            <div class="password-toggle">
                                <input class="form-control prepended-form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Contraseña" required>
                                <label class="password-toggle-btn">
                                    <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Mostrar contraseña</span>
                                </label>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" checked id="remember_me">
                                <label class="custom-control-label" for="remember_me">Recordarme</label>
                            </div><a class="nav-link-inline font-size-sm" href="{{ route('customer.forget') }}">¿Olvidaste tu contraseña?</a>
                        </div>
                        <hr class="mt-4">
                        <div class="text-right pt-4">
                            <button class="btn btn-primary" type="submit"><i class="czi-sign-in mr-2 ml-n21"></i>Iniciar sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 pt-4 mt-3 mt-md-0">
            <h2 class="h4 mb-3">¿Aún no tienes una cuenta? Regístrate</h2>
            <p class="font-size-sm text-muted mb-4">El registro demora menos de un minuto y te brinda control total sobre tus compras.</p>

            <form method="POST" action="{{ route('customer.frontend.store') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="uid">RUT <span class="text-danger">*</span></label>
                            <input class="form-control uid @error('uid') is-invalid @enderror" type="text" name="uid" id="uid" placeholder="Escribe aquí tu rut" value="{{ old('uid') }}" required>
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
                            <label for="email">E-mail <span class="text-danger">*</span></label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Escribe aquí tu email" value="{{ old('email') }}" required>
                            <div class="invalid-feedback">Por favor ingresa un email válido.</div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="first_name">Nombre <span class="text-danger">*</span></label>
                            <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" id="first_name" placeholder="Escribe aquí tu nombre" value="{{ old('first_name') }}" required>
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
                            <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" id="last_name" placeholder="Escribe aquí tu apellido" value="{{ old('last_name') }}" required>
                            <div class="invalid-feedback">Por favor ingresa tu apellido.</div>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="commune">Comuna <span class='text-danger'>*</span></label>
                        <select class="custom-select @error('commune') is-invalid @enderror" id="commune" name="commune">
                            <option value>Seleccione una comuna</option>
                            @foreach (\App\Models\Commune::orderBy('name', 'asc')->get(['id', 'name']) as $commune)
                                <option value="{{ $commune->id }}" 
                                    @if (old('commune') == $commune->id)
                                    selected
                                    @endif    
                                >{{ $commune->name }}</option>
                            @endforeach
                        </select>
                        @error('commune')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="street">Calle <span class="text-danger">*</span></label>
                            <input class="form-control @error('street') is-invalid @enderror" type="text" name="street" id="street" placeholder="Escribe aquí tu calle" value="{{ old('street') }}" required>
                            <div class="invalid-feedback">Por favor ingresa tu calle.</div>
                            @error('street')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="number">Numero <span class="text-danger">*</span></label>
                            <input class="form-control @error('number') is-invalid @enderror" type="text" name="number" id="number" placeholder="Escribe aquí tu numero de calle" value="{{ old('number') }}" required>
                            <div class="invalid-feedback">Por favor ingresa tu numero de calle.</div>
                            @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Telefono <span class="text-danger">*</span></label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" placeholder="Escribe aquí tu telefono" value="{{ old('phone') }}" required>
                            <div class="invalid-feedback">Por favor ingresa tu telefono.</div>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">Contraseña <span class="text-danger">*</span></label>
                            <div class="password-toggle">
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" required>
                                <label class="password-toggle-btn">
                                    <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Mostrar contraseña</span>
                                </label>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar contraseña <span class="text-danger">*</span></label>
                            <div class="password-toggle">
                                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" required>
                                <label class="password-toggle-btn">
                                    <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Mostrar contraseña</span>
                                </label>
                            </div>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" type="submit"><i class="czi-user mr-2 ml-n1"></i>Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/rut-formatter.js') }}"></script>
<script>
    $('.uid').rut();
</script>
@endpush
