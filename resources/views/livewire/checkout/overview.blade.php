<div>
    <!-- Order details-->
    <h2 class="h6 pt-1 pb-3 mb-3 border-bottom">Detalles de tu orden</h2>

    @foreach ($cart->cart_items as $item)
        @livewire('cart.item', [
            'item' => $item, 
            'showShipping' => true , 
            'showAttributes' => true, 
            'showOptions' => false
        ], key($item->id))
    @endforeach
    <!-- Client details-->
    <div class="bg-secondary rounded-3 px-4 pt-4 pb-2">
        <div class="row">
            @if ($this->shippingMethod->code === 'picking')
            <div class="col-sm-6">
                <h4 class="h6">Persona que retira:</h4>
                <ul class="list-unstyled fs-sm">
                    <li>RUT {{ $cart->pickup_person_info['uid'] }}</li>
                    <li>{{ $cart->pickup_person_info['name'] }}</li>
                    {{-- <li>{{ $cart->pickup_person_info['email'] }}</li> --}}
                    <li>{{ $cart->pickup_person_info['phone'] }}</li>
                </ul>
            </div>
            @else
            <div class="col-sm-6">
                <h4 class="h6">Dirección de envío:</h4>
                <ul class="list-unstyled fs-sm">
                    <li>{{ $cart->first_name }} {{ $cart->last_name }}</li>
                    <li>{{ $cart->address_street }} {{ $cart->address_office }}</li>
                    <li>{{ $cart->commune->name }}</li>
                    <li><span class="text-muted">Teléfono:&nbsp;</span> {{  $cart->phone }}</li>
                </ul>
            </div>
            @endif
            
            @if ($this->shippingMethod->code === 'picking')
            <div class="col-sm-6">
                <h4 class="h6">Sucursal de retiro:</h4>
                <ul class="list-unstyled fs-sm">
                    <li>{{ $cart->getSeller()->visible_name }}</li>
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
