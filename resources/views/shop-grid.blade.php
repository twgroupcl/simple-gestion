@extends('layouts.base')

@section('content')
<!-- Page Title-->
<div class="page-title-overlap bg-dark pt-4 bg-light-blue">
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
            <h1 class="h3 text-light mb-0">Búsqueda de libros</h1>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <!-- Sidebar-->
        {{--
            <aside class="col-lg-4">
                <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar">
                    @livewire('filters')
                </div>
            </aside>
        --}}
        <!-- Content  -->
        <section class="col-lg-12">
            <!-- Toolbar-->
            <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-4 pb-sm-5">
                @livewire('sorting-products')
             {{--   <div class="d-flex pb-3"><a class="nav-link-style nav-link-light mr-3" href="#"><i class="czi-arrow-left"></i></a><span class="font-size-md text-light">1 / 5</span><a class="nav-link-style nav-link-light ml-3" href="#"><i class="czi-arrow-right"></i></a></div> --}}
             <div class="d-none d-sm-flex pb-3">
                    <a class="btn btn-icon nav-link-style bg-light text-dark disabled opacity-100 mr-2" href="#"><i class="czi-view-grid"></i></a>
                    <!--
                        <a class="btn btn-icon nav-link-style nav-link-light" href="shop-list-ls.html"><i class="czi-view-list"></i></a>
                    -->
                </div>
            </div>
            <!-- Products grid-->
            <div class=" mx-n2 mt-5">
                <!-- Product-->
                @livewire('products.card-general', ['columnLg' => 3, 'showPaginate' => true, 'paginateBy' => 16, 'showFrom' => $render['view'], 'valuesQuery' => $data])
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

@push('scripts')
<script>
    /* $(document).ready(function(){
        const urlParams = new URLSearchParams(window.location.search);
        let field = urlParams.get('field')
        let direction = urlParams.get('direction');
        let value = field + '-' + direction

        // Set option selected
        switch (value) {
            case 'name-ASC':
                $('#sorting').val('4')
                break;
            case 'name-DESC':
                $('#sorting').val('5')
                break;
            case 'price-ASC':
                $('#sorting').val('2')
                break;
            case 'price-DESC':
                $('#sorting').val('3')
                break;
        }

        var url = window.location.href.split('?')[0];

        $('#sorting').change(function(){
            window.location.href = url + '?field=' + $(this).find(':selected').data('field') + '&direction=' + $(this).find(':selected').data('direction');
        });
}); */
</script>
@endpush
