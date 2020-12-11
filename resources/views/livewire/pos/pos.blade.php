<div class="content">
    @livewire('pos.navbar')

    <div class="row">
        <div class="col-1">
            <div class="bg-light border-right" id="sidebar-wrapper">
                <ul class="pos-list-group list-group-flush">
                    <li class="pos-list-group-item text-center my-auto">
                        <a href="#" onclick="changeViewMode('productList')""
                            class=" list-group-item-action ">
                            <i class=" las la-calculator" style="font-size: 32px;"></i>
                            <br>
                            POS
                        </a>
                    </li>
                    <li class="pos-list-group-item text-center  my-auto"><a href="#" class="list-group-item-action ">
                            <i class="las la-file-invoice-dollar" style="font-size: 32px;"></i>
                            <br>
                            Sales</a></li>
                    <li class="pos-list-group-item text-center"><a href="#" onclick="changeViewMode('selectCustomer')"
                            class="list-group-item-action ">
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

        <div class="col-11 payment-view">
            <div class="row">
                <div class="col-12"><i class="la la-close float-right" id="close-payment"></i></div>
            </div>
            <div class="row customer-view " >
                <div class='card text-left col-md-12'>
                    <div class="row">
                        <div class="col-sm-12">
                        <div class="">
                            <div class="card-body">
                            {{-- <h5 class="card-title">{{$selectedCustomer->first_name}}</h5>
                            <p class="card-text">{{$selectedCustomer->email}}</p>
                            <p class="card-text">{{$selectedCustomer->uid}}</p> --}}
                            <h5 class="card-title"><span class="customer-firstname"></span> <span class="customer-lastname"></span></h5>
                            <p class="card-text"><span class="customer-email"></span></p>
                            <p class="card-text"><span class="customer-uid"></span></p>
                            </div>
                            {{-- <a href="#" class="btn btn-outline-primary mb-3">Pago en efectivo</a> --}}
                            {{-- <a href="#" class="btn btn-outline-primary mb-3">Pago con transbank</a> --}}
                        </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="card col-md-12 text-center">
                    <h4 class="text-info">Pago en efectivo</h4>
                </div>
            </div>
            <div class="row">
                <div class="card col-md-6">
                    <div class='card-body'>
                        <div class="row">
                            <div class="col-6 text-left">
                                <h4>Total</h4>
                            </div>
                            <div class="col-6 text-danger text-right">
                                <h4><span class="total-cart"></span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6  text-left">
                                <h4>Efectivo</h4>
                            </div>
                            <div class="col-6 text-danger text-right">
                                <h4><span class="total-cash"></span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6  text-left ">
                                <h4>Cambio</h4>
                            </div>
                            <div class="col-6 text-danger text-right">
                               <h4> <span class="total-change"></span></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-6">
                    {{-- <div class='card-body'>
                        <input class='input' id='display' disabled>
                    </div> --}}
                    <div class='card-body'>
                        <table class='table table-sm table-borderless'>
                            <tbody>
                                <tr>
                                    <td><button class='btn btn-lg' onclick='chr("7")'>7</button></td>
                                    <td><button class='btn btn-lg' onclick='chr("8")'>8</button></td>
                                    <td><button class='btn btn-lg' onclick='chr("9")'>9</button></td>
                                </tr>
                                <tr>
                                    <td><button class='btn btn-lg' onclick='chr("4")'>4</button></td>
                                    <td><button class='btn btn-lg' onclick='chr("5")'>5</button></td>
                                    <td><button class='btn btn-lg' onclick='chr("6")'>6</button></td>
                                </tr>
                                <tr>
                                    <td><button class='btn btn-lg' onclick='chr("1")'>1</button></td>
                                    <td><button class='btn btn-lg' onclick='chr("2")'>2</button></td>
                                    <td><button class='btn btn-lg' onclick='chr("3")'>3</button></td>
                                </tr>
                                <tr>


                                    <td><button class='btn btn-lg' onclick='chr("C")'>C</button></td>
                                    <td><button class='btn btn-lg' onclick='chr("0")'>0</button></td>
                                    <td><button class='btn btn-lg' onclick='chr("<<")'><i
                                                class="las la-backspace"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class='card-body'>
                        <button class="btn btn-danger btn-block " id="confirm-pay">Confirmar pago
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-7 col-12 main-view">
            <div class="position-relative overflow-auto vh-100">
                <div id="productList">@livewire('pos.list-products', ['seller' => $seller, 'view' => $viewMode])
                </div>
                <div id="selectCustomer" style="display: none;">@livewire('pos.customer.customer-view')</div>
                <div id="paymentView" style="display: none;">@livewire('pos.payment.payment-view', ['seller' =>
                    $seller, 'view' => $viewMode])</div>
            </div>
        </div>
        <div class="col-md-4 col-12 main-view">
            <div class="position-relative overflow-hidden vh-100">
                @livewire('pos.cart.cart')</div>
        </div>
    </div>
</div>

</div>

<div wire:ignore.self class="modal fade" id="showCustomerModal" tabindex="-1" role="dialog"
    aria-labelledby="createCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        @livewire('pos.customer.create-customer')
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-confirm-pay">
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

<div class="alert" role="alert" id="result"></div>
@livewire('pos.sales-box', ['seller' => $seller])
</div>

@push('after_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/currencyformatter.js/2.2.0/currencyFormatter.min.js" integrity="sha512-zaNuym1dVrK6sRojJ/9JJlrMIB+8f9IdXGzsBQltqTElXpBHZOKI39OP+bjr8WnrHXZKbJFdOKLpd5RnPd4fdg==" crossorigin="anonymous"></script>

    <script>
        var currentView = 'productList';
        const changeViewMode = view => {
            $('#' + currentView).hide();
            $('#' + view).show();
            currentView = view;
        }

    </script>

    <script>
        const showCustomerModal = () => {
            $('#showCustomerModal').appendTo("body").modal('show');
        }

        $("#showCustomerModal").on('hidden.bs.modal', function() {
            $('#showCustomerModal').appendTo("body").modal('hide');
        });


        spanCash = $('.total-cash')
        spanChange = $('.total-change')
        totalCart = $('.total-cart')
        confirmPay = $('#confirm-pay')


        spanCash.text('$0')
        spanChange.text('$0')

        confirmPay.prop("disabled", true);

        $('.payment-view').hide();

        $('.customer-view').hide();

        $('#btn-pay').click(function() {
            //load cart

            @php
            $cart = json_decode(session()->get('user.pos.cart'));
            $cartTotal = currencyFormat($cart-> total ?? 0, 'CLP', true);

            $customer = json_decode(session()->get('user.pos.selectedCustomer'));

            @endphp
            currentCart = JSON.parse({!!json_encode(session()-> get('user.pos.cart'), JSON_FORCE_OBJECT) !!})


            @if(!is_null($customer))
                //show customer
                $('.customer-firstname').text('{{$customer->first_name}}')
                $('.customer-lastname').text('{{$customer->last_name}}')
                $('.customer-email').text('{{$customer->email}}')
                $('.customer-uid').text('{{$customer->uid}}')
                $('.customer-view').show();
            @endif
            //show total cart
            currentCartTotal = '{{ $cartTotal }}'



            $('.total-cart').append(currentCartTotal)
            $('.main-view').hide();
            $('.payment-view').show();



        });
        $('#close-payment').click(function() {
            $('.main-view').show();
            $('.payment-view').hide();
        });

        function chr(value) {

            // totalCart = $('.total-cart')
            // spanCash = $('.total-cash')
            // spanChange = $('.total-change')


            tmpTotalCart = clearCurrency(totalCart)

            tmpCash = clearCurrency(spanCash)

            switch(value){
                case '<<' :  tmpCash = tmpCash.slice(0, -1)
                    break;
                case 'C' :  tmpCash = 0
                    break;
                default: tmpCash += value
                    break;
            }

            spanCash.text(formatCurrency(tmpCash))
            tmpCashFloat = parseFloat(tmpCash)
            tmpTotalCartFloat = parseFloat(tmpTotalCart)

            if( tmpCashFloat >= tmpTotalCartFloat){
                tmpChange = calculeChange( tmpCashFloat, tmpTotalCartFloat)

                spanChange.text(formatCurrency(tmpChange))
                confirmPay.removeAttr('disabled');
            }else{
                spanChange.text(formatCurrency(0))
                confirmPay.prop("disabled", true);
            }
        }

        function formatCurrency(value){
            let options = { style: 'currency', currency: 'CLP' };
            let numberFormat = new Intl.NumberFormat('es-CL', options);
            return numberFormat.format(value);
        }

        function calculeChange(totalCash, totalCart){
            return totalCash - totalCart
        }

        function clearCurrency(value){
            tmpValue = value.text()
            tmpValue = tmpValue.replace('$','')
            tmpValue = tmpValue.replace(/\./g,'')
            return tmpValue
        }

    </script>

<script>
    document.addEventListener('livewire:load', function () {

        const modalConfirm = function(callback){

            $("#confirm-pay").on("click", function(){
                $("#modal-confirm-pay").appendTo("body").modal('show');
            });

            $("#modal-btn-yes").on("click", function(){
                callback(true);
                $("#modal-confirm-pay").modal('hide');
            });

            $("#modal-btn-no").on("click", function(){
                callback(false);
                $("#modal-confirm-pay").modal('hide');
            });
        };

        modalConfirm(async function(confirm){
            if(confirm){
                let totalCash = $('.total-cash').text()
                totalCash = totalCash.replace('$','')
                totalCash = totalCash.replace(/\./g,'')
                totalCash = parseFloat(totalCash)

                await @this.updateCash(totalCash)
                $('.payment-view').hide();
                $('.customer-view').hide();
            }
        });
    })
</script>
@endpush
