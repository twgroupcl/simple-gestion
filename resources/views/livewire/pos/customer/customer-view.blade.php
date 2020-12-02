<div class="row {{ $view !== 'selectCustomer' ? 'd-none' : '' }})">
    <div class="col-md-6">
        <label for="searchCustomer">Buscar cliente</label>
        <input wire:model="search" class="form-control" type="text" id="searchCustomer" placeholder="Buscar" aria-label="Buscar">
        <ul class="list-group list-group-flush">
            @foreach ($customers as $customer)
                <div class="bg-light border-right">
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action bg-white">
                            <p class="text-info my-0">{{ $customer->first_name }}</p>
                            <p class="my-0">{{ $customer->uid }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>
</div>
