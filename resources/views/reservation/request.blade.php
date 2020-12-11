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
<script>
    $(document).ready(function () {
        $('input[name="date"]').datepicker();
    })
</script>
@endpush