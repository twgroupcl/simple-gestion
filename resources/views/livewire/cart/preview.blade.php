<div class="row">
    <div class="col-md-7"> 
        <div class="row">
        <form wire:submit.prevent='updateCart({{$items}})' class="w-100">
            <div class="content-items">
                <div class="row border-bottom-secondary font-weight-bold">
                    <div class="col-md-6">
                        <p class="fs-1-2 mb-2">Items</p>
                    </div>
                    <div class="col-md-2 text-center">
                        <p class="fs-1-2 mb-2">Cantidad</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <p class="fs-1-2 mb-2">Subtotal</p>
                    </div>
                </div>
                @foreach ($items as $item)
                    @livewire('cart.item', ['item' => $item], key($item->id))
                @endforeach
   
                <div class="row mt-3">
                    <div class="col-md-6">
                        <a class="text-decoration-none border-bottom-secondarytext-decoration-none border-bottom-secondary fs-1-2 text-blue" href="{{ url('/') }}">Seguir comprando</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-blue float-right fs-1" {{$cartChange}} >Actualizar carrito</button>
                    </div>
                </div>
            </div>  
        </form>
        </div>
    </div>
    <div class="col-md-4 offset-md-1">
        <div class="border-color-primary border-radius-secondary p-4">
            <p class="fs-1-5 font-weight-bold">Resumen de la compra</p>
            <div class="row border-bottom border-secondary">
                <div class="col-md-6"><p>Subtotal</p></div>
                <div class="col-md-6 text-right"><p>{{ currencyFormat($total,'CLP',true) }}</p></div>
            </div>
            <div class="row mt-2 font-weight-bold fs-1-2">
                <!-- @todo coupon code -->
                <div class="col-md-6">Total</div>
                <div class="col-md-6 text-right">{{ currencyFormat($total,'CLP',true) }}</div>
                <button type="button" wire:click="checkout" class="btn btn-principal btn-block mt-5">Proceder a pagar</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <input type="text" class="w-100 height-2 border-color-blue border-radius-primary p-2" placeholder="Ingrese un cupón de descuento"> 
            </div>
            <div class="col-md-12 mt-4">
                <button class="btn btn-blue fs-1">Aplicar cupón</button>
            </div>
        </div>
    </div>
</div>