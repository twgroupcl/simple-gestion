<div wire:init="updateSellersShippings()">
    <div class="loading" wire:loading>Loading&#8230;</div>
    <!-- Sellers  accordion-->
    <div class="accordion mb-2" id="seller" role="tablist">

        @if ($sellers)
            @foreach ($sellers as $seller)
                @php
                $shippings = null;
                if(!empty($sellersShippings)){

                $indexSeller = array_search($seller->id, array_column($sellersShippings,'sellerId'), true);
                $shippings = $sellersShippings[$indexSeller];
                }


                @endphp
                <div class="card">
                    <div class="card-header" role="tab">
                        <h3 class="accordion-heading"><a href="#card" data-toggle="collapse"><i
                                    class="czi-store font-size-lg mr-2 mt-n1 align-middle"></i>{{ $seller->visible_name }}<span
                                    class="accordion-indicator"></span></a></h3>
                    </div>
                    <div class="collapse show" id="card" data-parent="#seller" role="tabpanel">
                        <div class="card-body">
                            @php

                            // $shippingMethods = $seller->shippingmethods;



                            @endphp
                            @foreach ($items as $item)
                                @if ($seller->id == $item->product->seller_id)
                                    {{-- @livewire('cart.item', ['item' => $item,
                                    'sellerShippingMethods'=>$shippingMethods,
                                    'showShipping'=>true , 'showAttributes' => true], key($item->id))
                                    --}}
                                    @livewire('cart.item', ['item' => $item,
                                    'showShipping'=>true , 'showAttributes' => true], key($item->id))
                                @endif
                            @endforeach
                            <!-- Product-->
                            {{-- <div
                                class="media d-block d-sm-flex align-items-center pt-4 pb-2"><a
                                    class="d-block position-relative mb-3 mb-sm-0 mr-sm-4 mx-auto"
                                    href="marketplace-single.html" style="width: 12.5rem;"><img class="rounded-lg"
                                        src="img/marketplace/products/th07.jpg" alt="Product"><span
                                        class="close-floating" data-toggle="tooltip" title="Remove from Cart"><i
                                            class="czi-close"></i></span></a>
                                <div class="media-body text-center text-sm-left">
                                    <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">Gravity
                                            Devices UI Mockup (PSD)</a></h3>
                                    <div class="d-inline-block text-accent">$15.<small>00</small></div><a
                                        class="d-inline-block text-accent font-size-ms border-left ml-2 pl-2"
                                        href="#">by Tienda
                                        Uno</a>
                                    <div class="form-inline pt-2">
                                        <select class="custom-select custom-select-sm my-1 mr-2">
                                            <option>ChileExpress ($3.500)</option>
                                            <option>Envio Gratis</option>
                                        </select>
                                    </div>
                                </div>
                            </div> --}}
                            
                            @if (isset($sellersShippingMethods[$seller->id]))
                            <div class="row">
                                <div class="col-12">
                                    Metodos de envio disponible para esta orden
                                </div>
                                <div class="col-12">
                                    <div class="select-shipping mb-0 pt-2">
                                        <select class="custom-select custom-select-sm my-1 mr-2"
                                            wire:model="selectedShippingMethodId"
                                            wire:change="setShippingMethod"
                                            >
                                            @foreach ($sellersShippingMethods[$seller->id] as $shippingMethod)
                                                <option value="{{ $shippingMethod['id'] }}">
                                                    {{ $shippingMethod['title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if (!count($sellersShippingMethods[$seller->id]))
                                            <span style="font-size: 13px;">Envio no disponible para la comuna seleccionada.</span>
                                        @endif
                                    </div>
                                </div>
                            </div> 
                            @endif
                            <hr style="margin: 15px 5px 10px 5px">

                            @if ($shippings)

                                @foreach ($shippings as $item)
                                    @if (!empty($item['shipping']))
                                        <div class="row">
                                            <div class="col-6">{{ $item['shipping']['title'] }}</div>
                                            @if ($item['shipping']['isAvailable'])
                                                <div class="col-6">
                                                    @if (!is_null($item['shipping']['totalPrice']))
                                                        {{ currencyFormat($item['shipping']['totalPrice'] ? $item['shipping']['totalPrice'] : 0, 'CLP', true) }}
                                                    @endif
                                                </div>
                                            @else
                                                <div class="col-6"> {{ $item['shipping']['message'] }} </div>
                                            @endif
                                        </div>
                                    @else
                                        @if (!empty($item['notConfigured']))
                                            <div class="row">
                                                <div class="col-10">Esta tienda no tiene configurado metodos de envío
                                                para la comuna seleccionada. Selecciona otra comuna de destino para continuar
                                                o elimina los articulos de esta tienda. </div>
                                            </div>
                                        @endif
                                    @endif

                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        {{-- <div class="card">
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
                            href="marketplace-single.html" style="width: 12.5rem;"><img class="rounded-lg"
                                src="img/marketplace/products/th02.jpg" alt="Product"><span class="close-floating"
                                data-toggle="tooltip" title="Remove from Cart"><i class="czi-close"></i></span></a>
                        <div class="media-body text-center text-sm-left">
                            <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">UI
                                    Isometric Devices Pack (PSD)</a></h3>
                            <div class="d-inline-block text-accent">$23.<small>00</small></div><a
                                class="d-inline-block text-accent font-size-ms border-left ml-2 pl-2" href="#">by Tienda
                                Dos</a>
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
        </div> --}}
        {{-- <div class="card">
            <div class="card-header" role="tab">
                <h3 class="accordion-heading"><a class="collapsed" href="#paypal" data-toggle="collapse"><i
                            class="czi-paypal mr-2 align-middle"></i>Pay with
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
                <h3 class="accordion-heading"><a class="collapsed" href="#points" data-toggle="collapse"><i
                            class="czi-money-bag mr-2"></i>Pay with my account
                        balance<span class="accordion-indicator"></span></a></h3>
            </div>
            <div class="collapse" id="points" data-parent="#payment-method" role="tabpanel">
                <div class="card-body">
                    <p>You currently have<span class="font-weight-medium">&nbsp;$1,375.<small>00</small></span>&nbsp;on
                        your account balance.</p>
                    <button class="btn btn-primary mt-0" type="submit">Pay with account balance</button>
                </div>
            </div>
        </div> --}}
    </div>
    {{-- <div class="d-none d-lg-flex pt-4">
        <div class="w-50 pr-3"><a class="btn btn-secondary btn-block" wire:click="prevStep()"><i
                    class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Back to
                    Adresses</span><span class="d-inline d-sm-none">Back</span></a></div>
        <div class="w-50 pl-2"><a class="btn btn-primary btn-block" wire:click="nextStep()"><span
                    class="d-none d-sm-inline">Proceed to Payment</span><span class="d-inline d-sm-none">Next</span><i
                    class="czi-arrow-right mt-sm-0 ml-1"></i></a></div>
    </div> --}}
</div>
