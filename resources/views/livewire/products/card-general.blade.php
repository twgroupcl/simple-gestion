<div>
    @if(count($products))
    <div class="row">
        @foreach($products as $product)
            <div class="col-lg-{{$columnLg}} col-md-4 col-sm-6 px-2 mb-4">
                @livewire('products.product', ['product' => $product], key($product->id))
            </div>
            <hr class="d-sm-none">
            @endforeach
        </div>
        @if($paginateBy && $showPaginate)
            {{ $products->links('paginator') }}
        @endif
    @else
        <div class="col-lg-12 col-md-12 col-sm-12">
            <p class="text-center">No existen productos en esta búsqueda.</p>
        </div>
    @endif
</div>
