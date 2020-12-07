@extends('attendance.layout.base')

@section('title')
    Registrar asistencia
@endsection

@section('header-title')
Registra tu Check in / Check out
@endsection

@section('content')
<div class="row px-0 mx-0 content">
    <div class="col-lg-8 col-md-12 inner-content">
        <div class="row mt-4 justify-content-center">
            <div class="col-md-8">

                @if (session('error'))
                    <div class="alert alert-warning mx-3" role="alert">
                        {{ session('error') }}
                    </div> 
                @endif
                
                <form action="{{ route('attendance.post', [ 'company' => $company->id ]) }}" method="POST">
                    @csrf
                    <div class="form-group col-md-12">
                        <input 
                            type="text" 
                            class="form-control form-control-lg" 
                            name="rut"
                            placeholder="Ingresa tu RUT"
                            id="rut"
                            value="{{ old('rut') }}"
                            required
                        >
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Registrar asistencia
                        </button>
                    </div>

                    <input type="hidden" name="confirm" value="{{  request()->get('confirm') ?? '0'  }}">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection