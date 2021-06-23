<form wire:ignore.self wire:target="updateAddress" wire:submit.prevent="save" class="needs-validation modal fade" id="update-address" tabindex="-1" novalidate>
    @method('PUT')
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar dirección</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="street">Calle <span class="text-danger">*</span></label>
                            <input class="form-control" wire:model="address.street" name="street" type="text" id="street" required>
                            <div class="invalid-feedback">Escriba la calle</div>
                            @error('address.street') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="number">Número <span class="text-danger">*</span></label>
                            <input class="form-control" wire:model="address.number" name="number" type="text" id="number" required>
                            <div class="invalid-feedback">Escriba el número!</div>
                            @error('address.number') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                   {{--  <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address-company">Casa/Dpto/Oficina</label>
                            <input class="form-control" type="text" wire:model="address.subnumber" name="subnumber" id="address-company">
                            @error('address.subnumber') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div> --}}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="commune_id">Comuna <span class="text-danger">*</span></label>
                            <select class="custom-select" name="commune_id" id="commune_id" wire:model="address.commune_id" required>
                                @foreach ($communes as $id => $commune)
                                    <option wire:key="{{ $loop->index }}" value="{{ $id }}">{{ $commune }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Seleccione la comuna</div>
                            @error('address.commune_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    {{-- <div class="col-sm-6">
                        <div class="form-group">
                            <label for="uid">RUT</label>
                            <input class="form-control" wire:model="address.uid" name="uid" type="text" id="uid">
                            <div class="invalid-feedback">Escriba el Rut</div>
                            @error('address.uid') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div> --}}
                    {{-- <div class="col-sm-6">
                        <div class="form-group">
                            <label for="first_name">Nombre</label>
                            <input class="form-control" wire:model="address.first_name" name="first_name" type="text" id="first_name">
                            <div class="invalid-feedback">Escriba el nombre</div>
                            @error('address.first_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div> --}}
                    {{-- <div class="col-sm-6">
                        <div class="form-group">
                            <label for="last_name">Apellido</label>
                            <input class="form-control" wire:model="address.last_name" name="last_name" type="text" id="last_name">
                            <div class="invalid-feedback">Escriba el apellido</div>
                            @error('address.last_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div> --}}
                    {{-- <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" wire:model="address.email" name="email" type="text" id="email">
                            <div class="invalid-feedback">Escriba el email</div>
                            @error('address.email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div> --}}
                    {{-- <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input class="form-control" wire:model="address.phone" name="phone" type="text" id="phone">
                            <div class="invalid-feedback">Escriba el teléfono</div>
                            @error('address.phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div> --}}
                    {{-- <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cellphone">Teléfono móvil</label>
                            <input class="form-control" wire:model="address.cellphone" name="cellphone" type="text" id="cellphone">
                            <div class="invalid-feedback">Escriba el teléfono móvil</div>
                            @error('address.cellphone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div> --}}
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="extra">Referencias</label>
                            <textarea class="form-control" wire:model="address.extra" name="extra" id="extra"></textarea>      
                            @error('address.extra') <small class="text-danger">{{ $message }}</small> @enderror                      <div class="invalid-feedback">Escriba el teléfono móvil</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary btn-shadow" type="submit">Guardar dirección</button>
            </div>
        </div>
    </div>
</form>



@push('scripts')
    <script>
        window.addEventListener('modal-form', event => {
            $("#update-address").modal();
            let value = @this.address['commune_id']
            $('#update-address').find(`option[value="${value}"]`).prop('selected', 'selected').change();
        })

        window.addEventListener('close-modal-form', event => {
            $("#update-address").modal('hide');
        })
    </script>
@endpush