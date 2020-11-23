<div>
    {{-- Do your work, then step back. --}}
    Cart
    @if (!is_null($products))

        @foreach ($products as $productId)
             @livewire('pos.cart.item', ['item' => $productId ], key($productId))
        @endforeach
    @endif
</div>
