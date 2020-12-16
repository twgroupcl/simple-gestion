@extends('layouts.gym.base')

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
                        <div class="custom-control custom-checkbox mt-2">
                            <input 
                                class="custom-control-input" 
                                name="is_foreign" 
                                type="checkbox" 
                                id="is_foreign_checkbox"
                                {{ old('is_foreign') == 'on' ? 'checked' : '' }}
                            >
                            <label class="custom-control-label" for="is_foreign_checkbox">Extranjero</label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <select name="service_id" class="custom-select" style="height: calc(1.5em + 1.5rem + 2px)" required>
                            <option value="" disabled selected>Selecciona un servicio</option>
                            @foreach ($services as $service)
                                <option 
                                    value="{{ $service->id }}"
                                    {{ old('service_id') == $service->id ? 'selected' : '' }}
                                >
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
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

@push('scripts')
<script src="{{ asset('js/rut-formatter.js') }}"></script>
<script>

    $('#rut').rut();

    let isForeignCheck = $('#is_foreign_checkbox');

    function removeEventListeners(elementId) {
        let el = document.getElementById(elementId),
        elClone = el.cloneNode(true);
        el.parentNode.replaceChild(elClone, el);
    }

    if (isForeignCheck.prop('checked')) {
        removeEventListeners('rut')
    } else {
        $('#rut').rut();
    }

    isForeignCheck.change( function() {
        if (isForeignCheck.prop('checked')) {
            removeEventListeners('rut')
        } else {
            $('#rut').rut();
        }
    })

</script>
@endpush