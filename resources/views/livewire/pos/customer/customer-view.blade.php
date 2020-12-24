@handheld
<div class="row ">
    <div class="col-12 text-center">
        <h6>Clientes</h6>
    </div>
    <div class="col-12">
    <div id="accordion">
    @foreach ($customers as $key=>$customer)
    <div class="card mb-1 customer-item">
      <div class="card-header" id="{{'heading-'.$key}}">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#{{'customer-'.$key}}" aria-expanded="false" aria-controls="{{'customer-'.$key}}">
            <p class="text-info my-0"><i class="las la-user" ></i> {{ $customer->first_name }}</p>
          </button>
        </h5>
      </div>

      <div id="{{'customer-'.$key}}" class="collapse" aria-labelledby="{{'heading-'.$key}}" data-parent="#accordion">
        <div class="card-body">
            <div class="card-body">
                <h5 class="card-title customer-name"> {{ "{$customer->first_name} {$customer->last_name}" }}</h5>
                <p class="card-text text-info">{{ $customer->email }}</p>

                <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>RUT:</strong> {{ $customer->uid }}</li>
                <li class="list-group-item"><strong>Teléfono:</strong> {{ $customer->phone }}</li>
                <li class="list-group-item"><strong>Celular:</strong> {{ $customer->cellphone }}</li>
                @if (! session()->get('user.pos.isSelectedCustomerWildcard', false))
                    @if ($selectedAddress)
                        <li class="list-group-item"><strong>Dirección:</strong> <button wire:click="selectAddress" class="btn btn-link">{{ $selectedAddress->street }}</button></li>
                    @elseif ($showAddressOption)
                        <li class="list-group-item"><strong>Dirección:</strong> <button wire:click="selectAddress" class="btn btn-link">Elegir dirección (opcional)</button></li>
                    @endif
                @endif
                </ul>
                <div class="card-body">
                    @if (!session()->get('user.pos.isSelectedCustomerWildcard', false))
                        <button wire:click="selectCustomer({{ $customer->id }})" class="btn btn-success"><i class="nav-icon la la-check"></i> Elegir este cliente</button>
                    @endif
                </div>
        </div>
      </div>
    </div>
    </div>
   @endforeach
  </div>
</div>
</div>
@elsehandheld
<div class="row col-md-12">
    <div class="col-md-6">
        <label for="search-customer">Buscar cliente</label>
        <input class="form-control search-customers" type="text" id="search-customer" placeholder="Buscar">
        <ul class="list-group list-group-flush" style="max-height: 500px; overflow-y: scroll;">
            @foreach ($customers as $key=>$customer)
                <div wire:click="showCustomer({{ $customer->id }})" class="bg-light border-right customer-item"  wire:key="{{ $key }}">
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action bg-white">
                            <p class="text-info my-0 customer-name">{{ $customer->first_name }}</p>
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
                @if (! session()->get('user.pos.isSelectedCustomerWildcard', false))
                    @if ($selectedAddress)
                        <li class="list-group-item"><strong>Dirección:</strong> <button wire:click="$emit('showAddressForm', {{ optional($selectedCustomer)->id }})" class="btn btn-link">{{ $selectedAddress->street }}</button></li>
                    @elseif ($showAddressOption)
                        <li class="list-group-item"><strong>Dirección:</strong> <button wire:click="$emit('showAddressForm', {{ optional($selectedCustomer)->id }})" class="btn btn-link">Elegir dirección (opcional)</button></li>
                    @endif
                @endif
                </ul>
                <div class="card-body">
                    @if (! session()->get('user.pos.isSelectedCustomerWildcard', false))
                        <button wire:click="selectCustomer({{ $selectedCustomer['id'] }})" class="btn btn-success"><i class="nav-icon la la-check"></i> Elegir este cliente</button>
                    @endif
                </div>
            </div>
        @elseif (session()->get('user.pos.selectedCustomer'))
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ session()->get('user.pos.selectedCustomer')->first_name }} {{ session()->get('user.pos.selectedCustomer')->last_name }}</h5>
                    <p class="card-text text-info">{{ session()->get('user.pos.selectedCustomer')->email }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>RUT:</strong> {{ session()->get('user.pos.selectedCustomer')->uid }}</li>
                    <li class="list-group-item"><strong>Teléfono:</strong> {{ session()->get('user.pos.selectedCustomer')->phone }}</li>
                    <li class="list-group-item"><strong>Celular:</strong> {{ session()->get('user.pos.selectedCustomer')->cellphone }}</li>
                </ul>
                <div class="card-body">
                    @if (! session()->get('user.pos.isSelectedCustomerWildcard', false))
                        <button wire:click="selectCustomer({{ session()->get('user.pos.selectedCustomer')['id'] }})" class="btn btn-success"><i class="nav-icon la la-check"></i> Elegir este cliente</button>
                    @endif
                </div>
            </div>
        @endif
        <button onclick="showCustomerModal()" class="btn btn-outline-primary"><i class="nav-icon la la-plus"></i> Agregar nuevo cliente</button>
    </div>

</div>
@endhandheld
