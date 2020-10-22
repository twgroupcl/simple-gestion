<div>
    <div class="widget-cart-item pb-2 border-bottom">
        <button class="close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
        <div class="media align-items-center">
            <a class="d-block mr-2" href="shop-single-v2.html"><img width="64" src="{{ url($product->getFirstImagePath()) }}" alt="Product" /></a>
            <div class="media-body">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">{{ $item->name }}</a></h6>
                <div class="widget-product-meta">
                    <!--<span class="text-accent mr-2">$259.<small>00</small></span>-->
                    <span class="text-accent mr-2">{{ currencyFormat($item->price, 'CLP', true) }}</span>
                    <span class="text-muted">x {{$item->qty}}</span>
                </div>
            </div>
        </div>
    </div>
</div>