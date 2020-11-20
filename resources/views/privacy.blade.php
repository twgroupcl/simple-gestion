@extends('layouts.base')

@section('content')
<!-- Page title-->
<!-- Page Title (Light)-->
<div class="page-title-overlap bg-dark py-4 bg-light-blue">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        {{-- <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a></li>
                    <li class="breadcrumb-item text-nowrap"><a href="help-topics.html">Help center</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Single topic</li>
                </ol>
            </nav>
        </div> --}}
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-light mb-2">Privacidad</h1>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container py-5 mt-md-2 mb-2">
    <div class="row">
        <embed src="{{ url('pdf/POLITICAS_DE_PRIVACIDAD_CONTIGOPYME_CRCP.pdf') }}" type="application/pdf" width="100%" height="600px" />
    </div>
</div>
@endsection
