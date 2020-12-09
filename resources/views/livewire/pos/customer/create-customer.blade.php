<form wire:ignore.self wire:submit.prevent="createCustomer">
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
                                <input wire:model="uid" class="form-control uid @error('uid') is-invalid @enderror" type="text" name="uid" id="uid" placeholder="Rut" value="{{ old('uid') }}" required>
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
                                <input wire:model="first_name" class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" id="first_name" placeholder="Nombre" value="{{ old('first_name') }}" required>
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
                                <input wire:model="last_name" class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" id="last_name" placeholder="Apellido" value="{{ old('last_name') }}" required>
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
                                <input wire:model="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
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
                                <input wire:model="phone" class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" placeholder="Teléfono" value="{{ old('phone') }}" required>
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
                                <input wire:model="cellphone" class="form-control @error('cellphone') is-invalid @enderror" type="text" name="cellphone" id="cellphone" placeholder="Celular" value="{{ old('cellphone') }}" required>
                                @error('cellphone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit">Save Contact</button>
            <button wire:click="createCustomer" class="btn btn-primary" type="submit">
                Registrar
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cerrar
            </button>
        </div>
    </div>
</form>
