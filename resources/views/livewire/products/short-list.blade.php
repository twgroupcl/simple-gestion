<div>
    @foreach($products as $product)
        <div class="media align-items-center pb-2 border-bottom"><a class="d-block mr-2" href="shop-single-v2.html"><img width="64" src="{{ url($product->getFirstImagePath()) }}" alt="Product" /></a>
            <div class="media-body">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">{{$product->name}}</a></h6>
                <div class="widget-product-meta">
                    @if ($product->children()->count())
                    <div class="product-price">
                        <span class="text-accent">
                            {{currencyFormat($product->getPriceRange()[0], \Setting::get('default_currency'), true)}} - {{currencyFormat($product->getPriceRange()[1], Setting::get('default_currency'), true)}}
                        </span>
                    </div>
                    @else 
                    <div class="product-price"><span class="text-accent">{{ currencyFormat($product->price, Setting::get('default_currency'), true) }}</span></div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
