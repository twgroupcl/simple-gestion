@extends('layouts.gym.base')

@section('title')
Solicitar reservación
@endsection

@section('header-title')
Solicitar reservación
@endsection

@section('content')
<div class="row px-0 mx-0 content">
    <div class="col-lg-8 col-md-12 inner-content">
        <div class="row mt-4 justify-content-center">
            @livewire('reservation-form', ['company' => $company, 'errors' => $errors->all()])
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