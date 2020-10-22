<div>
    <div class="card product-card">
        {{-- <div class="product-card-actions d-flex align-items-center">
            <a class="btn-action nav-link-style mr-2" href="#"><i class="czi-compare mr-1"></i>Compare</a>
            <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left"
                title="Add to wishlist">
                <i class="czi-heart"></i>
            </button>
        </div> --}}
        <a class="card-img-top d-block overflow-hidden" href="shop-single-v2.html">
            <img src="{{ url($product->getFirstImagePath()) }}" alt="Product">
        </a>
        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1"
                href="#">{{ $product->showCategory() }}</a>
            <h3 class="product-title font-size-sm"><a href="shop-single-v2.html">{{ $product->name }}</a></h3>
            <div class="d-flex justify-content-between">
                <!--<div class="product-price"><span class="text-accent">$198.<small>00</small></span></div>-->
                @if ($product->children()->count())
                    <div class="product-price">
                        <span class="text-accent">
                            {{ currencyFormat($product->getPriceRange()[0], \Setting::get('default_currency'), true) }}
                            - {{ currencyFormat($product->getPriceRange()[1], Setting::get('default_currency'), true) }}
                        </span>
                    </div>
                @else
                    <div class="product-price"><span
                            class="text-accent">{{ currencyFormat($product->price, Setting::get('default_currency'), true) }}</span>
                    </div>
                @endif
                {{-- <div class="star-rating">
                    <i class="sr-star czi-star-filled active"></i>
                    <i class="sr-star czi-star-filled active"></i>
                    <i class="sr-star czi-star-filled active"></i>
                    <i class="sr-star czi-star-filled active"></i>
                    <i class="sr-star czi-star-filled active"></i>
                </div> --}}
            </div>
        </div>
        <div class="card-body card-body-hidden">
            @if ($product->product_type_id == 1)
                @livewire('products.add-to-cart',['product' => $product])
            @endif
            <div class="text-center">
                <a class="nav-link-style font-size-ms" href="#quick-view-electro" data-toggle="modal">
                    <i class="czi-eye align-middle mr-1"></i>Ver producto
                </a>
            </div>
        </div>
    </div>
    <hr class="d-sm-none">
</div>
