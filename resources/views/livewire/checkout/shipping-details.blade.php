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
                id="sd-uid">
            @error('picking.uid') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Email <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="picking.email"
                id="sd-email">
            @error('picking.email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Telefono <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="picking.phone"
                id="sd-phone">
            @error('picking.phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>
    @else
    <h2 class="h6 pb-3 mb-2">Dirección de envío</h2>

    <div class="row pb-4">
        <div class="col-sm-6 form-group">
            <label for="sd-commune">Comuna <span class='text-danger'>*</span></label>
            <select class="custom-select" wire:model="data.address_commune_id" id="sd-commune" disabled>
                <option value>Seleccione una comuna</option>
                @foreach (\App\Models\Commune::orderBy('name', 'asc')->get(['id', 'name']) as $commune)
                    <option 
                        value="{{ $commune->id }}"
                    >{{ $commune->name }}</option>
                @endforeach
            </select>
            @error('data.address_commune_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Calle <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="data.address_street"
                id="sd-address_street"
                disabled
            >
            @error('data.address_street') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Oficina/Casa/Dpto <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="data.address_office"
                id="sd-address_office">
            @error('data.address_office') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Telefono <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="data.phone"
                id="sd-phone">
            @error('data.phone') <small class="text-danger">{{ $message }}</small> @enderror
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
                id="sd-uid">
            @error('invoice.uid') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Razón social <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.business_name"
                id="sd-business_name">
            @error('invoice.first_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-businessacitvity">Giro <span class='text-danger'>*</span></label>
            <select class="custom-select" wire:model="invoice.business_activity_id" id="bd-business_activity_id">
                <option value>Seleccione las actividades...</option>
                @foreach (\App\Models\BusinessActivity::orderBy('name', 'asc')->get(['id', 'name']) as $businessActivity)
                    <option value="{{ $businessActivity->id }}">{{ $businessActivity->name }}</option>
                @endforeach
            </select>
            @error('invoice.business_activity_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Email <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.email"
                id="sd-fisrtname">
            @error('invoice.email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sda-commune">Comuna <span class='text-danger'>*</span></label>
            <select class="custom-select" wire:model="invoice.address_commune_id" id="sda-commune" disabled>
                <option value>Seleccione una comuna</option>
                @foreach (\App\Models\Commune::orderBy('name', 'asc')->get(['id', 'name']) as $commune)
                    <option 
                        value="{{ $commune->id }}"
                    >{{ $commune->name }}</option>
                @endforeach
            </select>
            @error('invoice.address_commune_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Calle <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.address_street"
                id="sd-fisrtname">
            @error('invoice.address_street') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Oficina/Casa/Dpto <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.address_office"
                id="sd-fisrtname">
            @error('invoice.office') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Telefono <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="invoice.phone"
                id="sd-fisrtname">
            @error('invoice.phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>
    @endif
    
</div>
