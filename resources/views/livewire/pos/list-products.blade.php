<div class="container">
    <div class="row">
        @foreach ($products as $product)
            @livewire('pos.product', ['product' => $product], key($product->id))
        @endforeach
    </div>
    <!-- Order Details Modal-->
    <livewire:pos.product-custom-attributes>
</div>
