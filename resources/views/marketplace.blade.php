@extends('layouts.base', ['collaboration' => true])

@section('content')
<!-- Page title-->
<!-- Page Content-->
<!-- Hero One item + Dots + Loop (defaults)-->
<div class="d-none d-lg-block d-md-block d-sm-block cz-carousel cz-dots-enabled">
    <div class="cz-carousel cz-dots-enabled">
        <div class="cz-carousel-inner" data-carousel-options='{"autoplay": true, "autoHeight": true, "autoplayTimeout": 5000}'>
            <img src="{{ asset('img/filsa/banner-principal.jpg') }}" alt="Filsa Banner">
            <img src="{{ asset('img/filsa/banner-bienvenida.jpg') }}" alt="Filsa Banner">
            <a href="https://camaradellibro.cl/wp-content/uploads/2020/11/Programa-FilsaVirtual-v.1.pdf" target="_blank">
                <img src="{{ asset('img/filsa/banner-transmision-carousel.jpg') }}" alt="Filsa Banner" class="w-100">
            </a>
        </div>
    </div>
</div>

<div class="d-block d-sm-none">
    <div class="cz-carousel cz-dots-enabled">
        <div class="cz-carousel-inner" data-carousel-options='{"autoplay": true, "autoHeight": true, "autoplayTimeout": 5000}'>
            <img src="{{ asset('img/filsa/mobile-banner-principal.jpg') }}" alt="Filsa Banner">
            <img src="{{ asset('img/filsa/mobile-banner-bienvenida.jpg') }}" alt="Filsa Banner">
            <a href="https://camaradellibro.cl/wp-content/uploads/2020/11/Programa-FilsaVirtual-v.1.pdf" target="_blank">                
                <img src="{{ asset('img/filsa/mobile-banner-transmision-carousel.jpg') }}" alt="Filsa Banner" class="w-100">
            </a>
        </div>
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
                <div class="d-none d-lg-block d-md-block d-sm-block">
                    <a href="https://camaradellibro.cl/wp-content/uploads/2020/11/Programa-FilsaVirtual-v.1.pdf" target="_blank">
                        <img src="{{ asset('img/filsa/banner-transmision.jpg') }}" alt="Banner Programa Cultural" class="img-fluid">
                    </a>
                </div>
                
                <div class="d-block d-sm-none">
                    <a href="https://camaradellibro.cl/wp-content/uploads/2020/11/Programa-FilsaVirtual-v.1.pdf" target="_blank">
                        <img src="{{ asset('img/filsa/mobile-banner-transmision.jpg') }}" alt="Banner Programa Cultural" class="img-fluid w-100">
                    </a>
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
        @livewire('sellers.card-seller', ['columnLg'=>3,'showPaginate'=>false,'paginateBy' => 8,'showFrom'=>'','data'=>'','limit'=>2])
    </div>
</section>

<section class="container mt-5 mb-grid-gutter">
    <div class="rounded-lg py-4">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="cz-carousel cz-dots-enabled">
                    <div class="cz-carousel-inner" data-carousel-options='{"autoplay": true, "autoHeight": true, "autoplayTimeout": 5000}'>
                        <a href="https://camaradellibro.cl/wp-content/uploads/2020/11/Programa-FilsaVirtual-v.1.pdf" target="_blank" class="border border-white">            
                            <img src="{{ asset('img/filsa/banner-2.jpg') }}" alt="Banner Programa Cultural" class="img-fluid w-100">
                        </a>
                        <a href="https://www.bibliotecasantiago.cl/" target="_blank" class="border border-white">            
                            <img src="{{ asset('img/filsa/banner-biblioteca.jpg') }}" alt="Banner Biblioteca" class="img-fluid w-100 p-0 m-0">
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
                <img src="{{ asset('img/filsa/el-mercurio.jpg') }}" alt="Banner Programa Cultural" class="img-fluid w-50">
            </div>
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/filsa/cooperativa.jpg') }}" alt="Banner Programa Cultural" class="img-fluid w-50">
            </div>
        </div>
    </div>
</section>

<!-- Toast: Added to Cart-->
@endsection
