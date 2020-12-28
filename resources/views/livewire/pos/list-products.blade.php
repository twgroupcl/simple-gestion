{{-- <div wire:loading wire:target="products" class="loading"></div> --}}
<div class="container">
    <div class="row">
        @foreach ($products as $product)
            @livewire('pos.product', ['product' => $product], key($product->id))
        @endforeach
    </div>
    <!-- Order Details Modal-->
    <div
        class="modal fade"
        id="productAttributesModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="productAttributesModalLabel"
        aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <livewire:pos.product-custom-attributes>
            </div>
        </div>
</div>
