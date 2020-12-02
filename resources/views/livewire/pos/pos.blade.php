<div class="content">
    <div class="row">
        <div class="col-2">
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">Punto de Venta </div>
                <div class="list-group list-group-flush">
                  <a href="#" wire:click="$emitUp('viewModeChanged', 'productList')" class="list-group-item list-group-item-action bg-light">POS</a>
                  <a href="#" wire:click="$emitUp('viewModeChanged', 'selectCustomer')" class="list-group-item list-group-item-action bg-light">Customer</a>
                </div>
              </div>
        </div>
        <div class="col-7">
            @if ($viewMode == 'selectCustomer')
                @livewire('pos.customer.customer-view')
            @endif
            @if ($viewMode == 'productList')
                @livewire('pos.list-products', ['seller' => $seller, 'view' => $viewMode])
            @endif
        </div>
        <div class="col-3">@livewire('pos.cart.cart')</div>
    </div>
</div>
