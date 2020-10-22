{{-- TODO Remove --}}
<div>
     <!-- Product-->
     <div class="media d-block d-sm-flex align-items-center py-4 border-bottom"><a
        class="d-block position-relative mb-3 mb-sm-0 mr-sm-4 mx-auto"
        href="" style="width: 12.5rem;"><img class="rounded-lg"
            src="{{ url($item->product->getFirstImagePath()) }}" alt="Product"><span class="close-floating"
            data-toggle="tooltip" title="Remove from Cart"><i class="czi-close"></i></span></a>
    <div class="media-body text-center text-sm-left">
        <h3 class="h6 product-title mb-2"><a >{{$item->name}}</a></h3>
        <div class="d-inline-block text-accent"> {{ currencyFormat($item->price ? $item->price : 0, 'CLP', true) }}</div><a
            class="d-inline-block text-accent font-size-ms border-left ml-2 pl-2" href="#">by
            Tienda Uno</a>
        <div class="form-inline pt-2">
            <select class="custom-select custom-select-sm my-1 mr-2" wire:model="selected" wire:change="$emit('select-shipping-item')">
                <option value="0">Seleccione un metodo de pago</option>
                @foreach ($shippingMethods as $key=>$shipping)
                    <option value="{{$key}}">{{$shipping['name']}} ({{currencyFormat($shipping['price'] ? $shipping['price'] : 0, 'CLP', true)}})</option>
                @endforeach
                {{-- <option>ChileExpress ($3.500)</option>
                <option>Envio Gratis</option> --}}
            </select>
        </div>
    </div>
</div>
</div>
