<div>
    @if ($shippingMethod->code === 'picking')
    <h2 class="h6 pb-3 mb-2">Persona que retira</h2>

    <div class="row pb-4">

        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Nombre <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="picking.name"
                id="sd-fisrtname">
            @error('picking.name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">RUT <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="picking.uid"
                id="sd-fisrtuid">
            @error('picking.uid') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Email <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="picking.email"
                id="sd-fisrtemail">
            @error('picking.email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Telefono <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="picking.cellphone"
                id="sd-fisrtcellphone">
            @error('picking.cellphone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>
    @else
    <h2 class="h6 pb-3 mb-2">Dirección de envío</h2>

    <div class="row pb-4">
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Comuna <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="data.commune"
                id="sd-fisrtname">
            @error('data.commune') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Calle <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="data.street"
                id="sd-fisrtname">
            @error('data.street') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Oficina/Casa/Dpto <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="data.office"
                id="sd-fisrtname">
            @error('data.office') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Telefono <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="data.cellphone"
                id="sd-fisrtname">
            @error('data.cellphone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>
    @endif

    <div class="custom-control custom-checkbox pb-3 mb-3">
        <input class="custom-control-input" type="checkbox" id="is-business" wire:model="requiredInvoice">
        <label class="custom-control-label" for="is-business">¿Necesita factura?</label>
    </div>

    @if ($requiredInvoice)
    <h2 class="h6 pb-3 mb-2">Datos de facturacíon</h2>

    <div class="row pb-4">
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">RUT <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.uid"
                id="sd-fisrtname">
            @error('invoice.uid') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Razón social <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.first_name"
                id="sd-fisrtname">
            @error('invoice.first_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Giro <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.bussiness_activity"
                id="sd-fisrtname">
            @error('invoice.bussiness_activity') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Email <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.email"
                id="sd-fisrtname">
            @error('invoice.email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Comuna <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.commune"
                id="sd-fisrtname">
            @error('invoice.commune') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Calle <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.street"
                id="sd-fisrtname">
            @error('invoice.street') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Oficina/Casa/Dpto <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.office"
                id="sd-fisrtname">
            @error('invoice.office') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Telefono <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.cellphone"
                id="sd-fisrtname">
            @error('invoice.cellphone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>
    @endif
    
</div>
