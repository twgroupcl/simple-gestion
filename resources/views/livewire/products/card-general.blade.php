<div>
    <div class="row">
        @foreach($productos as $product)
            <div class="col-lg-{{$columnLg}} col-md-4 col-sm-6 px-2 mb-4">
                @livewire('products.product', ['product' => $product], key($product->id))
            </div>            
            <hr class="d-sm-none">                
        @endforeach
    </div>
    @if($paginateBy && $showPaginate)
        {{ $productos->links('paginator') }}
    @endif
</div>
