<div class="h-100">
    {{-- Do your work, then step back. --}}
    Cart
    @if (!is_null($products))

        @foreach ($products as $id => $product)
             @livewire('pos.cart.item', ['item' => $id, 'qty' => $product['qty'] ], key($id))
        @endforeach

        <div class='row col-md-12 my-3'>
            <div class="col-md-6">
              <div class="row border border-dark border-right-0"> SubTotal</div>
              <div class="row border border-dark border-top-0 border-bottom-0 border-right-0"> Descuento</div>
              <div class="row border border-dark border-right-0"> Total</div>
            </div>
            <div class="col-md-6">
                <div class="row border border-dark">{{ currencyFormat($subtotal ?? 0, 'CLP', true) }}</div>
                <div class="row border border-dark border-top-0 border-bottom-0">{{ currencyFormat($discount ?? 0, 'CLP', true) }}</div>
                <div class="row border border-dark">{{ currencyFormat($total ?? 0, 'CLP', true) }}</div>
            </div>
        </div>
    @endif
</div>
