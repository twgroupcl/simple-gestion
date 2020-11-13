<div>
    @foreach ($products as $product)
        @livewire('pos.product', ['product' => $product], key($product->id))
    @endforeach
</div>
