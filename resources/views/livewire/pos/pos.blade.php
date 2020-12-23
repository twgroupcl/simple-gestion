{{-- @php
use App\Models\Product;
@endphp --}}
<div class="content" wire:ignore.self>

@handheld
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
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

<div class="cart-view" style="display: none;">
    <div class="row">
        <div class="col-12"><i class="la la-close float-right close-cart-view"></i></div>
    </div>
    <div class="row">
        <div class="col-12">
            @include('livewire.pos.partials.cart')
        </div>
    </div>

</div>
{{-- Menu --}}
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
                class=" link-sale text-white">
                <i class="las la-file-invoice-dollar" style="font-size: 32px;"></i>
                <h6>SALES</h6>
            </a>
        </div>
        <div class="col-12 text-center">
            <a href="#"
                class="link-customer text-white">
                <i class="las la-user" style="font-size: 32px;"></i>
                <h6>CUSTOMER</h6>
            </a>
        </div>

        <div class="col-12 text-center">
            <a href="/admin" class="text-white ">
                <i class="las la-sign-out-alt" style="font-size: 32px;"></i>
            </a>
        </div>
    </div>

</div>
{{-- Header --}}
<div class="header-pos">
    <div class="row mb-2">
        <div class="col-2 text-center">
            <i class="las la-bars menu-mobile" style="font-size: 32px;"></i>
        </div>
        <div class="col-8 p-0 text-center">
            <form class="form-inline search-products">
                <input id="search" class="form-control w-100" type="search" placeholder="Buscar producto"
                    aria-label="Search">
           </form>
           <form class="form-inline search-customers" style="display: none;">
            <input id="search-customers" class="form-control w-100" type="search" placeholder="Buscar cliente"
                aria-label="Search">
       </form>
        </div>
        <div class="col-2 p-0">
            <span class="las la-shopping-cart mobile-cart-view" style="font-size:32px;">
            @if ($cartproducts) <span
                class="custom-badge badge-cart-view" >{{ count($cartproducts) }}</span>
            @else
            <span
                class="custom-badge">0</span>
            @endif
        </span>
    </div>
</div>
</div>

{{-- Customer view --}}
<div class="customer-view h-50" style="display: none;">
    <div id="selectCustomer">@livewire('pos.customer.customer-view')</div>
</div>
{{-- Main view products --}}
{{-- Payment view --}}
@include('livewire.pos.partials.payment')
{{-- Confirm payment view --}}
@include('livewire.pos.partials.confirm-payment')
<div class="main-view h-50">
    <div id="productList">@livewire('pos.list-products', ['seller' => $seller, 'view' => $viewMode])
    </div>
</div>
<div class="cart-buttons h-25">
    <div class="row fixed-bottom">
        <div class="col-6 p-1">
            <button class="btn btn-danger btn-block btn-customer">
                @if (session()->get('user.pos.selectedCustomer'))
                    {{ session()->get('user.pos.selectedCustomer')->first_name }}
                    {{ session()->get('user.pos.selectedCustomer')->last_name }}
                @else
                    Seleccionar Cliente
                @endif
            </button>
        </div>
        <div class="col-6 p-1 ">
            <button class="btn btn-danger btn-block " id="btn-pay" @if ($total <= 0 || is_null($customer)) disabled @endif>Pagar
            </button>
        </div>
    </div>

</div>
@elsehandheld


{{-- Header --}}
<div class="header-pos">
    <div class="row">
        <div class="col-4">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="boxSwitch" wire:model="checked">
                <label class="custom-control-label" for="boxSwitch"
                    style="-webkit-touch-callout: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;">{{ $checked ? 'Caja abierta' : 'Caja cerrada' }}
                </label>
            </div>
            @isset($saleBox->opened_at)
                <strong
                    class="text-primary">{{ \Carbon\Carbon::parse($saleBox->opened_at)->translatedFormat('j/m/Y - g:i a') }}</strong>
            @endisset
        </div>
        <div class="col-4"></div>
        <div class="col-4"></div>
    </div>
</div>

{{-- Content --}}



<div class="modal fade" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modalSelectAddress" aria-hidden="true" id="modalSelectAddress">
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
    <div class="col-1">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <ul class="pos-list-group list-group-flush">
                <li class="pos-list-group-item text-center my-auto">
                    <a href="#" class=" list-group-item-action link-pos ">
                        <i class=" las la-calculator" style="font-size: 32px;"></i>
                        <br>
                        POS
                    </a>
                </li>
                <li class="pos-list-group-item text-center  my-auto"><a href="#"
                        class="list-group-item-action link-sale">
                        <i class="las la-file-invoice-dollar" style="font-size: 32px;"></i>
                        <br>
                        Sales</a></li>
                <li class="pos-list-group-item text-center"><a href="#" class="list-group-item-action  link-customer">
                        <i class="las la-user" style="font-size: 32px;"></i>
                        Customer</a></li>

                <li class="pos-list-group-item text-center  my-auto"><a href="#" class="list-group-item-action ">
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
                        Setting</a></li>
            </ul>



        </div>
    </div>
    {{-- Customer view --}}
    <div class="col-11 customer-view" style="display: none;">
        <div id="selectCustomer">@livewire('pos.customer.customer-view')</div>
    </div>
    {{-- Salesbox --}}
    <div class="col-11 sales-view" style="display: none;">
        <div>@livewire('pos.report.pos-report-view', ['seller' => $seller])</div>
    </div>
    {{-- Payment view --}}
    @include('livewire.pos.partials.payment')
    {{-- Confirm payment view --}}
    @include('livewire.pos.partials.confirm-payment')
    {{-- Confirm payment view --}}
    @include('livewire.pos.partials.final-payment')
    <div class="col-11 main-view">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-7 text-center pt-1 pb-1">
                        <form class="form-inline">
                            <input id="search" class="form-control w-100" type="search" placeholder="Buscar producto"
                                aria-label="Search">
                            {{-- <button class="btn btn-outline-info my-2 my-sm-0"
                                type="submit">Buscar</button> --}}
                        </form>
                    </div>
                </div>
                <div id="productList">@livewire('pos.list-products', ['seller' => $seller, 'view' => $viewMode])
                </div>
            </div>
            <div class="col-4">
                <div class="vh-100">
                    <div class="col-12 h-50 overflow-auto">
                        @include('livewire.pos.partials.cart')
                    </div>


                    <div class=" col-12  h-50">
                        <div class='row col-md-12 p-0 m-0'>
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
                        </div>
                        <div class='row col-md-12 p-0 m-0'>
                            <div class="col-md-6 border border-dark">
                                <div class="  border-right-0"> Total</div>
                            </div>
                            <div class="col-md-6 border border-dark">
                                <div class=" text-right">{{ currencyFormat($total ?? 0, 'CLP', true) }}</div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <button class="btn btn-danger btn-block btn-customer">
                                    @if (session()->get('user.pos.selectedCustomer'))
                                        {{ session()->get('user.pos.selectedCustomer')->first_name }}
                                        {{ session()->get('user.pos.selectedCustomer')->last_name }}
                                    @else
                                        Seleccionar Cliente
                                    @endif
                                </button>

                                <button class="btn btn-danger btn-block " id="btn-pay" @if ($total <= 0 || is_null($customer)) disabled @endif>Pagar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
</div>
{{-- Footer --}}
@endhandheld
</div>
</div>




@push('after_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/currencyformatter.js/2.2.0/currencyFormatter.min.js"
        integrity="sha512-zaNuym1dVrK6sRojJ/9JJlrMIB+8f9IdXGzsBQltqTElXpBHZOKI39OP+bjr8WnrHXZKbJFdOKLpd5RnPd4fdg=="
        crossorigin="anonymous"></script>

    <script>
        var currentView = 'productList';
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

        window.addEventListener('showAddressModal', event => {
            $('#modalSelectAddress').appendTo("body").modal('show');
        })

        window.addEventListener('hideAddressModal', event => {
            $('#modalSelectAddress').appendTo("body").modal('hide');
        })

        $("#showCustomerModal").on('hidden.bs.modal', function() {
            $('#showCustomerModal').appendTo("body").modal('hide');
        });


        //Product search

        const filter = search => {
            let value = search.val().toLowerCase();
            $(".product-cart").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }


        $("#search").on("keyup", () => filter($("#search")));
        $("#search").on("search", () => filter($("#search")));


        //  //Customer search

        //  const filter = searchCustomer=> {
        //     let value = searchCustomer.val().toLowerCase();
        //     $(".customer-item").filter(function() {
        //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        //     });
        // }


        // $("#search-customers").on("keyup", () => filter($("#search-customers")));
        // $("#search-customers").on("searchCustomer", () => filter($("#search-customers")));



        spanCash = $('.total-cash')
        spanChange = $('.total-change')
        totalCart = $('.total-cart')
        confirmPay = $('#confirm-pay')



        spanCash.text('$0')
        spanChange.text('$0')

        confirmPay.prop("disabled", true);


        $('.payment-view').hide();

        // Calc
        function chr(value) {

            tmpTotalCart = clearCurrency(totalCart)
            tmpCash = clearCurrency(spanCash)

            switch (value) {
                case '<<':
                    tmpCash = tmpCash.slice(0, -1)
                    break;
                case 'C':
                    tmpCash = 0
                    break;
                default:
                    tmpCash += value
                    break;
            }

            spanCash.text(formatCurrency(tmpCash))
            tmpCashFloat = parseFloat(tmpCash)
            tmpTotalCartFloat = parseFloat(tmpTotalCart)

            if (tmpCashFloat >= tmpTotalCartFloat) {
                tmpChange = calculeChange(tmpCashFloat, tmpTotalCartFloat)

                spanChange.text(formatCurrency(tmpChange))
                confirmPay.removeAttr('disabled');
            } else {
                spanChange.text(formatCurrency(0))
                confirmPay.prop("disabled", true);
            }
        }

        function formatCurrency(value) {
            let options = {
                style: 'currency',
                currency: 'CLP'
            };
            let numberFormat = new Intl.NumberFormat('es-CL', options);
            return numberFormat.format(value);
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





        $("#confirm-pay").click( function() {
            $('.confirm-payment-view').show();
            $('.payment-view').hide();
        });

        $(".close-confirm-payment").click( function() {
            $('.confirm-payment-view').hide();
            $('.payment-view').show();
        });




        @handheld
            $('header').hide()
            $('footer').hide()
            $('.menu-content').hide()
            $('.container-fluid').addClass('p-1')

            $('.btn-customer').click(function() {
                $('.customer-view').show();
                $('.main-view').hide();

            });

            $('#btn-pay').click(function() {
                $('.payment-view').show();
                $('.main-view').hide();
                $('.cart-buttons').hide();
            });

            $('#close-payment').click(function() {
                $('.main-view').show();
                $('.payment-view').hide();
                $('.cart-buttons').show();
            });

            $('.menu-mobile').click(function(){
               $('.menu-content').show()
            })

            $('.close-mobile-menu').click(function(){
               $('.menu-content').hide()
            })

            $('.mobile-cart-view').click(function(){
               $('.cart-view').show()
               $('.main-view').hide()
               $('.header-pos').hide()
            })


            $('.close-cart-view').click(function(){
               $('.cart-view').hide()
               $('.main-view').show()
               $('.header-pos').show()
            })


            //Menu actions

            $('.link-pos').click(function() {
                $('.main-view').show();
                $('.customer-view').hide();
                $('.sales-view').hide();
                $('.menu-content').hide()
                //change search
                $('.search-customers').hide();
                $('.search-products').show();


            });

            $('.link-sale').click(function() {
                $('.sales-view').show();
                $('.main-view').hide();
                $('.customer-view').hide();
                $('.menu-content').hide()
            });

            $('.link-customer').click(function() {
                $('.customer-view').show();
                $('.main-view').hide();
                $('.sales-view').hide();
                $('.menu-content').hide()

                //change search
                $('.search-customers').show();
                $('.search-products').hide();
            });

        @elsehandheld
            $('header').show()
            $('footer').show()
             //Menu actions

            $('.link-pos').click(function() {
                $('.main-view').show();
                $('.customer-view').hide();
                $('.sales-view').hide();
                //change search
                $('.search-customers').hide();
                $('.search-products').show();


            });

            $('.link-sale').click(function() {

                $('.sales-view').show();
                $('.main-view').hide();
                $('.customer-view').hide();
            });

            $('.link-customer').click(function() {
                $('.customer-view').show();
                $('.main-view').hide();
                $('.sales-view').hide();
            });

            $('.btn-customer').click(function() {
                $('.customer-view').show();
                $('.main-view').hide();
            });

            $('#close-payment').click(function() {
                $('.main-view').show();
                $('.payment-view').hide();
            });

            $('#btn-pay').click(function() {
                $('.payment-view').show();
                $('.main-view').hide();
            });


        @endhandheld

    </script>



    <script>
        document.addEventListener('livewire:load', function() {

            const modalConfirm = function(callback) {

                $("#confirm-payment").on("click", function() {
                    confirmPayment()
                    // $("#modal-confirm-pay").appendTo("body").modal('show');
                });

                $("#modal-btn-yes").on("click", function() {
                    callback(true);
                    $("#modal-confirm-pay").modal('hide');
                });

                $("#modal-btn-no").on("click", function() {
                    callback(false);
                    $("#modal-confirm-pay").modal('hide');
                });
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

                    //await @this.confirmPayment(totalCash)
                    $('.payment-view').hide();
                    $('.confirm-payment-view').hide();
                    $('.final-payment-view').show();
            }
        })

    </script>
@endpush

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
    </style>
@endpush
