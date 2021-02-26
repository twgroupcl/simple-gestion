@push('after_styles')
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance:textfield; /* Firefox */
        }


        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
            background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        }
        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }
        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        }
        /* Animation */
        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }


        .disabled-link{
            cursor: default;
            pointer-events: none;
            text-decoration: none;
            color: grey;
        }
        .custom-badge{
            position: absolute;
            top: -0.3125rem;
            right: 0.6875rem;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            background-color: #467fd0;
            color: #fff;
            font-size: 0.75rem;
            text-align: center;
            line-height: 1.25rem;
        }

        .menu-content{
            position: absolute;
            top:0;
            left:0;
            right: 0;
            bottom: 0;
            z-index:9999;
            background: rgba(72, 98, 163, 0.9);
            -webkit-transition: 0.3s ease;
            transition: 0.3s ease;
        }


        .menu-content{
            position: absolute;
            top:0;
            left:0;
            right: 0;
            bottom: 0;
            z-index:9999;

            -webkit-transition: 0.3s ease;
            transition: 0.3s ease;
        }
        .product-name{
            display: -webkit-box;
            -webkit-line-clamp: 3; /* number of lines to show */
            -webkit-box-orient: vertical;
        }
        .product-name-mobile{
            display: -webkit-box;
        -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        #inputCash{
            font-size: 52px;
            border-left: 0px;
            border-right: 0px;
            border-top: 0px;
            border-bottom: 2px solid grey;
        }

        .input-search{
            font-size: 42px;
            border-left: 0px;
            border-right: 0px;
            border-top: 0px;
            border-bottom: 2px solid grey;

        }

        @media screen and (max-width: 480px) {
            .input-search{
                font-size: 24px;
                border-left: 0px;
                border-right: 0px;
                border-top: 0px;
                border-bottom: 2px solid grey;
            }
            h4{
                margin-bottom: 2px;
                font-size: 1rem;
            }
            .table{
                margin-bottom: 0px !important;
            }
        }

        .input-search input:focus{
            color: blueviolet;
        }
        .input-search input::placeholder {
            padding: 10px;

        }

        .custom-currency{
            font-size: 1.25em;
        }

        .text-title{
            font-size: 1.25em;
            font-weight: 600;
        }
        .text-title{
            font-size: 1.50em;
            font-weight: 600;
        }

        .custom-text-info{
            font-size: 42px;
            border-left: 0px;
            border-right: 0px;
            border-top: 0px;
        }

        .custom-key{
            font-size: 1.25em;
            color: #827e84;
            border: 2px solid #ffffff !important;
        }

        .menu-mobile{
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: row;
            flex-direction: row;
            padding-left: 0;
        }

        .mobile-menu-item{
            display: block;
        }

        .view-shadow{
            -webkit-box-shadow: 4px -5px 5px -1px rgba(0,0,0,0.75);
            -moz-box-shadow: 4px -5px 5px -1px rgba(0,0,0,0.75);
            box-shadow: 4px -5px 5px -1px rgba(0,0,0,0.75);
        }
    </style>
@endpush


<div class="content" wire:ignore.self>

{{-- Menu Mobile--}}
<div class="menu-content h-100" style="display: none;">
    <div class="row ">
        <div class="col-12 text-right">
            <span class="close-mobile-menu m-2">
                <i class="las la-times text-white" style="font-size:32px;"></i>
            </span>
        </div>
        <div class="col-12 text-center">
            <a href="#"
                class=" link-pos text-white">
                <i class=" las la-calculator" style="font-size: 32px;"></i>
                <h6>POS</h6>
            </a>
        </div>
        <div class="col-12 text-center">
            <a href="#"
                class=" link-box-sale text-white">
                <i class="las la-cash-register" style="font-size: 32px;"></i></i>
                <h6>CAJA</h6>
            </a>
        </div>
        <div class="col-12 text-center">
            <a href="#"
                class=" link-sale text-white">
                <i class="las la-file-invoice-dollar" style="font-size: 32px;"></i>
                <h6>VENTAS</h6>
            </a>
        </div>
        <div class="col-12 text-center">
            <a href="#"
                class="link-customer text-white">
                <i class="las la-user" style="font-size: 32px;"></i>
                <h6>CLIENTES</h6>
            </a>
        </div>

        <div class="col-12 text-center">
            <a href="/admin" class="text-white ">
                <i class="las la-sign-out-alt" style="font-size: 32px;"></i>
            </a>
        </div>
    </div>

</div>
{{-- Cart Mobile --}}
<div class="cart-view" style="display: none;">
    <div class="row">
        <div class="col-12"><i class="la la-times-circle float-right close-cart-view" style="font-size: 32px;"></i></div>
    </div>
    <div class="row">
        <div class="col-12 card">
            @include('livewire.pos.partials.cart')
        </div>
    </div>

</div>

{{-- Header --}}
<div class="header-pos">

    <div class="row"   id="short-cuts"  style="display: none;">
        <div class="col-4">
            <div wire:init="validateBox" class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="boxSwitch" @if($isSaleBoxOpen) checked="true" @endif>
                <label class="custom-control-label" for="boxSwitch"
                    style="-webkit-touch-callout: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;">{{ $isSaleBoxOpen ? 'Caja abierta' : 'Caja cerrada' }}
                </label>
            </div>
            @if($isSaleBoxOpen && isset($saleBox->opened_at))
                <strong
                    class="text-primary">{{ \Carbon\Carbon::parse($saleBox->opened_at)->translatedFormat('j/m/Y - g:i a') }} -  ({{$user->name}})</strong>
            @endif
        </div>
        <div class="col-8 " >
            <div class="row">
                <div class="col-3"><span class=" border border-white rounder p-2 custom-key">F1 </span> (Inicio)</div>
                <div class="col-3"><span class=" border border-white rounder p-2 custom-key">F2 </span> (Cobrar)</div>
                <div class="col-3"><span class=" border border-white rounder p-2 custom-key">F3 </span>(Buscar)</div>
                <div class="col-3"><span class=" border border-white rounder p-2 custom-key">F6 </span> (Seleccionar cliente)</div>
            </div>
        </div>

    </div>
</div>

{{-- Content --}}




<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
    id="modal-confirm-pay">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
            </div>
            <div class="modal-body">
                <p>Este proceso generará una nueva orden y una factura electrónica.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modal-btn-yes">Si</button>
                <button type="button" class="btn btn-default" id="modal-btn-no">No</button>
            </div>
        </div>
    </div>
</div>

<div class="row ">
    {{-- Sidebar--}}
    <div class="col-1  d-none d-sm-block">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <ul id="menu-pos" class="pos-list-group list-group-flush">
                <li class="pos-list-group-item text-center my-auto">
                    <a href="#" class=" list-group-item-action link-pos ">
                        <i class=" las la-calculator" style="font-size: 32px;"></i>
                        <br>
                        POS
                    </a>
                </li>
                <li class="pos-list-group-item text-center  my-auto">
                    <a href="#"
                        class=" link-box-sale ">
                        <i class="las la-cash-register" style="font-size: 32px;"></i>
                        <br>
                        CAJA
                    </a>
                </li>
                <li class="pos-list-group-item text-center  my-auto">
                    <a href="#"
                        class="list-group-item-action link-sale">
                        <i class="las la-file-invoice-dollar" style="font-size: 32px;"></i>
                        <br>
                        VENTAS
                    </a>
                </li>
                <li class="pos-list-group-item text-center">
                    <a href="#" class="list-group-item-action  link-customer">
                        <i class="las la-user" style="font-size: 32px;"></i>
                        CLIENTES
                    </a>
                </li>

                {{-- <li class="pos-list-group-item text-center  my-auto"><a href="#" class="list-group-item-action ">
                        <i class="las la-cash-register" style="font-size: 32px;"></i>
                        <br>
                        Cashier</a></li>
                <li class="pos-list-group-item text-center  my-auto"><a href="#" class="list-group-item-action ">
                        <i class="las la-boxes" style="font-size: 32px;"></i>
                        <br>
                        Products</a></li>
                <li class="pos-list-group-item text-center  my-auto"><a href="#" class="list-group-item-action ">
                        <i class="las la-cog" style="font-size: 32px;"></i>
                        <br>
                        Setting</a></li> --}}
            </ul>



        </div>
    </div>
    {{-- Customer view --}}
    <div class="col-md-11 col-12 customer-view" style="display: none;">
        <div id="selectCustomer">@livewire('pos.customer.customer-view')</div>
    </div>
    {{-- Salesbox --}}
    <div class="col-md-11 col-12 sales-view" style="display: none;">
        <div>@livewire('pos.report.pos-report-view', ['seller' => $seller])</div>
    </div>
    {{-- Payment view --}}
    @include('livewire.pos.partials.payment')
     {{-- Movements Box --}}
     @include('livewire.pos.partials.movements-box')
    {{-- Sale Box --}}
    @include('livewire.pos.partials.sale-box')
    {{-- Confirm payment view --}}
    @include('livewire.pos.partials.confirm-payment')
    {{-- Final payment view --}}
    @include('livewire.pos.partials.final-payment')
    <div class="col-md-11 col-12 main-view" wire:ignore.self >
        <div class="row">
            <div class="col-md-8 col-12 m-0 p-0">
                {{-- <div class="row">
                    <div class="col-7 text-center pt-1 pb-1">
                        <form class="form-inline">
                            <input id="search" class="form-control w-100" type="search" placeholder="Buscar producto"
                                aria-label="Search">
                            {{-- <button class="btn btn-outline-info my-2 my-sm-0"
                                type="submit">Buscar</button> --}}
                {{--        </form>
                    </div>
                </div> --}}
                <div id="productList">@livewire('pos.list-products', ['seller' => $seller, 'view' => $viewMode , 'cartproducts'=> $totalProducts ])
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div id="cart-space" class="vh-100 ">
                    <div class="col-12 h-50 overflow-auto d-none d-sm-block">
                        @include('livewire.pos.partials.cart')
                    </div>


                    <div class=" col-12  h-50">
                        {{-- <div class='row col-md-12 p-0 m-0'>
                            <div class="col-md-6 border border-dark">
                                <div class="border-right-0"> SubTotal</div>
                            </div>
                            <div class="col-md-6 border border-dark">
                                <div class="  text-right">{{ currencyFormat($subtotal ?? 0, 'CLP', true) }}</div>
                            </div>
                        </div>
                        <div class='row col-md-12 p-0 m-0'>
                            <div class="col-md-6 border border-dark">
                                <div class="  border-top-0 border-bottom-0 border-right-0"> Descuento</div>
                            </div>
                            <div class="col-md-6 border border-dark">
                                <input wire:model="discount" type="number" name="discount" id="discount" placeholder="0" class="bg-light text-right" style="width: 100%; outline: none; border-width:0px; -webkit-appearance: none; margin: 0;">
                            </div>
                        </div> --}}
                        @if($total > 0)
                        <div class='row col-md-12 p-0 m-0 d-none d-sm-block'>
                            <div class="col-md-3">
                                <div class="  border-right-0"> Subtotal</div>
                            </div>
                            <div class="col-md-6">
                                {{-- <div style="border-bottom: 2px dotted #000000;"> </div> --}}
                                <span class="align-text-bottom w-100" style="border-bottom: 2px dotted #000000;"></span>
                            </div>
                            <div class="col-md-3">
                                <div class=" text-right"><strong>{{ currencyFormat($subtotal ?? 0, 'CLP', true) }}</strong></div>
                            </div>
                        </div>
                        @endif
                        @if($total > 0)
                        <div class="row col-md-12 p-0 m-0 d-none d-sm-block">
                            <div class="col-md-3">
                                <div class="  border-right-0"> Impuestos</div>
                            </div>
                            <div class="col-md-6">
                                {{-- <div style="border-bottom: 2px dotted #000000;"> </div> --}}
                                <span class="align-text-bottom w-100" style="border-bottom: 2px dotted #000000;"></span>
                            </div>
                            <div class="col-md-3">
                                <div class=" text-right"><strong>{{ currencyFormat($taxes ?? 0, 'CLP', true) }}</strong></div>
                            </div>
                        </div>
                        @endif
                        <div class="row col-md-12 p-0 m-0 border border-info  rounded p-1 bg-white">
                            <div class="col-md-3 col-3">
                                <div class="  border-right-0"> Total</div>
                            </div>
                            <div class="col-md-6 col-6">
                                {{-- <div style="border-bottom: 2px dotted #000000;"> </div> --}}
                                <span class="align-text-bottom w-100" style="border-bottom: 2px dotted #000000;"></span>
                            </div>
                            <div class="col-md-3 col-3">
                                <div class=" text-right"> <strong>{{ currencyFormat(($total ) ?? 0, 'CLP', true) }}</strong></div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12" @if(!$isSaleBoxOpen) style="display:none;" @endif>

                                <div  class="border border-info  rounded p-1 bg-white ">
                                    @if (session()->get('user.pos.selectedCustomer'))
                                    <div class="row">
                                        <div class="col-8">
                                            <i class="las la-user" ></i>
                                            {{ session()->get('user.pos.selectedCustomer')->first_name }}
                                            {{ session()->get('user.pos.selectedCustomer')->last_name }}
                                        </div>
                                        <div class="col-4">
                                            {{ session()->get('user.pos.selectedCustomer')->rut }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            {{ session()->get('user.pos.selectedCustomer')->email }}
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-info " id="btn-customer">
                                                @if (session()->get('user.pos.selectedCustomer'))
                                                    Cambiar Cliente (F6)
                                                @else
                                                    Seleccionar Cliente (F6)
                                                @endif
                                            </button>
                                        </div>
                                    </div>

                                </div>



                                <button class="btn btn-danger btn-block mt-1 " id="btn-pay"> Cobrar (F2)
                                 {{-- @if ($total <= 0 || is_null($customer)) disabled @endif>Pagar --}}
                                </button>
                            </div>
                            <div class="col-12" @if($isSaleBoxOpen) style="display:none;" @endif>
                                <button class="btn btn-warning btn-block btn-box-sale p-4">
                                    Debe iniciar una caja para continuar operando
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
</div>
{{-- Footer --}}

</div>
<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="modalSelectAddress" aria-hidden="true" id="modalSelectAddress">
    <div class="modal-dialog modal-lg">
        @livewire('pos.customer.create-address-form', [], key(time().'.address.'.$seller->id))
    </div>
</div>

<div wire:ignore.self class="modal fade" id="showCustomerModal" tabindex="-1" role="dialog"
    aria-labelledby="createCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        @livewire('pos.customer.create-customer', [], key(time().'.customer.'.$seller->id))
    </div>
</div>

</div>




@push('after_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/currencyformatter.js/2.2.0/currencyFormatter.min.js"
        integrity="sha512-zaNuym1dVrK6sRojJ/9JJlrMIB+8f9IdXGzsBQltqTElXpBHZOKI39OP+bjr8WnrHXZKbJFdOKLpd5RnPd4fdg=="
        crossorigin="anonymous"></script>

    <script>
        var currentView = 'productList';
        var addressModalAppended = true;
        var salexBoxModalAppended = true;
        var boardTarget = 'cash';
        const changeViewMode = (view, cartAlternative) => {
            $('#' + currentView).hide();
            $('#' + view).show();

            currentView = view;
        }
        const showCustomerModal = () => {
            $('#showCustomerModal').appendTo("body").modal('show');
        }

        window.addEventListener('hideCustomerModal', event => {
            $('#showCustomerModal').appendTo("body").modal('hide');
        })

        window.addEventListener('hideMovementSalesBoxModal', event => {
            $('#movementSalesBoxModal').appendTo("body").modal('hide');
        })



        window.addEventListener('showAddressModal', async (event) => {
            let modal = $('.app-body').find('#modalSelectAddress');
            $('.app-body').find('#modalSelectAddress').remove();
            if (addressModalAppended) {
                addressModalAppended = false;
                modal.appendTo('body');
            }
            $('#modalSelectAddress').modal('show');
        })

        window.addEventListener('hideAddressModal', event => {
            $('#modalSelectAddress').appendTo("body").modal('hide');
        })

        $("#showCustomerModal").on('hidden.bs.modal', function() {
            $('#showCustomerModal').appendTo("body").modal('hide');
        });

        /* Show modals on sales box */

        window.addEventListener('showSalesBoxModal', async (event) => {

            let modal = $('.app-body').find('#salesBoxModal');
            $('.app-body').find('#salesBoxModal').remove();
            if (salexBoxModalAppended) {
                salexBoxModalAppended = false;
                modal.appendTo('body');
            }
            //$('#salesBoxModal').modal('show');
        })

        //Colapse general menu
        $("body").removeClass('sidebar-lg-show');
        $("#search").focus();



        //Product search


        $(document).on('keydown', function (event) {

            if (event.which == 112 && event.target.id != 'pos-view'){

                $('.link-pos').trigger('click')
                return false;
            }

            if (event.which == 114 && event.target.id != 'search'){
                $("#search").focus().select();

                return false;
            }
           /*  if (event.which == 9){
                console.log('tab press');
                let firstProduct = $('.product-cart:first');
                firstProduct.click();


                //return false;
            } */
            if (event.which == 113 && event.target.id != 'payment-view'){
                $("#btn-pay").trigger('click');

                return false;
            }

            //Select customer
            if (event.which == 117 && event.target.id != 'customer-view'){

                $("#btn-customer").trigger('click');
                $('#search-customer').focus().select();
                return false;
            }
        });


        const filter = search => {
            let value = search.val().toLowerCase();
            $(".product-cart").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }

        //Customer search

        const filterCustomer = search => {
            let value = search.val().toLowerCase();
            $(".customer-item").filter(function() {
                $(this).toggle($(this).find('.customer-name').first().text().toLowerCase().indexOf(value) > -1)
            });
        }

        //Order search

        const filterOrder = search => {
            let value = search.val().toLowerCase();
            $(".order-list-item").filter(function() {
                $(this).toggle($(this).find('.order-id').first().text().toLowerCase().indexOf(value) > -1)
            });
        }

       /*  $("#search").on("keyup", () => filter($("#search")));
        $("#search").on("search", () => filter($("#search"))); */

        $(".search-customers").on("keyup", () => filterCustomer($(event.target)));
        $(".search-customers").on("search", () => filterCustomer($(event.target)));

        $(".order-search").on("keyup", () => filterOrder($(event.target)));
        $(".order-search").on("search", () => filterOrder($(event.target)));

        $(".search-orders").on("keyup", () => filterOrder($(event.target)));
        $(".search-orders").on("search", () => filterOrder($(event.target)));



        spanCash = $('.total-cash')
        spanTip = $('.total-tip')
        spanChange = $('.total-change')
        totalCart = $('.total-cart')
        confirmPay = $('#confirm-pay')
        inputCash = $('#inputCash')

        //For mobile
        spanCalc = $('.total-cash')



        spanCash.text('$0')
        spanChange.text('$0')
        spanTip.text('$0')


        confirmPay.prop("disabled", true);


        $('.payment-view').hide();

        // Calc
        function chr(value) {
            switch (boardTarget) {
                case 'cash':
                    updateCash(value);
                    break;

                case 'tip':
                    updateTip(value);
                    break;

                case 'calc':
                    updateCalc(value);
                    break;

                default:
                    updateCash(value);
                    break;
            }
        }

        function showTipRow() {
            $('#tip-input').show();
        }

        function showTipOperation() {
            $('#calculate-tip').show();
        }

        function hideTipOperation() {
            $('#calculate-tip').hide();
        }

        function hideTipRow() {
            $('#tip-input').hide();
        }

        inputCash.keyup(function(){
            updateCash(this.value);

        })
        function updateCash(value) {
            tmpTotalCart = clearCurrency(totalCart)
            tmpCash = clearCurrency(spanCash)
           if(value === '')  {
            tmpCash = 0
           }else{
            tmpCash = value
           }


            tmpCashFloat = parseFloat(tmpCash)
            tmpTotalCartFloat = parseFloat(tmpTotalCart)

            spanCash.text(formatCurrency(tmpCashFloat))

            if (tmpCashFloat >= tmpTotalCartFloat) {
                tmpChange = calculeChange(tmpCashFloat, tmpTotalCartFloat)

                showTipRow();
                spanChange.text(formatCurrency(tmpChange))
                confirmPay.removeAttr('disabled');
            } else {
                hideTipRow();
                spanChange.text(formatCurrency(0))
                confirmPay.prop("disabled", true);
            }
        }

        function updateTip(value) {
            tmpTip = clearCurrency(spanTip)

            switch (value) {
                case '<<':
                    tmpTip = tmpTip.slice(0, -1)
                    break;
                case 'C':
                    tmpTip = 0
                    break;
                default:
                    tmpTip += value
                    break;
            }

            if (parseFloat(tmpTip) > 0) {
                showTipOperation();
            } else {
                hideTipOperation();
            }

            spanTip.text(formatCurrency(tmpTip))
        }

        function updateCalc(value) {
            tmpTotalCart = clearCurrency(totalCart)
            tmpCalc = clearCurrency(spanCalc)

            switch (value) {
                case '<<':
                    if(tmpCalc.length > 2){
                        tmpCalc = tmpCalc.slice(0, -1);
                    }else {
                        tmpCalc = 0;
                    }
                    break;
                case 'C':
                    tmpCalc = '$0';
                    break;
                default:
                    tmpCalc += value
                    break;
            }



            //spanCalc.text(formatCurrency(tmpCalc))


            tmpCalcFloat = parseFloat(tmpCalc)
            tmpTotalCartFloat = parseFloat(tmpTotalCart)

            spanCalc.text(formatCurrency(tmpCalcFloat))

            if (tmpCalcFloat >= tmpTotalCartFloat) {
                tmpChange = calculeChange(tmpCalcFloat, tmpTotalCartFloat)

                spanChange.text(formatCurrency(tmpChange))
                confirmPay.removeAttr('disabled');
            } else {

                spanChange.text(formatCurrency(0))
                confirmPay.prop("disabled", true);
            }
        }

        function transferTipToChange() {
            let tmpCash = clearCurrency(spanCash);
            let tmpTotalCart = clearCurrency(totalCart);

            let tmpCashFloat = parseFloat(tmpCash);
            let tmpTotalCartFloat = parseFloat(tmpTotalCart);

            let tmpChange = calculeChange(tmpCashFloat, tmpTotalCartFloat);
            tmpChange = calculeChange(tmpChange, tmpTip);

            if (tmpChange < 0) {
                spanTip.text(formatCurrency(Math.abs(tmpChange)))
                tmpChange = 0;
            } else {
                spanTip.text('$0')
            }

            spanChange.text(formatCurrency(tmpChange));
            $('#calculate-tip').hide();
        }

        /*
        function formatCurrency(value) {
            let options = {
                style: 'currency',
                currency: 'CLP'
            };
            let numberFormat = new Intl.NumberFormat('es-CL', options);

            return numberFormat.format(value);
        }
        */
        function formatCurrency(value){

            var num_parts = value.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return '$ '+num_parts.join(".");
        }

        function calculeChange(totalCash, totalCart) {
            return totalCash - totalCart
        }

        function clearCurrency(value) {
            tmpValue = value.text()
            tmpValue = tmpValue.replace('$', '')
            tmpValue = tmpValue.replace(/\./g, '')
            return tmpValue
        }


        function hideAllViews(){
            $("div[class$='-view']").hide();
           // $('.header-pos').hide()
        }


        $("#confirm-pay").click( function() {
            $('payment-view').show();
            $('.final-payment-view').hide();
        });

        $(".close-confirm-payment").click( function() {
            $('.confirm-payment-view').hide();
            $('.payment-view').show();
        });
        $(".close-final-payment").click( function() {
            $('.final-payment-view').hide();
            $('.payment-view').show();
        });

        /* $("#tip-input").click( function() {
            $("#cash-input").removeClass('border border-warning rounded');
            $(this).addClass('border border-warning rounded');
            showTipRow();
            boardTarget = 'tip';
        });

        $("#cash-input").click( function() {
            $("#tip-input").removeClass('border border-warning rounded');
            $(this).addClass('border border-warning rounded');
            updateTip('C');
            transferTipToChange();
            spanTip.text(formatCurrency(0))
            boardTarget = 'cash';
        });

        $("#calculate-tip").click( function() {
            transferTipToChange();
        }); */





            $('header').show()
            $('footer').show()
             //Menu actions

            $('.link-pos').click(function() {
                hideAllViews()
                $('.main-view').show();
                $('.menu-content').hide()



            });

            $('.link-box-sale').click(function() {
                hideAllViews();
                $('.sale-box-view').show();
                $('.menu-content').hide()
            });


            $('.link-sale').click(function() {
                hideAllViews()
                $('.sales-view').show();
                $('.menu-content').hide()
            });

            $('.link-customer').click(function() {
                hideAllViews()
                $('.customer-view').show();
                $('.menu-content').hide()
            });

            $('#btn-customer').click(function() {
                hideAllViews()
                $('.customer-view').show();


            });

            $('#close-payment').click(function() {
                hideAllViews()
                $('.main-view').show();

            });

            $('#btn-pay').click(function() {
                hideAllViews()
                $('.payment-view').show();
                inputCash.focus().select();
                //$('.main-view').hide();
            });
            $('#btn-pay-mobile').click(function() {
                hideAllViews()
                $('.payment-view').show();
                //inputCash.focus().select();
                //$('.main-view').hide();
            });

            $('.btn-box-sale').click(function() {
                console.log('aca');
                hideAllViews();
                $('.sale-box-view').show();

            });




    </script>



    <script>
        document.addEventListener('livewire:load', function() {

            btnPay = $('#btn-pay');
            const modalConfirm = function(callback) {

                $("#confirm-pay").on("click", function() {
                    confirmPayment()
                    $("#inputaCash").val(0);
                    // $("#modal-confirm-pay").appendTo("body").modal('show');
                });
                /*
                $("#modal-btn-yes").on("click", function() {
                    callback(true);
                    $("#modal-confirm-pay").modal('hide');
                });

                $("#modal-btn-no").on("click", function() {
                    callback(false);
                    $("#modal-confirm-pay").modal('hide');
                });
                */
            };



            modalConfirm(async function(confirm) {
                if (confirm) {
                    let totalCash = $('.total-cash').text()
                    totalCash = totalCash.replace('$', '')
                    totalCash = totalCash.replace(/\./g, '')
                    totalCash = parseFloat(totalCash)

                    await @this.confirmPayment(totalCash)
                    // Livewire.emit('confirmPayment', totalCash)
                    $('.payment-view').hide();

                }
            });

            const confirmPayment = async() => {
                let totalCash = $('.total-cash').text()
                    totalCash = totalCash.replace('$', '')
                    totalCash = totalCash.replace(/\./g, '')
                    totalCash = parseFloat(totalCash)

                let tip = clearCurrency(spanTip)
                let typeDocument = $('#type_document_select').val()
                let businessActivity = $('#business_activity_select').val()

                    await @this.confirmPayment(totalCash, tip, typeDocument, businessActivity)
                    hideAllViews()

                    $('.final-payment-view').show();
            }

            // Sales Box
            window.addEventListener('openSaleBoxView', event => {
               // hideAllViews()
                $('.sale-box-view').show();
                $('.main-view').hide();

            })
            window.addEventListener('closeSaleBoxView', event => {
               // hideAllViews()
                $('.sale-box-view').hide();
                $('.main-view').show();
                $('.cart-buttons-view').show();
            })

            $("#boxSwitch").change(async () => {
                let checkbox = event.target
                checkbox.checked = !checkbox.checked

                await @this.validateBox();

                $('.sale-box-view').show();
                $('.main-view').hide();
            })

            $(".close-sale-box-view").click( function() {
                hideAllViews()
                $('.main-view').show();
              //  $('.sale-box').hide();
                $('.cart-buttons-view').show();
            });






        })

        //Mobile
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {



            // Business Activity
            if ($('#type_document_select').val() == 33) {
                $('#business_activity_div').show()
            } else {
                $('#business_activity_div').hide()
            }

            // Type document change event
            $('#type_document_select').change( function () {
                if (this.value == 33) {
                    let address =  @this.getSelectedCustomerAddress()
                    if(address == null) {
                        //btnPay.prop("disabled", true);
                    }else{
                        $('#business_activity_div').show()
                    }
                } else {
                    $('#business_activity_div').hide()
                }
            })

            //Update mobile
            var mobileMQ = window.matchMedia("(max-width: 360px)")
            header =$(".app-header");
            headerMobile = $("#header-mobile");
            menuMobile = $("#menu-mobile");
            cartMobile = $("#cart-mobile");
            cartSpace = $('#cart-space');
            shortCuts = $('#short-cuts');
            panelCalc = $('#panel-calc');
            inputCash = $('#inputCash');
            paymentMethod = $('#payment-method');
            cashDiv = $('#cash-div');
            changeDiv = $('#change-div');
            btnPay = $('#btn-pay');
            btnCustomer = $('#btn-customer');
            productList= $('#productList').find('.product-cart')

            function checkMobile(mq) {


               if (mq.matches) {
                    cartSpace.removeClass('vh-100');
                    cartSpace.addClass('fixed-bottom');
                    header.hide();
                    headerMobile.hide();
                    productList.each(function() {
                        $(this).find("div").removeClass("h-100")
                    })

                    menuMobile.show();
                    cartMobile.show();
                    shortCuts.hide();
                    boardTarget = 'calc';
                    panelCalc.show();
                    inputCash.hide();
                    btnPay.text('Cobrar');
                    btnCustomer.text('Cambiar Cliente')


                    //Check paymentmethod
                    paymentMethod.change(function(){
                       currentPaymentMethod = $(this).val()
                       if(currentPaymentMethod != 1) {
                           panelCalc.hide()
                           cashDiv.hide()
                           changeDiv.hide()
                           confirmPay.removeAttr('disabled');
                       }else{
                           panelCalc.show()
                           cashDiv.show()
                           changeDiv.show()
                           confirmPay.prop("disabled", true);
                       }
                    })

                }else{
                    cartSpace.addClass("vh-100");
                    cartSpace.removeClass("fixed-bottom");
                    header.show();
                    headerMobile.hide();
                    menuMobile.hide();
                    cartMobile.hide();
                    shortCuts.show();
                    boardTarget = 'cash';
                    panelCalc.hide();
                    inputCash.show();
                    btnPay.text('Cobrar (F2)');
                    btnCustomer.text(' Cambiar Cliente (F6)')

                }
            }


            mobileMQ.addListener(checkMobile)
            checkMobile(mobileMQ)


            // MENU MOBILE
            $('.menu-mobile').click(function(){
               $('.menu-content').show()
            })
            $('.close-mobile-menu').click(function(){
               $('.menu-content').hide()
            })

            //CART MOBILE
            $('#mobile-cart-view').click(function(){
                hideAllViews()
               $('.cart-view').show()

            })


            $('.close-cart-view').click(function(){
                hideAllViews()
               $('.main-view').show()

            })
            $('.close-pay-view').click(function(){
                hideAllViews()
               $('.main-view').show()

            })
            $('.close-customer-view').click(function(){
                hideAllViews()
               $('.main-view').show()

            })

        })

    });


    </script>
@endpush

