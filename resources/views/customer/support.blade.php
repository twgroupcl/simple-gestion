@extends('layouts.base')

@section('content')
@isset($ticket)
<div class="d-flex justify-content-center pt-4">
    <div class="col-md-8 p-5 align-middle">
        <h2 class="h4 mb-5">Servicio al cliente</h2>
        <div class="col-sm-12 pb-5">
            <div class="card p-5">
                <div class="card-body">
                    <p>
                        <strong> Hemos recibido tu mensaje. El ID de tu solicitud es el número <span class="h5">#{{ $ticket }}</span>.
                        Procesaremos la información y te contactaremos a la brevedad.
                        Para regresar a la página de inicio haz click <a class="text-danger" href="{{ route('index') }}">aquí</a>.</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endisset

@empty($ticket)
<!-- Page title-->
<div class="d-flex justify-content-center pt-4">
    <div class="col-md-8">
        <h2 class="h4 mb-5">Servicio al cliente</h2>

            <form method="POST" action="{{ route('customer.support.create') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <label for="contact_type" class="control-label">Tipo de contacto <span class="text-danger">*</span></label><br>
                            <div class="w-100">
                                <select class="form-control" name="contact_type" id="contact_type">
                                    <option {{ old('contact_type') == '' ? "selected" : "" }}>Seleccione una opción...</option>
                                    <option {{ old('contact_type') == '1' ? "selected" : "" }} value="1">1. Consulta</option>
                                    <option {{ old('contact_type') == '2' ? "selected" : "" }} value="2">2. Reclamo</option>
                                    <option {{ old('contact_type') == '3' ? "selected" : "" }} value="3">3. Sugerencia</option>
                                </select>
                            </div>
                            @error('contact_type')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                          </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="subject">Asunto <span class="text-danger">*</span></label>
                            <input class="form-control @error('subject') is-invalid @enderror" maxlength="200" type="text" name="subject" id="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Nombre <span class="text-danger">*</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" maxlength="100" name="name" id="name" value="{{ old('name') }}" required>
                            @error('name')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">E-mail <span class="text-danger">*</span></label>
                            <input class="form-control @error('email') is-invalid @enderror" maxlength="100" type="email" name="email" id="email" value="{{ old('email') }}" required>
                            @error('email')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Teléfono <span class="text-danger">*</span></label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" maxlength="13" name="phone" id="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="order_id">N° de Orden</label>
                            <input class="form-control @error('order_id') is-invalid @enderror" type="number" name="order_id" onKeyPress="if(this.value.length==5) return false;" placeholder="Ej: 2334" id="order_id" value="{{ old('order_id') }}" >
                            @error('order_id')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="details">Detalle <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('details') is-invalid @enderror"" name="details" id="details" maxlength="255" placeholder="Describe aquí tu consulta o caso" rows="3" required>{{ old('details') }}</textarea>
                            @error('details')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endempty
@endsection
