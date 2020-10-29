<div class="card product-card">
    {{-- <div class="product-card-actions d-flex align-items-center">
        <a class="btn-action nav-link-style mr-2" href="#"><i class="czi-compare mr-1"></i>Compare</a>
        <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left"
            title="Add to wishlist">
            <i class="czi-heart"></i>
        </button>
    </div> --}}
    <a class="card-img-top d-block overflow-hidden" href="{{route('product',['slug' => $product->url_key])}}">
        <img src="{{ url($product->getFirstImagePath()) }}" class="w-100" alt="Product">
    </a>
    <div class="card-body py-2">
        <a class="product-meta d-block font-size-xs pb-1" href="{{ url('search-products/'.$product->categories[0]->id) }}">{{ $product->showCategory() }}</a>
        <h3 class="product-title font-size-sm"><a href="{{route('product',['slug' => $product->url_key])}}">{{ $product->name }}</a></h3>
        <div class="d-flex justify-content-between">
            <!--<div class="product-price"><span class="text-accent">$198.<small>00</small></span></div>-->
            @if ($product->children()->count())
            <div class="product-price">
                <span class="text-accent">
                    {{ currencyFormat($product->getPriceRange()[0], defaultCurrency(), true) }}
                    - {{ currencyFormat($product->getPriceRange()[1], defaultCurrency(), true) }}
                </span>
            </div>
            @else
            <div class="product-price">
                @if($product->special_price)
                <span class="text-accent">{{ currencyFormat($product->special_price, defaultCurrency(), true) }}</span>
                <del class="font-size-sm text-muted"><small>{{ currencyFormat($product->price, defaultCurrency(), true) }}</small></del>
                @else
                <span class="text-accent">{{ currencyFormat($product->price, defaultCurrency(), true) }}</span>
                @endif

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
            <a class="nav-link-style font-size-ms" href="{{ route('product',['slug' => $product->url_key]) }}">
                <i class="czi-eye align-middle mr-1"></i>Ver producto
            </a>
        </div>
    </div>
</div>
