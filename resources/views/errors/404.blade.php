@extends('errors.layout')

@php
  $error_number = 404;
@endphp

@section('title')
  Pagina no encontrada.
@endsection

@section('description')
  @php
    $default_error_message = "Puedes volver a la <a href='javascript:history.back()''>pagina anterior</a> o ir a nuestra <a href='".url('')."'>pagina de inicio</a>.";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection