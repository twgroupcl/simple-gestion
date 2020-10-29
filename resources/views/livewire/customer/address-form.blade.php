<form wire:ignore.self wire:target="updateAddress" wire:submit.prevent="save" class="needs-validation modal fade" id="update-address" tabindex="-1" novalidate>
    @method('PUT')
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añade una nueva dirección</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div wire:loading>
                <p class="h6 p-3">Cargando datos...</p>
            </div>
            <div wire:loading.remove class="modal-body">
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="street">Calle <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{ $address['street'] ?? '' }}" name="street" type="text" id="street" required>
                            <div class="invalid-feedback">Escriba la calle</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="number">Número <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{ $address['number'] ?? '' }}" name="number" type="text" id="number" required>
                            <div class="invalid-feedback">Escriba el número!</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address-company">Casa/Dpto/Oficina</label>
                            <input class="form-control" type="text" value="{{ $address['subnumber'] ?? '' }}" name="subnumber" id="address-company">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="commune_id">Comuna <span class="text-danger">*</span></label>
                            <select class="custom-select" name="commune_id" id="commune_id" required>
                                @foreach ($communes as $id => $commune)
                                    <option value="{{ $id }}">{{ $commune }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Seleccione la comuna</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="uid">RUT</label>
                            <input class="form-control" value="{{ $address['uid'] ?? '' }}" name="uid" type="text" id="uid">
                            <div class="invalid-feedback">Escriba el Rut</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="first_name">Nombre</label>
                            <input class="form-control" value="{{ $address['first_name'] ?? '' }}" name="first_name" type="text" id="first_name">
                            <div class="invalid-feedback">Escriba el nombre</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="last_name">Apellido</label>
                            <input class="form-control" value="{{ $address['last_name'] ?? '' }}" name="last_name" type="text" id="last_name">
                            <div class="invalid-feedback">Escriba el apellido</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" value="{{ $address['email'] ?? '' }}" name="email" type="text" id="email">
                            <div class="invalid-feedback">Escriba el email</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input class="form-control" value="{{ $address['phone'] ?? '' }}" name="phone" type="text" id="phone">
                            <div class="invalid-feedback">Escriba el teléfono</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cellphone">Teléfono móvil</label>
                            <input class="form-control" value="{{ $address['cellphone'] ?? '' }}" name="cellphone" type="text" id="cellphone">
                            <div class="invalid-feedback">Escriba el teléfono móvil</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="extra">Detalles</label>
                            <textarea class="form-control" value="{{ $address['extra'] ?? '' }}" name="extra" id="extra"></textarea>                            <div class="invalid-feedback">Escriba el teléfono móvil</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary btn-shadow" type="submit">Añadir dirección</button>
            </div>
        </div>
    </div>
</form>



@push('scripts')
    <script>
        window.addEventListener('modal-form', event => {
            $("#update-address").modal();
            let value = @this.address['commune_id']
            $('#update-address').find(`option[value="${value}"]`).attr('selected', 'selected')
        })
    </script>
@endpush