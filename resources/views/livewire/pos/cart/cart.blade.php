<div class="h-100">
    {{-- Do your work, then step back. --}}
    Cart
    @if (!is_null($products))

        @foreach ($products as $id => $product)
             @livewire('pos.cart.item', ['item' => $id ], key($id))
        @endforeach

        <div class='row'>
            <div class="col-md-6">
              <div class="row"> SubTotal</div>
              <div class="row"> Descuento</div>
              <div class="row"> Total</div>
            </div>
            <div class="col-md-6">
                <div class="row">{{ currencyFormat($subtotal ?? 0, 'CLP', true) }}</div>
                <div class="row">{{ currencyFormat($discount ?? 0, 'CLP', true) }}</div>
                <div class="row">{{ currencyFormat($total ?? 0, 'CLP', true) }}</div>
            </div>
        </div>
    @endif
</div>
