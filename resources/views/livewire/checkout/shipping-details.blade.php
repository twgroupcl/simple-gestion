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
            <label for="sd-uid">RUT <span class='text-danger'>*</span></label>
            <input class="form-control" name="picking_rut" type="text" placeholder="Ingrese su RUT" wire:model="picking.uid"
                id="sd-uid">
            @error('picking.uid') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        {{-- <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Email <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su email" wire:model="picking.email"
                id="sd-email">
            @error('picking.email') <small class="text-danger">{{ $message }}</small> @enderror
        </div> --}}
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Teléfono <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su teléfono" wire:model="picking.phone"
                id="sd-phone">
            @error('picking.phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>
    @else
    <h2 class="h6 pb-3 mb-2">Dirección de envío</h2>

    @if(backpack_auth()->check() && backpack_user()->customer)
        <div class="col-sm-12 form-group px-0">
            <label for="addresses">Mis direcciones <span class='text-danger'>*</span></label>
            <select class="custom-select" wire:model="selectedAddressId" id="addresses">
                <option value>Seleccione una dirección</option>
                @foreach (\App\Models\CustomerAddress::where('customer_id', backpack_user()->customer->id)->where('commune_id', $data['address_commune_id'])->orderBy('id', 'asc')->get() as $addresses)
                    <option 
                        value="{{ $addresses->id }}"
                    >
                        @if ($addresses->extra)
                            {{ $addresses->street }} {{ $addresses->number }}, {{ $addresses->extra }}, {{ $addresses->commune->name }}
                        @else   
                            {{ $addresses->street }} {{ $addresses->number }}, {{ $addresses->commune->name }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
    @endif

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
            <input class="form-control" type="text" placeholder="Ingrese su calle" wire:model="data.address_street"
                id="sd-address_street"
            >
            @error('data.address_street') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-sm-6 form-group">
            <label for="sd-number">Número de calle<span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su número de calle" wire:model="data.address_number" id="sd-number">
            @error('data.address_number') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Referencia</label>
            <input class="form-control" type="text" placeholder="Ingrese referencia de la dirección" wire:model="data.shipping_details"
                id="sd-address_office">
            @error('data.shipping_details') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Teléfono <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su teléfono" wire:model="data.phone"
                id="sd-phone">
            @error('data.phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div> --}}
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
            <input class="form-control" name="invoice_rut" type="text" placeholder="Ingrese su RUT" wire:model="invoice.uid"
                id="sd-uid-i">
            @error('invoice.uid') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Razón social <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su razón social" wire:model="invoice.business_name"
                id="sd-business_name">
            @error('invoice.business_name') <small class="text-danger">{{ $message }}</small> @enderror
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
            <input class="form-control" type="text" placeholder="Ingrese su email" wire:model="invoice.email"
                id="sd-email-i">
            @error('invoice.email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sda-commune">Comuna <span class='text-danger'>*</span></label>
            <select class="custom-select" wire:model="invoice.address_commune_id" id="sda-commune-i">
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
            <input class="form-control" type="text" placeholder="Ingrese su calle" wire:model="invoice.address_street"
                id="sd-stree-i">
            @error('invoice.address_street') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Oficina/Casa/Dpto <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su oficina/casa/dpto" wire:model="invoice.address_office"
                id="sd-office-id">
            @error('invoice.address_office') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Teléfono <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Ingrese su teléfono" wire:model="invoice.phone"
                id="sd-phone-i">
            @error('invoice.phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>
    @endif
    
</div>

<script src="{{ asset('js/rut-formatter.js') }}"></script>
<script>
    const observer2 = new MutationObserver(mutation => {
        $('input[name="picking_rut"]').rut()
        $('input[name="invoice_rut"]').rut()
    });

    observer2.observe(document.body, {
        childList: true,
        attributes: true,
        subtree: true,
        characterData: true
    });

</script>