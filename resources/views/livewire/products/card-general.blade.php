<div>
    <div class="row">
        @foreach($productos as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
                @livewire('products.product', ['product' => $product], key($product->id))
            </div>            
            <hr class="d-sm-none">                
        @endforeach
    </div>
    {{ $productos->links('paginator') }}
</div>
