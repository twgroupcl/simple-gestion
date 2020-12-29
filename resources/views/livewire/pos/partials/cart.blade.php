@php
use App\Models\Product;
@endphp
    <div class="row p-4">
        <div class="col-6 text-center ">
            <h5> Carro</h5>
        </div>
        <div class="col-6 text-right text-danger ">
            <h5>{{ currencyFormat($total ?? 0, 'CLP', true) }}</h6>
        </div>
    </div>
    <div class="row ">
        <div class="col-12 p-4">

            @if (!is_null($cartproducts))
                @foreach ($cartproducts as $id => $cartproduct)
                    @php
                    $product = Product::whereId($id)->first();
                    $qty = $cartproduct['qty'];
                    @endphp
                    @if ($product)
                        <div class="row">
                            <div class="col-9">
                                <h6 class="product-title font-size-base mb-2"><a
                                        href="{{ route('product', ['slug' => $product->url_key]) }}"
                                        target="_blank">{{ $product->name }}</a></h6>
                            </div>
                            <div class="col-3">
                                <a wire:click="removeProductCart( {{ $id }})" href="#"><i class="la la-trash"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <a @if ($qty <= 1) class="disabled-link"
                                @endif wire:click="updateQty({{ $id }},-1)">
                                <i class="la la-minus-circle"></i>
                                        </a>
                            </div>
                <div class="col-2 text-center">{{ $qty }}</div>
                <div class="col-1">
                    <a wire:click="updateQty({{ $id }},1)"><i class="la la-plus-circle"></i></a>
                </div>
                <div class="col-4 text-center">
                    <small><strong>{{ currencyFormat($product->real_price ?? 0, 'CLP', true) }}</strong> por
                        unidad</small>
                </div>
                <div class="col-3  text-right">
                    <small><strong>{{ currencyFormat($product->real_price * $qty ?? 0, 'CLP', true) }}</strong>
                    </small>
                </div>
                </div>
                @endif
                @endforeach
            @endif
        </div>
</div>

