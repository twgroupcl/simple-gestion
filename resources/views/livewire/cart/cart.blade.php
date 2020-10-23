
<div class="navbar-tool dropdown ml-3 cart-cursor">
    
    <livewire:cart.cart-counter/>

    <a class="navbar-tool-text" href="{{ $cursor === 'auto' ? route('shopping-cart') : '#'}}"  style="cursor:{{ $cursor == 'auto' ? 'pointer' : $cursor }};">
        <small>Carro</small>{{ currencyFormat($subtotal, Setting::get('default_currency'), true) }}
    </a>

    @if ($cursor === 'auto')
        <!-- Cart dropdown-->
        @livewire('cart.dropdown')    
    @endif
    
</div>