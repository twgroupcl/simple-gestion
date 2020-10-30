<div>
    @foreach($productsShort as $product)
        <div class="media align-items-center pb-2 border-bottom"><a class="d-block mr-2" href="{{$product->url_key ? route('product',['slug' => $product->url_key]) : '#'}}"><img width="64" src="{{ url($product->getFirstImagePath()) }}" alt="Product" /></a>
            <div class="media-body">
                <h6 class="widget-product-title"><a href="{{ $product->url_key ? route('product',['slug' => $product->url_key]) : '#' }}">{{$product->name}}</a></h6>
                <div class="widget-product-meta">
                    @if ($product->children()->count())
                    <div class="product-price">
                        <span class="text-accent">
                            {{currencyFormat($product->getPriceRange()[0], defaultCurrency(), true)}} - {{currencyFormat($product->getPriceRange()[1], defaultCurrency(), true)}}
                        </span>
                    </div>
                    @else
                    <div class="product-price"><span class="text-accent">{{ currencyFormat($product->price, defaultCurrency(), true) }}</span></div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
