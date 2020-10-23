<div class="dropdown-menu dropdown-menu-right" style="width: 20rem;">
    <div class="widget widget-cart px-3 pt-2 pb-3">
        <div style="height: {{$items->count() > 3 ? '15' : $items->count() * 5}}rem;" data-simplebar data-simplebar-auto-hide="false">
            @foreach ($cart->cart_items as $item)
                @livewire('cart.item', ['item' => $item, 'view' => 'cart.dropdown-item'], key($loop->index))
            @endforeach
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
            <div class="font-size-sm mr-2 py-2">
                <span class="text-muted">Subtotal:</span><span class="text-accent font-size-base ml-1">{{ $cart->sub_total ? currencyFormat($cart->sub_total, Setting::get('default_currency'),true) : currencyFormat(0, Setting::get('default_currency'),true) }}</span>
            </div>
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('shopping-cart') }}">Ver carro<i class="czi-arrow-right ml-1 mr-n1"></i></a>
        </div><a class="btn btn-primary btn-sm btn-block" href="{{ route('checkout') }}"><i class="czi-card mr-2 font-size-base align-middle"></i>Realizar Pago</a>
    </div>
</div>