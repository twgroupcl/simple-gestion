<div>
    <div class="widget-cart-item pb-2 border-bottom">
        @if ($confirm == $item->id)
            <button class="close text-danger" wire:click.prevent="delete" type="button" aria-label="Remove"><span aria-hidden="true"><i
                class="czi-trash"></i></span></button>
        @else
            <button class="close text-danger" wire:click.prevent="deleteConfirm({{$item->id}})" type="button" aria-label="Remove"><span aria-hidden="true"><i
                class="czi-close-circle"></i></span></button>
        @endif
        <div class="media align-items-center">
            <a class="d-block mr-2" href="{{route('product',['slug' => $product->url_key])}}"><img width="64" src="{{ url($product->getFirstImagePath()) }}" alt="Product" /></a>
            <div class="media-body">
                <h6 class="widget-product-title"><a href="{{route('product',['slug' => $product->url_key])}}">{{ $item->name }}</a></h6>
                <div class="widget-product-meta">
                    <!--<span class="text-accent mr-2">$259.<small>00</small></span>-->
                    <span class="text-accent mr-2">{{ currencyFormat($item->price, Setting::get('default_currency'), true) }}</span>
                    <span class="text-muted">x {{$qty}}</span>
                </div>
            </div>
        </div>
    </div>
</div>