@extends('errors.layout')

@php
$error_number = 503;
@endphp

@section('title')
No eres tu, soy yo.
@endsection

@section('description')
@php
$default_error_message = 'Estamos realizando una mantención y volveremos a la brevedad, regresa en un momento. Gracias por tu comprensión.';
@endphp
{!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection
