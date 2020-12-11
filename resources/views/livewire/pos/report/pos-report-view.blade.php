<div class="row col-md-12">
    <div class="col-md-6 px-0">
        <form class="form-inline">
            <input id="search" class="form-control mr-sm-2 w-100" type="search" placeholder="Buscar orden" aria-label="Search">
        </form>
        <div class="pt-3 pr-2">
            <div class="list-group">
                @foreach ($orders as $order)
                <a href="#" wire:click="selectOrder({{ $order->id }})" class=" list-group-item text-decoration-none">
                    <div class="d-flex justify-content-between" >
                        <span class="text-danger"># {{ $order->id }} </span>
                        <span class="">{{ $order->created_at->format('j/m/Y - g:i a') }}</span>
                        <span class="font-weight-bold">{{ currencyFormat($order->total, 'CLP', true) }}</span>
                    </div>
                </a>
                @endforeach
            </div>
          </div>
    </div>
    <div class="col-md-6 px-0">
        @isset($selectedOrder)
            <div class="card px-5 py-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="text-muted font-weight-bold"># Orden</div>
                        <div class="text-danger font-weight-bold m-0"># {{ $selectedOrder->id }}</div>
                    </li>
                    <li class="list-group-item">
                        <div class="text-muted font-weight-bold">Fecha</div>
                        <div class="m-0">{{ $selectedOrder->created_at->format('j/m/Y - g:i a') }}</div>
                    </li>
                    <li class="list-group-item">
                        <div class="text-muted font-weight-bold">Detalles del cliente</div>
                        <div class="text-danger m-0">{{ $order->first_name }}</div>
                        <div class="m-0">{{ $order->email }}</div>
                    </li>
                </ul>
                <div class="card-body">
                    <button href="#" class="btn btn-success">Imprimir Boleta</button>
                </div>
            </div>
        @endisset
    </div>
</div>
