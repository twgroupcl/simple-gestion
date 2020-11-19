@extends('layouts.base')

@section('content')
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
                                    <option selected>Seleccione una opción...</option>
                                    <option value="1">1. Consulta</option>
                                    <option value="2">2. Reclamo</option>
                                    <option value="3">3. Sugerencia</option>
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
                            <input class="form-control @error('subject') is-invalid @enderror" type="text" name="subject" id="subject" placeholder="Escribe aquí el asunto" value="{{ old('subject') }}" >
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
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Escribe aquí tu nombre" value="{{ old('name') }}" >
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
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Escribe aquí tu email" value="{{ old('email') }}" >
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
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" value="{{ old('phone') }}" >
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
                            <input class="form-control @error('order_id') is-invalid @enderror" type="number" name="order_id" id="order_id" value="{{ old('order_id') }}" >
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
                            <textarea class="form-control @error('details') is-invalid @enderror"" name="details" id="details" rows="3">{{ old('details') }}</textarea>
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
@endsection
