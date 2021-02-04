
@handheld
<div class="col-4 mb-1 px-1 product-cart">
    <div wire:click="shareProductInModal" class="card card-block justify-content-center h-75" >
        <a class="p-1">
            @if(file_exists(public_path($product->getFirstImagePath())))
                <img src="{{ url($product->getFirstImagePath()) }}" class="card-img-top mt-auto " alt="Product">
            @else
                <img src="{{ asset('img/no-image-96.png')}}" class="card-img-top" alt="Product">
            @endif
        </a>
        <div class="card-body pl-0 pr-0 pt-1 pb-1 h-25 ">

            <h6 class="cart-title text-center small product-name-mobile"> {{Str::limit($product->name, 20, $end='...')}}</h6>


        </div>
        <div class="card-footer pl-0 pr-0 pt-1 pb-1 h-25">
            <h5> class="  text-center h5 mb-3 mt-auto p-2">{{ currencyFormat($currentPrice, 'CLP', true) }}</h5>
        </div>
    </div>
</div>
@elsehandheld
<div class="col-md-2 mb-3 px-1 product-cart">
    <div wire:click="shareProductInModal" class="card h-100">
        <a class="p-3">
            @if( $product->getFirstImagePath() != '/img/default/default-product-image.png' && file_exists(public_path($product->getFirstImagePath()) ))
                <img src="{{ url($product->getFirstImagePath()) }}" class="card-img-top" alt="Product">
            @else
                <img src="{{ asset('img/no-image-96.png')}}" class="card-img-top" alt="Product">
            @endif
        </a>
        <div class="card-body">
            <p class="text-center w-100 small product-name"> {{ $product->name }}</p>
            {{-- <p class="h5 text-center w-100">{{ currencyFormat($currentPrice, 'CLP', true) }}</p> --}}
            <p class="h5 text-center w-100">{{ currencyFormat($currentPrice?$currentPrice : 0, 'CLP', true) }}</p>
        </div>
        {{-- <button class="btn btn-primary btn-shadow btn-block" type="button" wire:click="addToCart">
            <i class="czi-cart font-size-lg mr-2"></i>Añadir al carro
        </button> --}}
    </div>
</div>
@endhandheld
