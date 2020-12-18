
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">inside de {{ session()->get('user.pos.selectedCustomer', false)->first_name }}</h4>
        </div>
        @if ($showForm)
            <div class="modal-body row">
                <div class="col-md-6">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="street">Calle</label>
                            <input wire:model.lazy="street" class="form-control @error('street') is-invalid @enderror" type="text" name="street" id="street" placeholder="Nombre" value="{{ old('street') }}" required>
                            @error('street')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="number">Número</label>
                            <input wire:model.lazy="number" class="form-control @error('number') is-invalid @enderror" type="text" name="number" id="number" placeholder="Nombre" value="{{ old('number') }}" required>
                            @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="subnumber">Casa/Dpto/Oficina</label>
                            <input wire:model.lazy="subnumber" class="form-control @error('subnumber') is-invalid @enderror" type="text" name="subnumber" id="subnumber" placeholder="Nombre" value="{{ old('subnumber') }}" required>
                            @error('subnumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div wire:init="loadCommunes" class="col-sm-12">
                        <div class="form-group">
                            <label for="commune_id">Comuna</label>
                            <select wire:model.lazy="commune_id" t class="custom-select @error('subnumber') is-invalid @enderror" name="commune_id" id="commune_id" required>
                                @foreach ($communes as $id => $commune)
                                    <option wire:key="{{ $loop->index }}" value="{{ $id }}">{{ $commune }}</option>
                                @endforeach
                            </select>
                            @error('commune_id')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>
                    <button wire:click="createNewAddress({{ session()->get('user.pos.selectedCustomer')->id }})" class="btn btn-primary" type="button" data-dismiss="modal">
                        Registrar y elegir
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                </div>
                <div class="col-md-6">
                    @foreach ($addresses as $address)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item row">
                                <div class="btn btn-link col-9">
                                    {{ $address->street }} {{ $address->number }} {{ $address->subnumber }} - {{ $address->commune->name }}
                                </div>
                                <button wire:click="selectCustomerAddress({{ $address->id }})" class="btn btn-outline-success col-2" data-dismiss="modal">Elegir</button>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
