<div class="row {{ $view !== 'selectCustomer' ? 'd-none' : '' }})">
    <div class="col-md-6">
        <label for="searchCustomer">Buscar cliente</label>
        <input wire:model="search" class="form-control" type="text" id="searchCustomer" placeholder="Buscar" aria-label="Buscar">
        <ul class="list-group list-group-flush">
            @foreach ($customers as $customer)
                <div wire:click="showCustomer({{ $customer->id }})" class="bg-light border-right">
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
    <div class="col-md-6 mt-5">
        @if($selectedCustomer)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title">{{ "{$selectedCustomer->first_name} {$selectedCustomer->last_name}" }}</h5>
                <p class="card-text text-info">{{ $selectedCustomer->email }}</p>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>RUT:</strong> {{ $selectedCustomer->uid }}</li>
                <li class="list-group-item"><strong>Teléfono:</strong> {{ $selectedCustomer->phone }}</li>
                <li class="list-group-item"><strong>Celular:</strong> {{ $selectedCustomer->cellphone }}</li>
                </ul>
                <div class="card-body">
                <button href="#" class="btn btn-success"><i class="nav-icon la la-check"></i> Seleccionar cliente</button>
                </div>
            </div>
        @endif
        <button wire:click="createCustomerInModal" class="btn btn-outline-primary"><i class="nav-icon la la-plus"></i> Agregar nuevo cliente</button>
    </div>
    <div
        class="modal fade"
        id="productAttributesModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="createCustomerModalLabel"
        aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <livewire:pos.customer.create-customer>
            </div>
    </div>
</div>
