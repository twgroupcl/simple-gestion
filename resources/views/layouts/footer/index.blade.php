@php
    $footer = (isset($footer)) ? $footer : true;
@endphp

@include('layouts.footer.menu')

@include('layouts.footer.toolbar')

@include('layouts.footer.top')

<x-location-modal/>

@livewire('loading')