@extends('layouts.base', ['collaboration' => true])

@section('content')
<!-- Page title-->
<!-- Page Content-->
<!-- Hero One item + Dots + Loop (defaults)-->
<div class="d-none d-lg-block d-md-block d-sm-block cz-carousel cz-dots-enabled">
    <div class="cz-carousel cz-dots-enabled">
        <div class="cz-carousel-inner" data-carousel-options='{"autoplay": true, "autoHeight": true, "autoplayTimeout": 5000}'>
            <img src="{{ asset('img/prolibro/banner-principal-feria.jpg') }}" alt="Prolibro Banner">
            <img src="{{ asset('img/prolibro/banner-principal-prolibro.jpg') }}" alt="Prolibro Banner">
            {{-- <a href="https://filsaenvivo.com/" target="_blank">
                <img src="{{ asset('img/filsa/banner-transmision-carousel.jpg') }}" alt="Prolibro Banner" class="w-100">
            </a> --}}
        </div>
    </div>
</div>

<div class="d-block d-sm-none">
    <div class="cz-carousel">
        <div  class="cz-carousel-inner mh-75 h-75 cz-dots-enabled">
            <div class="cz-carousel-inner" data-carousel-options='{"autoplay": true, "autoHeight": true, "autoplayTimeout": 5000}'>
                <img src="{{ asset('img/prolibro/mobile-banner-principal-feria.jpg') }}" alt="Prolibro Banner">
                <img src="{{ asset('img/prolibro/mobile-banner-principal-prolibro.jpg') }}" alt="Prolibro Banner">
                {{-- <a href="https://filsaenvivo.com/" target="_blank">
                    <img src="{{ asset('img/filsa/mobile-banner-transmision-carousel.jpg') }}" alt="Filsa Banner" class="w-100">
                </a> --}}
            </div>
        </div>
    </div>
</div>
<section class="container p-0">
    <div class="col-12 text-right d-none d-sm-block">
        <a href="https://www.facebook.com/camarachilenalibro/" target="_blank">
            <img src="{{ asset('img/filsa/boton-transmision.jpg') }}" alt="Transmision en vivo" class="w-25">
        </a>
    </div>
    <div class="col-12 text-right d-sm-none">
        <a href="https://www.facebook.com/camarachilenalibro/" target="_blank">
            <img src="{{ asset('img/filsa/boton-transmision.jpg') }}" alt="Transmision en vivo">
        </a>
    </div>
</section>

<!--
    <section class="container mt-5 mb-grid-gutter">
        <div class="rounded-lg py-4">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <p class="h5 text-justify">
                        Le damos la bienvenida a la 39ª Feria Internacional del Libro de Santiago que, en esta versión, por primera vez, se realiza a través de nuestra plataforma de Marketplace permitiendo acceder a la Feria desde cualquier comuna o lugar de Chile.
                    </p>
                    <p class="h5 text-justify">
                        Más de 80 tiendas de librerías, editoriales y distribuidoras forman parte de www.filsavirtual.cl 2020 (libros y lecturas), en ellas usted podrá encontrar la más amplia cantidad y diversidad de libros de diferentes categorías y temáticas pudiendo adquirirlos en línea.
                    </p>
                    <p class="h5 text-justify">
                        Asimismo, podrá disfrutar del atractivo programa cultural que acompaña la feria y que incluye presentaciones de libros, conferencias y conversaciones con autores, recitales, cine, teatro, música y actividades de fomento lector para niños.
                    </p>
                </div>
            </div>
        </div>
    </section>
-->

<!-- Products grid (Trending products)-->
<section class="container pt-5">
    <!-- Heading-->
    <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 mr-2">Expositores</h2>
    </div>
    <!-- Grid-->
    <div class="pt-2 mx-n2">
        <!-- Product-->
        <!-- @livewire('sellers.card-seller', ['columnLg'=>3,'showPaginate'=>false,'paginateBy' => 8,'showFrom'=>'','data'=>'','limit'=>1]) -->

        @if(count($sellers))
            <div class="row">
                @foreach($sellers[0] as $key => $seller)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 px-5 mb-4" wire:key="{{ $key }}">
                        @livewire('sellers.seller', ['seller' => $seller], key($seller->id . $key))
                    </div>
                    <hr class="d-sm-none">
                @endforeach
            </div>
        @else
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p class="text-center">No existen tiendas en esta búsqueda.</p>
            </div>
        @endif
    </div>
</section>

<section class="container mt-5 mb-grid-gutter">
    <div class="rounded-lg py-4">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="d-none d-lg-block d-md-block d-sm-block">
                    <img src="{{ asset('img/prolibro/banner-medio-prolibro.jpg') }}" alt="Banner Prolibro" class="img-fluid">
                </div>

                <div class="d-block d-sm-none">
                    <img src="{{ asset('img/prolibro/mobile-banner-medio-prolibro.jpg') }}" alt="Banner Prolibro" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container pt-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 mr-2">Expositores</h2>
    </div>
    <div class="pt-2 mx-n2">
        <!-- @livewire('sellers.card-seller', ['columnLg'=>3,'showPaginate'=>false,'paginateBy' => 8,'showFrom'=>'','data'=>'','limit'=>2]) -->

        @if(count($sellers))
            <div class="row">
                @foreach($sellers[1] as $key => $seller)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 px-5 mb-4" wire:key="{{ $key }}">
                        @livewire('sellers.seller', ['seller' => $seller], key($seller->id . $key))
                    </div>
                    <hr class="d-sm-none">
                @endforeach
            </div>
        @else
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p class="text-center">No existen tiendas en esta búsqueda.</p>
            </div>
        @endif
    </div>
</section>

<section class="container mt-5 mb-grid-gutter">
    <div class="rounded-lg py-4">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="cz-carousel cz-dots-enabled">
                    <div class="cz-carousel-inner" data-carousel-options='{"autoplay": true, "autoHeight": true, "autoplayTimeout": 5000}'>
                        <a href="http://www.clubmercuriovalpo.cl/suscripciones/" target="_blank" class="border border-white">
                            <img src="{{ asset('img/prolibro/banner-suscripcion-mercurio.jpg') }}" alt="Banner Suscripcion Mercurio" class="img-fluid w-100">
                        </a>
                        <a href="http://www.radiovalparaiso.cl/" target="_blank" class="border border-white">
                            <img src="{{ asset('img/prolibro/banner-radio-valparaiso.jpg') }}" alt="Banner Suscripcion Mercurio" class="img-fluid w-100">
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mt-5 mb-grid-gutter">
    <div class="rounded-lg py-4">
        <div class="row align-items-center">
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/filsa/tvn.jpg') }}" alt="Banner Programa Cultural" class="img-fluid w-50">
            </div>
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/prolibro/partner-mercurio.jpg') }}" alt="Banner Mercurio" class="img-fluid w-50">
            </div>
            <div class="col-md-4 text-center">
                <a href="https://www.radiovalparaiso.cl/" target="_blank">
                    <img src="{{ asset('img/prolibro/partner-valparaiso.jpg') }}" alt="Banner Radio Valparaiso" class="img-fluid w-50">
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Toast: Added to Cart-->
@endsection
