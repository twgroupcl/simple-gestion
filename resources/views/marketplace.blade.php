@extends('layouts.base', ['collaboration' => true])

@section('content')
<!-- Page title-->
<!-- Page Content-->
<!-- Hero One item + Dots + Loop (defaults)-->
<div class="cz-carousel cz-dots-enabled">
    <div class="cz-carousel-inner" data-carousel-options='{"autoplay": true, "autoHeight": true, "autoplayTimeout": 5000}'>
        <a href=""><img src="{{ asset('img/seller-register.png') }}" alt="Registra tu Pyme" class="img-fluid"></a>
        <img src="{{ asset('img/home/hero-slider/banner-02.png') }}" alt="Contigo Pyme Banner 2">
        <img src="{{ asset('img/home/hero-slider/banner-03.png') }}" alt="Contigo Pyme Banner 3">
    </div>
</div>
<!-- Products grid (Trending products)-->
<section class="container pt-5">
    <!-- Heading-->
    <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 mr-2">Productos</h2>
        <div class="pt-3"><a class="btn btn-outline-accent btn-sm" href="shop-grid-ls.html">Más productos<i class="czi-arrow-right ml-1 mr-n1"></i></a></div>
    </div>
    <!-- Grid-->
    <div class="row pt-2 mx-n2">
        <!-- Product-->
        @foreach ($products as $product)
            @if (! $product->parent_id)
            <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
                @livewire('products.product', ['product' => $product], key($product->id))
            </div>    
            @endif
        @endforeach
</section>

<section class="container mt-5 mb-grid-gutter">
    <div class="rounded-lg py-4">
        <div class="row align-items-center">
            <div class="col-md-12">
                <img src="{{ asset('img/home-banner-01.png') }}" alt="Banner promoción 1" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Promo banner-->
{{-- <section class="container mt-4 mb-grid-gutter">
    <div class="bg-faded-info rounded-lg py-4">
        <div class="row align-items-center">
            <div class="col-md-5">
                <img src="{{ asset('img/home-banner-01.png') }}" alt="Banner promoción 1" class="img-fluid">
                <div class="px-4 pr-sm-0 pl-sm-5"><span class="badge badge-danger">Limited Offer</span>
                    <h3 class="mt-4 mb-1 text-body font-weight-light">All new</h3>
                    <h2 class="mb-1">Last Gen iPad Pro</h2>
                    <p class="h5 text-body font-weight-light">at discounted price. Hurry up!</p>
                    <div class="cz-countdown py-2 h4" data-countdown="07/01/2021 07:00:00 PM">
                        <div class="cz-countdown-days"><span class="cz-countdown-value"></span><span class="cz-countdown-label text-muted">d</span></div>
                        <div class="cz-countdown-hours"><span class="cz-countdown-value"></span><span class="cz-countdown-label text-muted">h</span></div>
                        <div class="cz-countdown-minutes"><span class="cz-countdown-value"></span><span class="cz-countdown-label text-muted">m</span></div>
                        <div class="cz-countdown-seconds"><span class="cz-countdown-value"></span><span class="cz-countdown-label text-muted">s</span></div>
                    </div><a class="btn btn-accent" href="#">View offers<i class="czi-arrow-right font-size-ms ml-1"></i></a>
                </div>
            </div>
            <div class="col-md-7"><img src="{{ asset('img/home/banners/offer.jpg') }}" alt="iPad Pro Offer"></div>
        </div>
    </div>
</section> --}}
<!-- Brands carousel-->
{{-- <section class="container mb-5">
    <div class="cz-carousel border-right">
        <div class="cz-carousel-inner" data-carousel-options="{ &quot;nav&quot;: false, &quot;controls&quot;: false, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;loop&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;360&quot;:{&quot;items&quot;:2},&quot;600&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
            <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="{{ asset('img/shop/brands/13.png') }}" style="width: 165px;" alt="Brand"></a></div>
            <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="{{ asset('img/shop/brands/14.png') }}" style="width: 165px;" alt="Brand"></a></div>
            <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="{{ asset('img/shop/brands/17.png') }}" style="width: 165px;" alt="Brand"></a></div>
            <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="{{ asset('img/shop/brands/16.png') }}" style="width: 165px;" alt="Brand"></a></div>
            <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="{{ asset('img/shop/brands/15.png') }}" style="width: 165px;" alt="Brand"></a></div>
            <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="{{ asset('img/shop/brands/18.png') }}" style="width: 165px;" alt="Brand"></a></div>
            <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="{{ asset('img/shop/brands/19.png') }}" style="width: 165px;" alt="Brand"></a></div>
            <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="{{ asset('img/shop/brands/20.png') }}" style="width: 165px;" alt="Brand"></a></div>
        </div>
    </div>
</section> --}}
<!-- Product widgets-->
<section class="container pb-4 pb-md-5">
    <div class="row">
        <!-- Bestsellers-->
        <div class="col-lg-4 col-md-6 mb-2 py-3">
            <div class="widget">
                <h3 class="widget-title">Mejor vendido</h3>                
                @livewire('products.products-general',['emitTo' => 'products.short-list'])                
                <p class="mb-0">...</p><a class="font-size-sm" href="shop-grid-ls.html">Ver más<i class="czi-arrow-right font-size-xs ml-1"></i></a>
            </div>
        </div>
        <!-- New arrivals-->
        <div class="col-lg-4 col-md-6 mb-2 py-3">
            <div class="widget">
                <h3 class="widget-title">Nuevos productos</h3>
                @livewire('products.products-general',['emitTo' => 'products.short-list'])                
                <p class="mb-0">...</p><a class="font-size-sm" href="shop-grid-ls.html">Ver más<i class="czi-arrow-right font-size-xs ml-1"></i></a>
            </div>
        </div>
        <!-- Top rated-->
        <div class="col-lg-4 col-md-6 mb-2 py-3">
            <div class="widget">
                <h3 class="widget-title">Más vendidos</h3>
                @livewire('products.products-general',['emitTo' => 'products.short-list'])                
                <p class="mb-0">...</p><a class="font-size-sm" href="shop-grid-ls.html">Ver más<i class="czi-arrow-right font-size-xs ml-1"></i></a>
            </div>
        </div>
    </div>
</section>

<section class="container mt-4 mb-grid-gutter">
    <div class="rounded-lg py-4">
        <div class="row align-items-center">
            <div class="col-md-6 pb-3">
                <img src="{{ asset('img/home-banner-02.png') }}" alt="Banner promoción 2" class="img-fluid">
            </div>
            <div class="col-md-6 pb-3">
                <img src="{{ asset('img/home-banner-03.png') }}" alt="Banner promoción 3" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<section class="container mt-4 mb-grid-gutter">
    <div class="rounded-lg py-4">
        <div class="row align-items-center">
            <div class="col-md-12">
                <img src="{{ asset('img/home-banner-04.png') }}" alt="Banner promoción 4" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- YouTube feed-->
{{-- <section class="container pb-5 mb-md-3">
    <div class="border rounded-lg p-3">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="bg-secondary p-5 text-center"><img class="d-block mb-4 mx-auto" src="{{ asset('img/home/yt-logo.png') }}" width="120" alt="YouTube">
<div class="media justify-content-center align-items-center mb-4"><img class="mr-2" src="{{ asset('img/home/yt-subscribers.png') }}" width="126" alt="YouTube Subscribers"><span class="font-size-sm">250k+</span></div><a class="btn btn-primary border-0 btn-sm mb-3" href="#" style="background-color: #ff0000;"><i class="czi-add-user mr-2"></i>Subscribe*</a>
<p class="font-size-sm mb-0">*View latest gadgets reviews available for purchase in our store.
</p>
</div>
</div>
<div class="col-md-8">
    <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-2">
        <h2 class="h4 mb-3">Latest videos from Cartzilla channel</h2><a class="btn btn-outline-accent btn-sm mb-3" href="#">More videos<i class="czi-arrow-right font-size-xs ml-1 mr-n1"></i></a>
    </div>
    <div class="row no-gutters">
        <div class="col-lg-4 col-6 mb-3"><a class="video-cover video-popup-btn d-block text-decoration-0 px-2" href="https://www.youtube.com/embed/vS93u75NnPo">
                <div class="video-cover-thumb mb-2"><span class="badge badge-dark">6:16</span><img class="w-100" src="{{ asset('img/home/video/cover01.jpg') }}" alt="Video cover">
                </div>
                <h6 class="font-size-sm pt-1">5 New Cool Gadgets You Must See on Cartzilla - Cheap
                    Budget</h6>
            </a></div>
        <div class="col-lg-4 col-6 mb-3"><a class="video-cover video-popup-btn d-block text-decoration-0 px-2" href="https://www.youtube.com/embed/B6LaYgGogf0">
                <div class="video-cover-thumb mb-2"><span class="badge badge-dark">7:27</span><img class="w-100" src="{{ asset('img/home/video/cover02.jpg') }}" alt="Video cover">
                </div>
                <h6 class="font-size-sm pt-1">5 Super Useful Gadgets on Cartzilla You Must Have in 2020
                </h6>
            </a></div>
        <div class="col-lg-4 col-6 mb-3"><a class="video-cover video-popup-btn d-block text-decoration-0 px-2" href="https://www.youtube.com/embed/kB-ROfRS9V4">
                <div class="video-cover-thumb mb-2"><span class="badge badge-dark">6:20</span><img class="w-100" src="{{ asset('img/home/video/cover03.jpg') }}" alt="Video cover">
                </div>
                <h6 class="font-size-sm pt-1">Top 5 New Amazing Gadgets on Cartzilla You Must See</h6>
            </a></div>
        <div class="col-lg-4 col-6 mb-3 d-lg-none"><a class="video-cover video-popup-btn d-block text-decoration-0 px-2" href="https://www.youtube.com/embed/sJK67XXE_Rg">
                <div class="video-cover-thumb mb-2"><span class="badge badge-dark">6:11</span><img class="w-100" src="{{ asset('img/home/video/cover04.jpg') }}" alt="Video cover">
                </div>
                <h6 class="font-size-sm font-weight-bold pt-1">5 Amazing Construction Inventions and
                    Working Tools Available...</h6>
            </a></div>
    </div>
</div>
</div>
</div>
</section> --}}
<!-- Blog + Instagram info cards-->
{{-- <section class="container-fluid px-0">
    <div class="row no-gutters">
        <div class="col-md-6"><a class="card border-0 rounded-0 text-decoration-none py-md-4 bg-faded-primary" href="blog-list-sidebar.html">
                <div class="card-body text-center"><i class="czi-edit h3 mt-2 mb-4 text-primary"></i>
                    <h3 class="h5 mb-1">Read the blog</h3>
                    <p class="text-muted font-size-sm">Latest store, fashion news and trends</p>
                </div>
            </a></div>
        <div class="col-md-6"><a class="card border-0 rounded-0 text-decoration-none py-md-4 bg-faded-accent" href="#">
                <div class="card-body text-center"><i class="czi-instagram h3 mt-2 mb-4 text-accent"></i>
                    <h3 class="h5 mb-1">Follow on Instagram</h3>
                    <p class="text-muted font-size-sm">#ShopWithCartzilla</p>
                </div>
            </a></div>
    </div>
</section> --}}

<!-- Toast: Added to Cart-->
@endsection
