<div>
    @foreach($productsShort as $product)
        <div class="media align-items-center pb-2 border-bottom">
            <a class="d-block mr-2" href="{{$product->url_key ? route('product',['slug' => $product->url_key]) : '#'}}">
                <img class="" width="64" src="{{ url($product->getFirstImagePath()) }}" alt="Product" />
            </a>
            <div class="media-body">
                <h6 class="widget-product-title"><a href="{{ $product->url_key ? route('product',['slug' => $product->url_key]) : '#' }}">{{ $product->name }}</a></h6>
                {{-- <h6 class="widget-product-title"><a href="{{ $product->url_key ? route('product',['slug' => $product->url_key]) : '#' }}" @if(strlen($product->name) > 80) data-toggle="tooltip" data-placement="top" title="{{ $product->name }}" @endif>{{ substr($product->name, 0, 80) }} @if(strlen($product->name) > 80) ... @endif</a></h6> --}}
                <div class="widget-product-meta">
                    @if ($product->children()->count())
                        @if ($product->has_special_price)
                        <div class="product-price">
                            @if ($product->getRealPriceRange()[0] == $product->getRealPriceRange()[1])
                                <span class="text-accent">
                                    {{ currencyFormat($product->getRealPriceRange()[0], defaultCurrency(), true) }}
                                </span>
                                <del class="font-size-xs text-muted"><small>
                                    {{ currencyFormat($product->getPriceRange()[0], defaultCurrency(), true) }}
                                </small></del>
                            @else
                                <span class="text-accent">  
                                    {{ currencyFormat($product->getRealPriceRange()[0], defaultCurrency(), true) }} - {{ currencyFormat($product->getRealPriceRange()[1], defaultCurrency(), true) }}
                                </span>
                                <del class="font-size-xs text-muted"><small>
                                    {{ currencyFormat($product->getPriceRange()[0], defaultCurrency(), true) }} - {{ currencyFormat($product->getPriceRange()[1], defaultCurrency(), true) }}
                                </small></del>
                             @endif
                        </div>
                        @else 
                            <div class="product-price">
                                <span class="text-accent">
                                    @if ($product->getPriceRange()[0] == $product->getPriceRange()[1])
                                    {{ currencyFormat($product->getPriceRange()[0], defaultCurrency(), true) }}
                                    @else
                                    {{ currencyFormat($product->getPriceRange()[0], defaultCurrency(), true) }} - {{ currencyFormat($product->getPriceRange()[1], defaultCurrency(), true) }}
                                    @endif
                                </span>
                            </div> 
                        @endif
                    
                    @else
                        @if ($product->has_special_price)
                            <div class="product-price">
                                <span class="text-accent">{{ currencyFormat($product->real_price, defaultCurrency(), true) }}</span>
                                <del class="text-muted font-size-xs">{{currencyFormat($product->price, defaultCurrency(), true) }}</del>
                            </div>
                        @else
                            <div class="product-price"><span class="text-accent">{{ currencyFormat($product->price, defaultCurrency(), true) }}</span></div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
