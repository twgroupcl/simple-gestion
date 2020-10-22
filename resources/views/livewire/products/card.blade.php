<div>
    <div class="card product-card">
        <!--
            <div class="product-card-actions d-flex align-items-center">
                <a class="btn-action nav-link-style mr-2" href="#"><i class="czi-compare mr-1"></i>Compare</a>
                <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist">
                    <i class="czi-heart"></i>
                </button>
            </div>
        -->
        <a class="card-img-top d-block overflow-hidden" href="{{ url('product/'.$product->url_key) }}">
            <img src="{{ url($product->getFirstImagePath()) }}" alt="Product" class="w-100">
        </a>
        <div class="card-body py-2">
            <div class="row">
                <a class="col-md-6 col-sm-6 product-meta d-block font-size-xs pb-1" href="{{ url('product/'.$product->url_key) }}">{{$product->showCategory()}}</a>
                <a class="col-md-6 col-sm-6 product-meta d-block font-size-xs pb-1 text-right" href="{{ url('seller-shop/'.$product->seller->id) }}">Tienda {{$product->seller->name}}</a>
            </div>
            <h3 class="product-title font-size-sm"><a href="{{ url('product/'.$product->url_key) }}">{{$product->name}}</a></h3>
            <div class="d-flex justify-content-between">
                <!--<div class="product-price"><span class="text-accent">$198.<small>00</small></span></div>-->
                <div class="product-price"><span class="text-accent">{{ currencyFormat($product->price, 'CLP', true)}}</span></div>
                <!--
                    <div class="star-rating">
                        <i class="sr-star czi-star-filled active"></i>
                        <i class="sr-star czi-star-filled active"></i>
                        <i class="sr-star czi-star-filled active"></i>
                        <i class="sr-star czi-star-filled active"></i>
                        <i class="sr-star czi-star-filled active"></i>
                    </div>
                -->
            </div>
        </div>
        <div class="card-body card-body-hidden">
            @livewire('products.add-to-cart',['product' => $product])
            <div class="text-center">
                <a class="nav-link-style font-size-ms" href="{{ url('product/'.$product->url_key) }}">
                    <i class="czi-eye align-middle mr-1"></i>Ver producto
                </a>
            </div>
        </div>
    </div>
    <hr class="d-sm-none">
</div>
