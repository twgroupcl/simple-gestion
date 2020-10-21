@extends('layouts.base')

@section('content')
    <!-- Page Title-->
    <div class="page-title-overlap bg-cp-gradient pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
                <h1 class="h3 text-light mb-0">Checkout</h1>
            </div>

        </div>
    </div>
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4">

            <div class="row">
                <!-- Content-->
                <section class="col-lg-8 pt-2 pt-lg-2 pb-4 mb-3">
                    <div class="steps steps-light pt-2 pb-3 mb-5"><a class="step-item active" href="shop-cart.html">
                            <div class="step-progress"><span class="step-count">1</span></div>
                            <div class="step-label"><i class="czi-cart"></i>Carro</div>
                        </a><a class="step-item active current" href="checkout-details.html">
                            <div class="step-progress"><span class="step-count">2</span></div>
                            <div class="step-label"><i class="czi-user-circle"></i>Detalle</div>
                        </a><a class="step-item" href="checkout-shipping.html">
                            <div class="step-progress"><span class="step-count">3</span></div>
                            <div class="step-label"><i class="czi-package"></i>Envio</div>
                        </a><a class="step-item" href="checkout-payment.html">
                            <div class="step-progress"><span class="step-count">4</span></div>
                            <div class="step-label"><i class="czi-card"></i>Pago</div>
                        </a><a class="step-item" href="checkout-review.html">
                            <div class="step-progress"><span class="step-count">5</span></div>
                            <div class="step-label"><i class="czi-check-circle"></i>Revisión</div>
                        </a></div>
                    <div class="pt-2 px-4 pr-lg-0 pl-xl-5">
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
                        <!-- Order preview on mobile (screens small than 991px)-->
                        <div class="widget mb-3 d-lg-none">
                            <h2 class="widget-title">Order summary</h2>
                            <div class="media align-items-center pb-2 border-bottom"><a class="d-block mr-2"
                                    href="marketplace-single.html"><img class="rounded-sm" width="64"
                                        src="img/marketplace/products/widget/01.jpg" alt="Product" /></a>
                                <div class="media-body pl-1">
                                    <h6 class="widget-product-title"><a href="marketplace-single.html">UI Isometric Devices
                                            Pack</a></h6>
                                    <div class="widget-product-meta"><span
                                            class="text-accent border-right pr-2 mr-2">$23.<small>99</small></span><span
                                            class="font-size-xs text-muted">Standard license</span></div>
                                </div>
                            </div>
                            <div class="media align-items-center py-2 border-bottom"><a class="d-block mr-2"
                                    href="marketplace-single.html"><img class="rounded-sm" width="64"
                                        src="img/marketplace/products/widget/02.jpg" alt="Product" /></a>
                                <div class="media-body pl-1">
                                    <h6 class="widget-product-title"><a href="marketplace-single.html">Project Devices
                                            Showcase</a></h6>
                                    <div class="widget-product-meta"><span
                                            class="text-accent border-right pr-2 mr-2">$18.<small>99</small></span><span
                                            class="font-size-xs text-muted">Standard license</span></div>
                                </div>
                            </div>
                            <div class="media align-items-center py-2 border-bottom"><a class="d-block mr-2"
                                    href="marketplace-single.html"><img class="rounded-sm" width="64"
                                        src="img/marketplace/products/widget/03.jpg" alt="Product" /></a>
                                <div class="media-body pl-1">
                                    <h6 class="widget-product-title"><a href="marketplace-single.html">Gravity Devices UI
                                            Mockup</a></h6>
                                    <div class="widget-product-meta"><span
                                            class="text-accent border-right pr-2 mr-2">$15.<small>99</small></span><span
                                            class="font-size-xs text-muted">Standard license</span></div>
                                </div>
                            </div>
                            <ul class="list-unstyled font-size-sm py-3">
                                <li class="d-flex justify-content-between align-items-center"><span
                                        class="mr-2">Subtotal:</span><span class="text-right">$58.<small>97</small></span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center"><span
                                        class="mr-2">Taxes:</span><span class="text-right">$10.<small>45</small></span></li>
                                <li class="d-flex justify-content-between align-items-center font-size-base"><span
                                        class="mr-2">Total:</span><span class="text-right">$69.<small>42</small></span></li>
                            </ul>

                        </div>
                        <!-- Payment methods accordion-->
                        <div class="accordion mb-2" id="payment-method" role="tablist">
                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h3 class="accordion-heading"><a href="#card" data-toggle="collapse"><i
                                                class="czi-store font-size-lg mr-2 mt-n1 align-middle"></i>Tienda Uno<span
                                                class="accordion-indicator"></span></a></h3>
                                </div>
                                <div class="collapse show" id="card" data-parent="#payment-method" role="tabpanel">
                                    <div class="card-body">
                                        <!-- Product-->
                                        <div class="media d-block d-sm-flex align-items-center py-4 border-bottom"><a
                                                class="d-block position-relative mb-3 mb-sm-0 mr-sm-4 mx-auto"
                                                href="marketplace-single.html" style="width: 12.5rem;"><img
                                                    class="rounded-lg" src="img/marketplace/products/th02.jpg"
                                                    alt="Product"><span class="close-floating" data-toggle="tooltip"
                                                    title="Remove from Cart"><i class="czi-close"></i></span></a>
                                            <div class="media-body text-center text-sm-left">
                                                <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">UI
                                                        Isometric Devices Pack (PSD)</a></h3>
                                                <div class="d-inline-block text-accent">$23.<small>00</small></div><a
                                                    class="d-inline-block text-accent font-size-ms border-left ml-2 pl-2"
                                                    href="#">by Tienda Uno</a>
                                                <div class="form-inline pt-2">
                                                    <select class="custom-select custom-select-sm my-1 mr-2">
                                                        <option>ChileExpress ($3.500)</option>
                                                        <option>Envio Gratis</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product-->
                                        <div class="media d-block d-sm-flex align-items-center py-4 border-bottom"><a
                                                class="d-block position-relative mb-3 mb-sm-0 mr-sm-4 mx-auto"
                                                href="marketplace-single.html" style="width: 12.5rem;"><img
                                                    class="rounded-lg" src="img/marketplace/products/th06.jpg"
                                                    alt="Product"><span class="close-floating" data-toggle="tooltip"
                                                    title="Remove from Cart"><i class="czi-close"></i></span></a>
                                            <div class="media-body text-center text-sm-left">
                                                <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">Project
                                                        Devices Showcase (PSD)</a></h3>
                                                <div class="d-inline-block text-accent">$18.<small>00</small></div><a
                                                    class="d-inline-block text-accent font-size-ms border-left ml-2 pl-2"
                                                    href="#">by Tienda Uno</a>
                                                <div class="form-inline pt-2">
                                                    <select class="custom-select custom-select-sm my-1 mr-2">
                                                        <option>ChileExpress ($3.500)</option>
                                                        <option>Envio Gratis</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product-->
                                        <div class="media d-block d-sm-flex align-items-center pt-4 pb-2"><a
                                                class="d-block position-relative mb-3 mb-sm-0 mr-sm-4 mx-auto"
                                                href="marketplace-single.html" style="width: 12.5rem;"><img
                                                    class="rounded-lg" src="img/marketplace/products/th07.jpg"
                                                    alt="Product"><span class="close-floating" data-toggle="tooltip"
                                                    title="Remove from Cart"><i class="czi-close"></i></span></a>
                                            <div class="media-body text-center text-sm-left">
                                                <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">Gravity
                                                        Devices UI Mockup (PSD)</a></h3>
                                                <div class="d-inline-block text-accent">$15.<small>00</small></div><a
                                                    class="d-inline-block text-accent font-size-ms border-left ml-2 pl-2"
                                                    href="#">by Tienda Uno</a>
                                                <div class="form-inline pt-2">
                                                    <select class="custom-select custom-select-sm my-1 mr-2">
                                                        <option>ChileExpress ($3.500)</option>
                                                        <option>Envio Gratis</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h3 class="accordion-heading"><a href="#card" data-toggle="collapse"><i
                                                class="czi-store font-size-lg mr-2 mt-n1 align-middle"></i>Tienda Dos<span
                                                class="accordion-indicator"></span></a></h3>
                                </div>
                                <div class="collapse show" id="card" data-parent="#payment-method" role="tabpanel">
                                    <div class="card-body">
                                        <!-- Product-->
                                        <div class="media d-block d-sm-flex align-items-center py-4 border-bottom"><a
                                                class="d-block position-relative mb-3 mb-sm-0 mr-sm-4 mx-auto"
                                                href="marketplace-single.html" style="width: 12.5rem;"><img
                                                    class="rounded-lg" src="img/marketplace/products/th02.jpg"
                                                    alt="Product"><span class="close-floating" data-toggle="tooltip"
                                                    title="Remove from Cart"><i class="czi-close"></i></span></a>
                                            <div class="media-body text-center text-sm-left">
                                                <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">UI
                                                        Isometric Devices Pack (PSD)</a></h3>
                                                <div class="d-inline-block text-accent">$23.<small>00</small></div><a
                                                    class="d-inline-block text-accent font-size-ms border-left ml-2 pl-2"
                                                    href="#">by Tienda Dos</a>
                                                <div class="form-inline pt-2">
                                                    <select class="custom-select custom-select-sm my-1 mr-2">
                                                        <option>ChileExpress ($3.500)</option>
                                                        <option>Envio Gratis</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card">
                                <div class="card-header" role="tab">
                                    <h3 class="accordion-heading"><a class="collapsed" href="#paypal"
                                            data-toggle="collapse"><i class="czi-paypal mr-2 align-middle"></i>Pay with
                                            PayPal<span class="accordion-indicator"></span></a></h3>
                                </div>
                                <div class="collapse" id="paypal" data-parent="#payment-method" role="tabpanel">
                                    <div class="card-body font-size-sm">
                                        <p><span class='font-weight-medium'>PayPal</span> - the safer, easier way to pay</p>
                                        <button class="btn btn-primary" type="button">Checkout with PayPal</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h3 class="accordion-heading"><a class="collapsed" href="#points"
                                            data-toggle="collapse"><i class="czi-money-bag mr-2"></i>Pay with my account
                                            balance<span class="accordion-indicator"></span></a></h3>
                                </div>
                                <div class="collapse" id="points" data-parent="#payment-method" role="tabpanel">
                                    <div class="card-body">
                                        <p>You currently have<span
                                                class="font-weight-medium">&nbsp;$1,375.<small>00</small></span>&nbsp;on
                                            your account balance.</p>
                                        <button class="btn btn-primary mt-0" type="submit">Pay with account balance</button>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </section>
                <!-- Sidebar-->
                <!-- Order preview on desktop (screens larger than 991px)-->
                <aside class="col-lg-4 d-none d-lg-block">
                    <hr class="d-lg-none">
                    <div class="cz-sidebar-static h-100 ml-auto border-left">
                        <div class="widget mb-3">
                            <h2 class="widget-title text-center">Order summary</h2>
                            <ul class="list-unstyled font-size-sm pt-3 pb-2 border-bottom">
                                <li class="d-flex justify-content-between align-items-center"><span
                                        class="mr-2">Subtotal:</span><span class="text-right">$56.<small>00</small></span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center"><span
                                        class="mr-2">Shipping:</span><span class="text-right">$9.<small>30</small></span>
                                </li>
                            </ul>
                            <h3 class="font-weight-normal text-center my-4">$65.<small>30</small></h3>
                            <div class="col-12 text-center">
                                <img class="d-inline-block img-fluid mx" width="120"
                                    src="{{ asset('img/logo-webpay.png') }}" alt="Métodos de pago" />
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#billing-detail').hide();

            $('#same-address').change(function() {
                if ($(this).prop('checked')) {
                    $('#billing-detail').hide();
                } else {
                    $('#billing-detail').show();
                }
            });
        })

    </script>
@endpush
