
<div class="navbar-tool dropdown ml-3 cart-cursor">

    @livewire('cart.cart-counter', ['count' => $cart->items_count])

    <a class="" href="{{ $cursor === 'auto' ? route('shopping-cart') : '#' }}"  style="cursor:{{ $cursor === 'auto' ? 'pointer' : $cursor }};">
        <!--
            <small>Carro</small>{{ currencyFormat($subtotal, defaultCurrency(), true) }}
        -->    
    </a>
    @if ($cursor == 'auto')
        <!-- Cart dropdown-->
        @livewire('cart.dropdown', ['cart' => $cart])
    @endif
</div>
@push('cart-toolbar')
    @livewire('cart.toolbar', ['subtotal' => $subtotal, 'count' => $cart->items_count])
@endpush
