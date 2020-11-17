<div class="col-md-4 mb-3">
    <div wire:click="shareProductInModal" class="card h-100">
        <div class="d-flex justify-content-end position-absolute w-100">
            <div class="label-sale">
                <span class="badge badge-success">+</span>
            </div>
        </div>
        <a class="p-3">
        <img src="{{ url($product->getFirstImagePath()) }}" class="card-img-top" alt="Product">
        </a>
        <div class="card-body">
            <p class="text-center w-100"> {{ $product->name }}</p>
            <p class="h5 text-center w-100">{{ currencyFormat($product->real_price, 'CLP', true) }}</p>
        </div>
    </div>
</div>
