<a class="d-table-cell cz-handheld-toolbar-item" href="{{ $cursor === 'auto' ? route('shopping-cart') : '#' }}" style="cursor:{{ $cursor === 'auto' ? 'pointer' : $cursor }};">
    <span class="cz-handheld-toolbar-icon">
        <i class="czi-cart"></i>
        @livewire('cart.cart-counter', ['count' => $count, 'view' => 'counter-toolbar'])
    </span>
    <span class="cz-handheld-toolbar-label">{{ currencyFormat($subtotal, defaultCurrency(), true) }}</span>
</a>