<div class="h-100">
    <div class="col-12 h-50 overflow-auto">
        {{-- Do your work, then step back. --}}
        Cart
        @if (!is_null($products))

            @foreach ($products as $id => $product)
                @livewire('pos.cart.item', ['item' => $id, 'qty' => $product['qty'] ], key($id))
            @endforeach
        @endif
    </div>



    <div class=" col-12  h-50">

        <div class='row col-md-12 p-0 m-0'>
            <div class="col-md-6 border border-dark">
                <div class="border-right-0"> SubTotal</div>
            </div>
            <div class="col-md-6 border border-dark">
                <div class="  text-right">{{ currencyFormat($subtotal ?? 0, 'CLP', true) }}</div>
            </div>
        </div>
        <div class='row col-md-12 p-0 m-0'>
            <div class="col-md-6 border border-dark">
                <div class="  border-top-0 border-bottom-0 border-right-0"> Descuento</div>
            </div>
            <div class="col-md-6 border border-dark">
                <div class="  border-top-0 border-bottom-0 text-right">
                    {{ currencyFormat($discount ?? 0, 'CLP', true) }}
                </div>
            </div>
        </div>
        <div class='row col-md-12 p-0 m-0'>
            <div class="col-md-6 border border-dark">
                <div class="  border-right-0"> Total</div>
            </div>
            <div class="col-md-6 border border-dark">
                <div class=" text-right">{{ currencyFormat($total ?? 0, 'CLP', true) }}</div>
            </div>
        </div>
        {{-- <div class='row col-md-12 my-3'>
            <div class="col-md-6">
                <div class="row border border-dark border-right-0"> SubTotal</div>
                <div class="row border border-dark border-top-0 border-bottom-0 border-right-0"> Descuento</div>
                <div class="row border border-dark border-right-0"> Total</div>
            </div>
            <div class="col-md-6">
                <div class="row border border-dark text-right">{{ currencyFormat($subtotal ?? 0, 'CLP', true) }}</div>
                <div class="row border border-dark border-top-0 border-bottom-0 text-right">
                    {{ currencyFormat($discount ?? 0, 'CLP', true) }}
                </div>
                <div class="row border border-dark text-rigth">{{ currencyFormat($total ?? 0, 'CLP', true) }}</div>
            </div>
        </div> --}}
        @if (!is_null($products))
            <div class="row mt-2">
                <div class="col-12">
                    <button class="btn btn-danger btn-block" onclick="changeViewMode('selectCustomer')">
                        @if (session()->get('user.pos.selectedCustomer'))
                            {{ session()->get('user.pos.selectedCustomer')->first_name }}
                            {{ session()->get('user.pos.selectedCustomer')->last_name }}
                        @else
                            Seleccionar Cliente
                        @endif
                    </button>

                    <button class="btn btn-danger btn-block " onclick="changeViewMode('paymentView')" @if($total <= 0 || is_null($customer) ) disabled @endif>Pagar
                    </button>

                </div>
            </div>
        @endif
    </div>
</div>
</div>
</div>
