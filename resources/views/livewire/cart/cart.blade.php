
<div class="navbar-tool dropdown ml-3">
    
    <livewire:cart.cart-counter/>

    <a class="navbar-tool-text" href="{{route('shopping-cart')}}">
        <small>Carro</small>$1,247.00
    </a>
    <!-- Cart dropdown-->
    @livewire('cart.dropdown')
    
</div>