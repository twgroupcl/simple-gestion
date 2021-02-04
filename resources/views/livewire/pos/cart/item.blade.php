
<div>
    @php
    use App\Models\Product;
    $product = Product::whereId($item)->first();
    @endphp
    @if ($product)

        <div>

            {{-- <div class="media-body pt-2">
                <h6 class="product-title font-size-base mb-2"><a
                        href="{{ route('product', ['slug' => $product->url_key]) }}"
                        target="_blank">{{ $product->name }}</a><a
                        wire:click="$emitUp('remove-from-cart:post', {{ $item }})" href="#"><i
                            class="la la-times"></i></a></h3>
                    @if (filled($product->getAttributesWithNames()))
                        @foreach ($product->getAttributesWithNames() as $attribute)
                            @if ($attribute['value'] != '* No aplica')
                                <div class="font-size-sm"><span
                                        class="text-muted mr-2">{{ $attribute['name'] }}:</span>{{ $attribute['value'] }}
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <div class="d-inline-block font-size-lg text-accent pt-2 form-inline">
                        <input wire:model="qty" type="number" min="1" class="form-control w-50 h-25 input-sm"> item(s)
                    </div><br>
                    <strong>{{ currencyFormat($product->real_price ?? 0, 'CLP', true) }}</strong> por unidad

            </div> --}}

            <div class="row">
                <div class="col-9">
                    <h6 class="product-title font-size-base mb-2"><a
                   {{--  href="{{ route('product', ['slug' => $product->url_key]) }}" --}}
                    target="_blank">{{ $product->name }}</a></h6>
                </div>
                <div class="col-3">
                    <a
                    wire:click="$emitUp('remove-from-cart:post', {{ $item }})" href="#"><i
                        class="la la-trash"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                   <a @if($qty <= 1) class="disabled-link" @endif wire:click="updatedQty(-1)"><i class="la la-minus-circle"></i></a>
                </div>
                <div class="col-md-2 text-center">
                   {{$qty}}
                </div>
                <div class="col-md-1">
                    <a wire:click="updatedQty(1)"><i class="la la-plus-circle"></i></a>
                </div>
                <div class="col-md-4 text-center">
                    <small><strong>{{ currencyFormat($product->real_price ?? 0, 'CLP', true) }}</strong> por unidad</small>
                </div>
                <div class="col-md-3  text-right">
                    <small><strong>{{ currencyFormat($product->real_price * $qty ?? 0, 'CLP', true) }}</strong> </small>
                </div>
            </div>

        </div>
    @endif

</div>
