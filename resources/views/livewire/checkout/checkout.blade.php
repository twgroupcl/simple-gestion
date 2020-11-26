<div>
    {{-- <div   class="loading" wire:loading >Loading&#8230;</div> --}}


    <div class="container pb-5 mb-2 mb-md-4">

        <div class="row">
            <!-- Content-->
            <section class="col-lg-8 pt-2 pt-lg-2 pb-4 mb-3">
                <div class="steps steps-light pt-2 pb-3 mb-5">
                    @foreach ($steps as $key => $step)
                        <a class="step-item {{ $step['status'] }}">
                            <div class="step-progress"><span class="step-count">{{ $step['number'] }}</span></div>
                            <div class="step-label"><i class="{{ $step['icon'] }}"></i>{{ $step['name'] }}</div>
                        </a>
                    @endforeach
                </div>




                <div class="pt-2 px-4 pr-lg-0 pl-xl-5">
                    @switch($activeStep['number'])
                        @case(1)
                        @break
                        @case(2)
                        @livewire('checkout.details',['cart'=>$cart] ,key($activeStep['number']))
                        @break
                        @case(3)
                        @livewire('checkout.shipping', ['cart'=>$cart ])
                        @break
                        @case(4)
                        @livewire('checkout.payments', ['cart'=>$cart])
                        @break
                        @default
                    @endswitch
                    <!-- Order preview on mobile (screens small than 991px)-->
                    {{-- <div class="widget mb-3 d-lg-none">
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

                    </div> --}}

                </div>
                <!-- Navigation (desktop)-->
                <div class="d-none d-lg-flex pt-4 mt-3">
                    <div class="w-50 pr-3"><button class="btn btn-secondary btn-block" wire:click="prevStep()"><i
                                class="czi-arrow-left mt-sm-0 mr-1"></i><span
                                class="d-none d-sm-inline">{{ $activeStep['prev-button'] }}</span><span
                                class="d-inline d-sm-none">Anterior</span></button></div>
                    @if (!empty($activeStep['next-button']))
                        <div class="w-50 pl-2">
                            {{-- @if ($loading || !$canContinue) disabled  @endif --}}
                            <button class="btn btn-primary btn-block bg-light-blue" id="nexStepCheckout"
                            @if ($blockButton) disabled @endif
                             wire:click="nextStep()" >
                    <span class="d-none d-sm-inline">
                        {{-- @if ($loading) --}}
                            {{-- <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true" ></span> --}}
                        {{-- @endif --}}
                        {{ $activeStep['next-button'] }}
                    </span>
                    <span class="d-inline d-sm-none">Siguiente</span><i class="czi-arrow-right mt-sm-0 ml-1"></i>
                    </button>
                </div>
                @endif
        </div>
        </section>
        <!-- Sidebar-->
        <!-- Order preview on desktop (screens larger than 991px)-->
        <aside class="col-lg-4 d-none d-lg-block">
            <hr class="d-lg-none">
            <div class="cz-sidebar-static h-100 ml-auto border-left">
                <div class="widget mb-3">
                    <h2 class="widget-title text-center">Resumen del pedido</h2>
                    <ul class="list-unstyled font-size-sm pt-3 pb-2 border-bottom">
                            <li class="d-flex justify-content-between align-items-center"><span
                                    class="mr-2">Subtotal:</span><span class="text-right">
                                    {{ currencyFormat($subtotal ? $subtotal : 0, 'CLP', true) }}</span>
                            </li>

                        {{-- @if ($chilexpresstotal['qty'] > 0)
                            <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Chilexpress
                                    x {{ $chilexpresstotal['qty'] }}</span><span
                                    class="text-right">{{ currencyFormat($chilexpresstotal['total'] ? $chilexpresstotal['total'] : 0, 'CLP', true) }}</span>
                            </li>
                        @endif
                        @if ($shippingtotal['qty'] > 0)
                            <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Envío x
                                    {{ $shippingtotal['qty'] }}</span><span
                                    class="text-right">{{ currencyFormat($shippingtotal['total'] ? $shippingtotal['total'] : 0, 'CLP', true) }}</span>
                            </li>
                        @endif --}}
                        @if ($shippingtotals && $activeStep['number'] > 2)

                            @foreach ($shippingtotals as $shipping)
                                {{-- @if ($shipping['qty']) --}}
                                    <li class="d-flex justify-content-between align-items-center">
                                        <span class="mr-2">{{ $shipping['title'] }} x
                                            {{ $shipping['totalShippingPackage'] }}</span>
                                        <span class="text-right">
                                            @if (!is_null($shipping['totalPrice']))
                                                {{ currencyFormat($shipping['totalPrice'] ? $shipping['totalPrice'] : 0, 'CLP', true) }}
                                            @endif
                                        </span>
                                    </li>
                                    {{--
                                @endif --}}
                            @endforeach
                        @endif
                    </ul>

                        <h3 class="font-weight-normal text-center my-4">
                            {{ currencyFormat($total ? $total : 0, 'CLP', true) }}
                        </h3>
                    @if (!$canContinue)
                        <div class="alert alert-primary">
                            Verifique los productos seleccionados para continuar con su compra.
                        </div>
                    @endif
                    <div class="col-12 text-center">
                        <img class="d-inline-block img-fluid mx" width="120" src="{{ asset('img/logo-webpay.png') }}"
                            alt="Métodos de pago" />
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <!-- Navigation (mobile)-->
    <div class="row d-lg-none">
        <div class="col-lg-8">
            <div class="d-flex pt-4 mt-3">
                <div class="w-50 pr-3"><button class="btn btn-secondary btn-block" wire:click="prevStep()"><i
                            class="czi-arrow-left mt-sm-0 mr-1"></i><span
                            class="d-none d-sm-inline">{{ $activeStep['prev-button'] }}</span><span
                            class="d-inline d-sm-none">Anterior</span></button></div>
                @if (!empty($activeStep['next-button']))
                {{-- @if ($loading || !$canContinue) disabled  @endif  --}}
                    <div class="w-50 pl-2"><button class="btn btn-primary btn-block"
                        @if ($blockButton) disabled @endif
                         wire:click.prevent="nextStep()" >
                {{-- @if ($loading) --}}
                    {{-- <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> --}}
                {{-- @endif --}}
                <span class="d-none d-sm-inline">{{ $activeStep['next-button'] }}</span><span
                    class="d-inline d-sm-none">Siguiente</span><i class="czi-arrow-right mt-sm-0 ml-1"></i></button>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
</div>
{{-- @push('scripts')

    <script>
        Livewire.on('select-shipping', (title, message, delay, type) => {
            alert('ok');

        })

    </script>
@endpush --}}
