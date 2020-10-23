@extends('layouts.base')

@section('content')
<!-- Page Title-->
<div class="page-title-overlap bg-dark pt-4 bg-cp-gradient">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        {{-- <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a></li>
                    <li class="breadcrumb-item text-nowrap"><a href="#">Shop</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Grid left sidebar</li>
                </ol>
            </nav>
        </div> --}}
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-light mb-0">Búsqueda de productos</h1>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <!-- Sidebar-->
        {{-- @include('layouts.general.section-category') --}}
        <!-- Content  -->
        <section class="col-lg-12">
            <!-- Toolbar-->
            <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-4 pb-sm-5">
                <!--
                <div class="d-flex flex-wrap">
                    <div class="form-inline flex-nowrap mr-3 mr-sm-4 pb-3">
                        <label class="text-light opacity-75 text-nowrap mr-2 d-none d-sm-block" for="sorting">Ordenar por:</label>
                        <select class="form-control custom-select" id="sorting">
                            <option>Popularity</option>
                            <option>Low - Hight Price</option>
                            <option>High - Low Price</option>
                            <option>Average Rating</option>
                            <option>A - Z Order</option>
                            <option>Z - A Order</option>
                        </select>
                        <span class="font-size-sm text-light opacity-75 text-nowrap ml-2 d-none d-md-block">of 287 products</span>
                    </div>
                </div>
                <div class="d-flex pb-3"><a class="nav-link-style nav-link-light mr-3" href="#"><i class="czi-arrow-left"></i></a><span class="font-size-md text-light">1 / 5</span><a class="nav-link-style nav-link-light ml-3" href="#"><i class="czi-arrow-right"></i></a></div>
            -->
                <div class="d-none d-sm-flex pb-3">
                    <a class="btn btn-icon nav-link-style bg-light text-dark disabled opacity-100 mr-2" href="#"><i class="czi-view-grid"></i></a>
                    <!--
                        <a class="btn btn-icon nav-link-style nav-link-light" href="shop-list-ls.html"><i class="czi-view-list"></i></a>
                    -->
                </div>
            </div>
            <!-- Products grid-->
            <div class="row mx-n2">
                <!-- Product-->
                @if(empty($products[0]))
                    <p>No existen productos en esta busqueda</p>
                @else
                    @foreach ($products as $product)
                    @php
                        if ($product->parent()->count()) continue;
                    @endphp
                        <div class="col-lg-2 col-md-2 col-sm-6 px-2 mb-4">
                            @livewire('products.product', ['product' => $product], key($product->id))
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- Banner-->
            <!--
                <div class="py-sm-2">
                    <div class="d-sm-flex justify-content-between align-items-center bg-secondary overflow-hidden mb-4 rounded-lg">
                        <div class="py-4 my-2 my-md-0 py-md-5 px-4 ml-md-3 text-center text-sm-left">
                            <h4 class="font-size-lg font-weight-light mb-2">Converse All Star</h4>
                            <h3 class="mb-4">Make Your Day Comfortable</h3><a class="btn btn-primary btn-shadow btn-sm" href="#">Shop Now</a>
                        </div><img class="d-block ml-auto" src="img/shop/catalog/banner.jpg" alt="Shop Converse">
                    </div>
                </div>
            -->
            <hr class="my-3">
            <!-- Pagination-->
            <!--
                <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i class="czi-arrow-left mr-2"></i>Antes</a></li>
                    </ul>
                    <ul class="pagination">
                        <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span></li>
                        <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">1<span class="sr-only">(current)</span></span></li>
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="#">2</a></li>
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="#">3</a></li>
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="#">4</a></li>
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="#">5</a></li>
                    </ul>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#" aria-label="Next">Siguiente<i class="czi-arrow-right ml-2"></i></a></li>
                    </ul>
                </nav>
            -->
        </section>
    </div>
</div>
@endsection
