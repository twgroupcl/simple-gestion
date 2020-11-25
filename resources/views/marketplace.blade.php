@extends('layouts.base', ['collaboration' => true])

@section('content')
<!-- Page title-->
<!-- Page Content-->
<!-- Hero One item + Dots + Loop (defaults)-->
<div class="cz-carousel cz-dots-enabled">
    <div class="cz-carousel-inner" data-carousel-options='{"autoplay": true, "autoHeight": true, "autoplayTimeout": 5000}'>
        <img src="{{ asset('img/filsa/banner-filsa.jpg') }}" alt="Filsa Banner">
        <img src="{{ asset('img/filsa/banner-filsa.jpg') }}" alt="Filsa Banner">
    </div>
</div>

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
        @livewire('sellers.card-seller', ['columnLg'=>3,'showPaginate'=>false,'paginateBy' => 8,'showFrom'=>'','data'=>'','limit'=>1])
    </div>
</section>

<section class="container mt-5 mb-grid-gutter">
    <div class="rounded-lg py-4">
        <div class="row align-items-center">
            <div class="col-md-12">
                <img src="{{ asset('img/filsa/banner-1.jpg') }}" alt="Banner Programa Cultural" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!--
    <section class="container pt-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
            <h2 class="h3 mb-0 pt-3 mr-2">Expositores</h2>
        </div>
        <div class="pt-2 mx-n2">
            @livewire('sellers.card-seller', ['columnLg'=>3,'showPaginate'=>false,'paginateBy' => 8,'showFrom'=>'','data'=>'','limit'=>2])
        </div>
    </section>
-->
<section class="container mt-5 mb-grid-gutter">
    <div class="rounded-lg py-4">
        <div class="row align-items-center">
            <div class="col-md-12">
                <img src="{{ asset('img/filsa/banner-2.jpg') }}" alt="Banner Programa Cultural" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<section class="container mt-5 mb-grid-gutter">
    <div class="rounded-lg py-4">
        <div class="row align-items-center">
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/filsa/tvn.jpg') }}" alt="Banner Programa Cultural" class="img-fluid w-75">
            </div>
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/filsa/el-mercurio.jpg') }}" alt="Banner Programa Cultural" class="img-fluid w-75">
            </div>
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/filsa/cooperativa.jpg') }}" alt="Banner Programa Cultural" class="img-fluid w-75">
            </div>
        </div>
    </div>
</section>

<!-- Toast: Added to Cart-->
@endsection
