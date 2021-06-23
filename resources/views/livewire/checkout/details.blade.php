<div class="details-form">
    <div class="loading" wire:loading  wire:target="save">Loading&#8230;</div>

    @if (!backpack_auth()->check())
    <div class="d-fle flex-column h-100 rounded-3 bg-secondary px-3 px-sm-4 py-4 mb-4" style="text-align: center">  
        <div class="row justify-center">
            <div class="col-md-12 mb-4">
                <a href="{{ route('customer.sign') }}" class="btn btn-primary btn-lg">Iniciar sesión</a>
            </div>
            <div class="col-md-12 mb-4">
                <hr>
            </div>
            <div class="col-md-12 mb-2">
                <h5>¿Aún no tienes cuenta?</h5>
            </div>
            <div class="col-md-12">
                <a href="{{ route('customer.sign') }}" class="btn btn-primary btn-lg mb-2 mb-sm-0" style="width: 230px">Regístrate</a>
                <a href="#guest" id="guest" class="btn btn-primary btn-lg" style="width: 230px">Continuar como invitado</a>
            </div>
        </div>
        
    </div>
    @endif

    <!-- Title-->
    <h2 class="h6 border-bottom pb-3 mb-3">Datos personales</h2>
    <!-- Shipping detail-->
    <div class="row pb-4">
        {{-- @if(!empty($customer_id))
        <div class="col-sm-12 form-group">
            <label for="addresses">Mis direcciones <span class='text-danger'>*</span></label>
            <select class="custom-select" wire:model="addresses_customer_id" id="addresses">
                <option value>Seleccione una dirección</option>
                @foreach (\App\Models\CustomerAddress::where('customer_id', $customer_id)->orderBy('id', 'asc')->get() as $addresses)
                    <option 
                        value="{{ $addresses->id }}"
                    >{{ $addresses->street }} {{ $addresses->number }} {{ $addresses->subnumber }}, {{ $addresses->commune->name }}</option>
                @endforeach
            </select>
            @error('data.addresses_customer_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        @endif --}}
        <div class="col-12 form-group text-left">
            <div class="custom-control custom-checkbox pb-3 mb-3">
                <input class="custom-control-input" type="checkbox" id="is-business" wire:model="is_business">
                <label class="custom-control-label" for="is-business">¿Eres una persona jurídica?</label>
            </div>
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-uid">RUT <span class='text-danger'>*</span></label>
            <input class="form-control rut-field" type="text" placeholder="" wire:model="data.uid" id="sd-uid">
            @error('data.uid') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        @if ($is_business)
            <div class="col-sm-6 form-group">
                <label for="sd-businessname">Razón social <span class='text-danger'>*</span></label>
                <input class="form-control" type="text" placeholder="" wire:model="data.business_name"
                    id="sd-businessname">
                @error('data.business_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-sm-6 form-group">
                <label for="sd-businessacitvity">Giro <span class='text-danger'>*</span></label>
                <select class="custom-select" wire:model="data.business_activity_id" id="bd-business_activity_id">
                    <option value>Seleccione las actividades...</option>
                    @foreach (\App\Models\BusinessActivity::orderBy('name', 'asc')->get(['id', 'name']) as $businessActivity)
                        <option value="{{ $businessActivity->id }}">{{ $businessActivity->name }}</option>
                    @endforeach
                </select>
                @error('data.business_activity_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        @else
            <div class="col-sm-6 form-group">
                <label for="sd-fisrtname">Nombre <span class='text-danger'>*</span></label>
                <input class="form-control" type="text" placeholder="Ingrese su nombre" wire:model="data.first_name"
                    id="sd-fisrtname">
                @error('data.first_name') <small class="text-danger">{{ $message }}</small> @enderror

            </div>

            <div class="col-sm-6 form-group">
                <label for="sd-lastname">Apellido <span class='text-danger'>*</span></label>
                <input class="form-control" type="text" placeholder="" id="sd-lastname"  wire:model="data.last_name">
                @error('data.last_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        @endif
        <div class="col-sm-6 form-group">
            <label for="sd-email">E-mail <span class='text-danger'>*</span></label>
            <input class="form-control" type="email" placeholder="" wire:model="data.email" id="sd-email">
            @error('data.email') <small class="text-danger">{{ $message }}</small> @enderror

        </div>
        
        <div class="col-sm-6 form-group">
            <label for="sd-commune">Comuna <span class='text-danger'>*</span></label>
            <select class="custom-select" wire:model="data.address_commune_id" id="sd-commune">
                <option value>Seleccione una comuna</option>
                @foreach (\App\Models\Commune::orderBy('name', 'asc')->get(['id', 'name']) as $commune)
                    <option 
                        value="{{ $commune->id }}"
                    >{{ $commune->name }}</option>
                @endforeach
            </select>
            @error('data.address_commune_id') <small class="text-danger">{{ $message }}</small> @enderror
            <small>Utilizaremos esta comuna en caso de requerir envió a domicilio</small>
        </div>

        <div class="col-sm-6 form-group">
            <label for="sd-street">Calle<span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="" wire:model="data.address_street" id="sd-street">
            @error('data.address_street') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-sm-6 form-group">
            <label for="sd-number">Número de calle<span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="" wire:model="data.address_number" id="sd-number">
            @error('data.address_number') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-sm-6 form-group">
            <label for="sd-phone">Teléfono <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="" wire:model="data.phone" id="sd-phone">
            @error('data.phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        {{-- <div class="col-sm-6 form-group">
            <label for="sd-subnumber">Oficina/Casa/Dpto</label>
            <input class="form-control" type="text" placeholder="" wire:model="data.address_office" id="sd-subnumber">
            @error('data.address_office') <small class="text-danger">{{ $message }}</small> @enderror
        </div> --}}
        
        
        {{-- <div class="col-sm-6 form-group">
            <label for="sd-cellphone">Teléfono móvil</label>
            <input class="form-control" type="text" placeholder="" wire:model="data.cellphone" id="sd-cellphone">
            @error('data.cellphone') <small class="text-danger">{{ $message }}</small> @enderror
        </div> --}}
        
        
        {{-- @todo --}}
        {{-- Ocultado hasta que se coloque el campo de RUT de persona que recibe/retira --}}
        {{-- <div class="col-sm-6 form-group">
            <label for="sd-receiver">Nombre de quien va a recibir</label>
            <input class="form-control" type="text" placeholder="" wire:model="data.receiver_name" id="sd-receiver">
            @error('data.receiver_name') <small class="text-danger">{{ $message }}</small> @enderror

        </div> --}}
        {{-- <div class="col-12 form-group">
            <label for="sd-message">Detalle</label>
            <textarea class="form-control" wire:model="data.shipping_details" id="sd-message" rows="6"
                placeholder="Ingrese algún detalle en caso de ser necesario" required="" spellcheck="false"
                data-gramm="false"></textarea>
            @error('data.shipping_details') <small class="text-danger">{{ $message }}</small> @enderror

        </div> --}}
    </div>

    <!-- Title-->
    {{-- <h2 class="h6 border-bottom pb-3 mb-3">Información de Facturación</h2>
    <div class="custom-control custom-checkbox pb-3 mb-3">
        <input class="custom-control-input" type="checkbox"  wire:model="anotherDataInvoice"
            id="same-address">
        <label class="custom-control-label" for="same-address">Indicar otros datos para facturación</label>
    </div>
    @if ($anotherDataInvoice)
        <!-- Billing detail-->
        <div id="billing-detail" class="row pb-4">
            <div class="col-12 form-group text-left">
                <div class="custom-control custom-checkbox pb-3 mb-3">
                    <input class="custom-control-input" type="checkbox" wire:model="invoice.is_business"
                        id="bd-isbusiness">
                    <label class="custom-control-label" for="bd-isbusiness">¿Es una persona jurídica?</label>
                </div>
            </div>
            <div class="col-sm-6 form-group">
                <label for="bd-uid">RUT <span class='text-danger'>*</span></label>
                <input class="form-control rut-field" type="text" placeholder="" wire:model="invoice.uid" id="bd-uid">
                @error('invoice.uid') <small class="text-danger">{{ $message }}</small> @enderror

            </div>
            @if ($invoice['is_business'])
                <div class="col-sm-6 form-group">
                    <label for="bd-businessname">Razón social <span class='text-danger'>*</span></label>
                    <input class="form-control" type="text" placeholder="" wire:model="invoice.business_name"
                        id="bd-businessname">
                    @error('invoice.business_name') <small class="text-danger">{{ $message }}</small> @enderror

                </div>
            @else
                <div class="col-sm-6 form-group">
                    <label for="bd-firstname">Nombre <span class='text-danger'>*</span></label>
                    <input class="form-control" type="text" placeholder="" wire:model="invoice.first_name"
                        id="bd-firstname">
                    @error('invoice.first_name') <small class="text-danger">{{ $message }}</small> @enderror

                </div>
            @endif
            @if (!$invoice['is_business'])
                <div class="col-sm-6 form-group">
                    <label for="bd-lastname">Apellido <span class='text-danger'>*</span></label>
                    <input class="form-control" type="text" placeholder="" wire:model="invoice.last_name"
                        id="bd-lastname">
                    @error('invoice.last_name') <small class="text-danger">{{ $message }}</small> @enderror

                </div>
            @endif
            <div class="col-sm-6 form-group">
                <label for="bd-email">E-mail<span class='text-danger'>*</span></label>
                <input class="form-control" type="email" placeholder="" wire:model="invoice.email" id="bd-email">
                @error('invoice.email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-6 form-group">
                <label for="bd-street">Calle<span class='text-danger'>*</span></label>
                <input class="form-control" type="text" placeholder="" wire:model="invoice.address_street"
                    id="bd-street">
                @error('invoice.address_street') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-6 form-group">
                <label for="bd-number">Número<span class='text-danger'>*</span></label>
                <input class="form-control" type="text" placeholder="" wire:model="invoice.address_number"
                    id="bd-number">
                @error('invoice.address_number') <small class="text-danger">{{ $message }}</small> @enderror

            </div>
            <div class="col-sm-6 form-group">
                <label for="bd-subnumber">Oficina/Casa/Dpto</label>
                <input class="form-control" type="text" placeholder="" wire:model="invoice.address_office"
                    id="bd-subnumber">
                @error('invoice.address_office') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-6 form-group">
                <label for="bd-commune">Comuna <span class='text-danger'>*</span></label>
                <select class="custom-select" wire:model="invoice.address_commune_id" id="bd-commune">
                    <option value>Seleccione una comuna</option>
                    @foreach (\App\Models\Commune::orderBy('name', 'asc')->get(['id', 'name']) as $commune)
                        <option value="{{ $commune->id }}">{{ $commune->name }}</option>
                    @endforeach
                </select>
                @error('invoice.address_commune_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div><div class="col-sm-6 form-group">
                <label for="bd-phone">Teléfono <span class='text-danger'>*</span></label>
                <input class="form-control" type="text" placeholder="" wire:model="invoice.phone" id="bd-phone">
                @error('invoice.phone') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-6 form-group">
                <label for="bd-cellphone">Teléfono móvil</label>
                <input class="form-control" type="text" placeholder="" wire:model="invoice.cellphone" id="bd-cellphone">
                @error('invoice.cellphone') <small class="text-danger">{{ $message }}</small> @enderror

            </div>
            @if ($invoice['is_business'])
                <div class="col-sm-6 form-group">
                    <label for="bd-commune">Giros <span class='text-danger'>*</span></label>
                    <select class="custom-select" wire:model="invoice.business_activity_id" id="bd-business_activity">
                        <option value>Seleccione las actividades...</option>
                        @foreach (\App\Models\BusinessActivity::orderBy('name', 'asc')->get(['id', 'name']) as $businessActivity)
                            <option value="{{ $businessActivity->id }}">{{ $businessActivity->name }}</option>
                        @endforeach
                    </select>
                    @error('invoice.address_commune_id') <small class="text-danger">{{ $message }}</small> @enderror
                    @error('invoice.business_activity_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            @endif
        </div>
    @endif --}}
    {{-- <div class="d-none d-lg-flex pt-4 mt-3">
        <div class="w-50 pr-3"><a class="btn btn-secondary btn-block" wire:click="prevStep()"><i
                    class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Volver al carro</span><span
                    class="d-inline d-sm-none">Back</span></a></div>
        <div class="w-50 pl-2"><a class="btn btn-primary btn-block" wire:click="nextStep()"><span
                    class="d-none d-sm-inline">Seleccionar metodos de envío</span><span
                    class="d-inline d-sm-none">Next</span><i class="czi-arrow-right mt-sm-0 ml-1"></i></a></div>
    </div> --}}

</div>
@push('scripts')
    <script src="{{ asset('js/rut-formatter.js') }}"></script>
    <script>
        const observer = new MutationObserver(mutation => {
            $('.rut-field').rut()
        });

        observer.observe(document.body, {
            childList: true,
            attributes: true,
            subtree: true,
            characterData: true
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
    </script>
@endpush
