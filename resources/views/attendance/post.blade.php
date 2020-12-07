@extends('attendance.layout.base')

@section('title')
Asistencia registrada
@endsection

@section('header-title')
    @if ($attendance->entry_type === $typeCheckIn)
    ¡Check In registrado!
    @endif
    @if ($attendance->entry_type === $typeCheckOut)
    ¡Check Out registrado!
    @endif
@endsection

@section('content')
<div class="row px-0 mx-0 content">
    <div class="col-lg-8 col-md-12 inner-content">
        <div class="row mt-4 justify-content-center">
            <div class="col-md-8">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Cliente</b>: {{ $attendance->customer->first_name  . ' ' . $attendance->customer->last_name }}</li>
                    <li class="list-group-item"><b>Hora marcada</b>: {{ $attendance->attendance_time->format('h:i A') }}</li>
                  </ul>
            </div>
        </div>
    </div>
</div>
@endsection