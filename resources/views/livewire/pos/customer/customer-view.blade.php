<div class="container {{ $view !== 'selectCustomer' ? 'd-none' : '' }})">
    <label for="searchCustomer">Buscar cliente</label>
    <input wire:model="search" class="form-control" type="text" id="searchCustomer" placeholder="Buscar" aria-label="Buscar">
    <ul class="list-group">
        @foreach ($customers as $customer)
            <li class="list-group-item">{{ $customer->first_name }}</li>
        @endforeach
    </ul>
</div>
