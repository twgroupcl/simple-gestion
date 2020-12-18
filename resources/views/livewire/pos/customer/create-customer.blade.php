<form wire:ignore.self>
    <div class="modal-content">
        <div class="modal-header">
            <h3>Nuevo cliente</h3>
            <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            >
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-lg-12 pt-4 pt-lg-0">
                <div class="product-details ml-auto pb-3">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="uid">RUT <span class="text-danger">*</span></label>
                                <input wire:model.defer="uid" class="form-control uid @error('uid') is-invalid @enderror" type="text" name="uid" id="uid" placeholder="Rut" value="{{ old('uid') }}" required>
                                @error('uid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="first_name">Nombre <span class="text-danger">*</span></label>
                                <input wire:model.defer="first_name" class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" id="first_name" placeholder="Nombre" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="last_name">Apellido <span class="text-danger">*</span></label>
                                <input wire:model.defer="last_name" class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" id="last_name" placeholder="Apellido" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input wire:model.defer="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input wire:model.defer="phone" class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" placeholder="Teléfono" value="{{ old('phone') }}" required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="cellphone">Celular</label>
                                <input wire:model.defer="cellphone" class="form-control @error('cellphone') is-invalid @enderror" type="text" name="cellphone" id="cellphone" placeholder="Celular" value="{{ old('cellphone') }}" required>
                                @error('cellphone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    <a class="btn btn-link font-weight-bold @error('commune_id') text-danger @else text-muted @enderror" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Agregar Dirección
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="street">Calle</label>
                                <input wire:model.defer="street" class="form-control @error('street') is-invalid @enderror" type="text" name="street" id="street" placeholder="Nombre" value="{{ old('street') }}" required>
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
                                <input wire:model.defer="number" class="form-control @error('number') is-invalid @enderror" type="text" name="number" id="number" placeholder="Nombre" value="{{ old('number') }}" required>
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
                                <input wire:model.defer="subnumber" class="form-control @error('subnumber') is-invalid @enderror" type="text" name="subnumber" id="subnumber" placeholder="Nombre" value="{{ old('subnumber') }}" required>
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
                                <select wire:model.defer="commune_id" t class="custom-select @error('subnumber') is-invalid @enderror" name="commune_id" id="commune_id" required>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="createNewCustomer" class="btn btn-primary" type="button">
                Registrar Cliente
            </button>
            <button wire:click="createWildcardCustomer" class="btn btn-outline-primary" type="button">
                Cliente Comodín
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cerrar
            </button>
        </div>
    </div>
</form>
