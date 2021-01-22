@extends('layouts.gym.base')

@section('title')
Solicitar reserva
@endsection

@section('header-title')
Solicitar reserva
@endsection

@section('content')
<div class="row px-0 mx-0 content">
    <div class="col-lg-8 col-md-12 inner-content">
        <div class="row mt-4 justify-content-center">
            
            @if( session('unpaid'))
            <div class="col-md-8">
                <div class="alert alert-warning">
                    {{ session('unpaid') }}
                </div>
            </div>
            @endif

            @if (session('success'))
            <div class="col-md-8">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
            @endif

            @if( $errors->any() || session('error'))
            <div class="col-md-8">
                        <div class="alert alert-danger">
                            <ul style="margin-bottom: 0px">
                                @if (session('error'))
                                    <li>{{ session('error') }}</li>
                                @endif
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                </div>
            </div>
            @endif
            

            @livewire('reservation-form', [ 
                'company' => $company, 
            ], key($company->id))
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