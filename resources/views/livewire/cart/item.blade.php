@php
    $product = $item->product;
@endphp

<div class="d-sm-flex justify-content-between align-items-center my-4 pb-3 border-bottom">
    <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left"><a
            class="d-inline-block mx-auto mr-sm-4" href="shop-single-v1.html"
            style="width: 10rem;"><img src="{{ url($product->getFirstImagePath()) }}" alt="Product"></a>
        <div class="media-body pt-2">
            <h3 class="product-title font-size-base mb-2"><a href="shop-single-v1.html">{{$product->name}}</a></h3>
            <div class="font-size-sm"><span class="text-muted mr-2">Size:</span>8.5</div>
            <div class="font-size-sm"><span class="text-muted mr-2">Color:</span>White &amp; Blue
            </div>
            <div class="font-size-lg text-accent pt-2">{{ currencyFormat($product->price,'CLP',true) }} <!--$154.<small>00</small>--></div>
        </div>
    </div>
    <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left"
        style="max-width: 9rem;">
        <div class="form-group mb-0">
            @livewire('qty-item', [
                'qty' => $item->qty,
                //'parentListener' => 'setQty' implicit
            ])
        </div>
        @if ($confirm == $item->id)
            <button wire:click.prevent="delete" class="btn btn-link px-0 text-danger" type="button"><i
                class="czi-trash mr-2"></i><span class="font-size-sm">Eliminar</span></button>
        @else
            <button wire:click.prevent="deleteConfirm({{$item->id}})" class="btn btn-link px-0 text-danger" type="button"><i
                class="czi-close-circle mr-2"></i><span class="font-size-sm">Eliminar</span></button>
        @endif
    </div>
</div>
