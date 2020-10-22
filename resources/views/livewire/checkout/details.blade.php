<div>
    <!-- Title-->
    <h2 class="h6 border-bottom pb-3 mb-3">Información de envío</h2>
    <!-- Shipping detail-->
    <div class="row pb-4">
        <div class="col-12 form-group text-center">
            <div class="custom-control custom-checkbox pb-3 mb-3">
                <input class="custom-control-input" type="checkbox" id="same-address">
                <label class="custom-control-label" for="same-address">¿Eres un cliente de tipo
                    empresa?</label>
            </div>
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-uid">RUT <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="2.895.271-6" id="sd-uid">
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-fisrtname">Nombre <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Jonathan" id="sd-fisrtname">
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-lastname">Apellido <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Doe" id="sd-lastname">
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-email">Email address <span class='text-danger'>*</span></label>
            <input class="form-control" type="email" placeholder="contact@createx.studio" id="sd-email">
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-street">Calle<span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Av. Siempreviva" id="sd-street">
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-number">Número<span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="742" id="sd-number">
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-subnumber">Oficina/Casa/Dpto</label>
            <input class="form-control" type="text" placeholder="" id="sd-subnumber">
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-commune">Comuna <span class='text-danger'>*</span></label>
            <select class="custom-select" id="sd-commune">
                <option value>Seleccione una comuna</option>
            </select>
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-cellphone">Celular<span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="" id="sd-cellphone">
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-phone">Teléfono fijo</label>
            <input class="form-control" type="text" placeholder="" id="sd-phone">
        </div>
        <div class="col-sm-6 form-group">
            <label for="sd-receiver">Nombre de quien va a recibir</label>
            <input class="form-control" type="text" placeholder="" id="sd-receiver">
        </div>
        <div class="col-12 form-group">
            <label for="sd-message">Detalle</label>
            <textarea class="form-control" id="sd-message" rows="6"
                placeholder="Ingrese algun detalle en caso de ser necesario" required=""
                spellcheck="false" data-gramm="false"></textarea>
        </div>
    </div>

    <!-- Title-->
    <h2 class="h6 border-bottom pb-3 mb-3">Información de Facturación</h2>
    <div class="custom-control custom-checkbox pb-3 mb-3">
        <input class="custom-control-input" type="checkbox" checked="" id="same-address">
        <label class="custom-control-label" for="same-address">Igual que la dirección de envío</label>
    </div>
    <!-- Billing detail-->
    <div id="billing-detail" class="row pb-4">
        <div class="col-12 form-group text-center">
            <div class="custom-control custom-checkbox pb-3 mb-3">
                <input class="custom-control-input" type="checkbox" id="same-address">
                <label class="custom-control-label" for="same-address">¿A quien se factura es una
                    empresa?</label>
            </div>
        </div>
        <div class="col-sm-6 form-group">
            <label for="bd-uid">RUT <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="6.331.817-5" id="bd-uid">
        </div>
        <div class="col-sm-6 form-group">
            <label for="bd-firstname">Nombre <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Jonathan" id="bd-firstname">
        </div>
        <div class="col-sm-6 form-group">
            <label for="bd-lastname">Apellido <span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Doe" id="bd-lastname">
        </div>
        <div class="col-sm-6 form-group">
            <label for="bd-email">Email address <span class='text-danger'>*</span></label>
            <input class="form-control" type="email" placeholder="contact@createx.studio" id="bd-email">
        </div>
        <div class="col-sm-6 form-group">
            <label for="bd-street">Calle<span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="Av. Siempreviva" id="bd-street">
        </div>
        <div class="col-sm-6 form-group">
            <label for="bd-number">Número<span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="742" id="bd-number">
        </div>
        <div class="col-sm-6 form-group">
            <label for="bd-subnumber">Oficina/Casa/Dpto</label>
            <input class="form-control" type="text" placeholder="" id="bd-subnumber">
        </div>
        <div class="col-sm-6 form-group">
            <label for="bd-commune">Comuna <span class='text-danger'>*</span></label>
            <select class="custom-select" id="bd-commune">
                <option value>Seleccione una comuna</option>
            </select>
        </div>
        <div class="col-sm-6 form-group">
            <label for="bd-cellphone">Celular<span class='text-danger'>*</span></label>
            <input class="form-control" type="text" placeholder="" id="bd-cellphone">
        </div>
        <div class="col-sm-6 form-group">
            <label for="bd-phone">Teléfono fijo</label>
            <input class="form-control" type="text" placeholder="" id="bd-phone">
        </div>

    </div>
    {{-- <div class="d-none d-lg-flex pt-4 mt-3">
        <div class="w-50 pr-3"><a class="btn btn-secondary btn-block"  wire:click="prevStep()"><i class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Volver al carro</span><span class="d-inline d-sm-none">Back</span></a></div>
        <div class="w-50 pl-2"><a class="btn btn-primary btn-block"  wire:click="nextStep()"><span class="d-none d-sm-inline">Seleccionar metodos de envío</span><span class="d-inline d-sm-none">Next</span><i class="czi-arrow-right mt-sm-0 ml-1"></i></a></div>
    </div> --}}

</div>
