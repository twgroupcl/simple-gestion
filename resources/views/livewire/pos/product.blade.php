<div class="col-md-2 mb-3">
    <div wire:click="shareProductInModal" class="card h-100">
        <a class="p-3">
        <img src="{{ url($product->getFirstImagePath()) }}" class="card-img-top" alt="Product">
        </a>
        <div class="card-body">
            <p class="text-center w-100 small"> {{ $product->name }}</p>
            <p class="h5 text-center w-100">{{ currencyFormat($currentPrice, 'CLP', true) }}</p>
        </div>
        {{-- <button class="btn btn-primary btn-shadow btn-block" type="button" wire:click="addToCart">
            <i class="czi-cart font-size-lg mr-2"></i>Añadir al carro
        </button> --}}
    </div>
</div>
