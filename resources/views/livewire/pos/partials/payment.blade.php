
<div class="col-md-11 col-12 payment-view" style="display: none;">
    <div class="row">
        <div class="col-12"><i class="la la-times-circle float-right close-pay-view" style="font-size: 32px;"></i></div>
    </div>
    @if (isset($customer))
        <div class="row  ">
            <div class='card text-left col-md-12 mb-1'>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="">
                            <div class="card-body p-1">

                                <h5 class="card-title"> {{ $customer->first_name }} {{ $customer->last_name }} <span class="float-right"> RUT:{{ $customer->uid }}</span></h5>
                                <p class="card-text"> {{ $customer->email }}</p>
                                {{-- <p class="card-text"> </p> --}}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12 card">
            <div class="row text-center mb-1">
                <div class="col-12">
                    @if(!is_null($paymentMethods))
                    <select id="payment-method-select" class="form-control w-100" >
                        {{-- <option value="1">Efectivo</option>
                        <option value="2">Transferencia</option> --}}
                        @foreach ($paymentMethods as $paymentMethod)
                            <option value="{{$paymentMethod['code']}}">{{$paymentMethod['title']}}</option>
                        @endforeach
                    </select>
                    @endif
                </div>
            </div>
            <div class="row" id="payment-extra-data" style="display: none;">
                <div class="col-4" >
                   {{--  <input type="text" id="uid-2" name="uid-2" class="form-control" placeholder="Nro Documento"> --}}
                </div>
                <div class="col-8">
                    <select id="bank" name="bank" class="form-control w-100" >
                        <option value="-1">Seleccione un banco</option>
                        @foreach($banks as $bank)
                            <option value="{{$bank->id}}">{{$bank->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card col-md-6 mb-1">
            <div class='card-body p-1'>
                <div class="row">
                    <div class="col-8 text-left">
                        <h4>Subtotal</h4>
                    </div>
                    <div class="col-4 text-danger text-right">
                        <h4><span class="subtotal-cart">{{ currencyFormat($subtotal ?? 0, 'CLP', true) }}</span></h4>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-8 text-left">
                        <h4>Impuestos</h4>
                    </div>
                    <div class="col-4 text-danger text-right">
                        <h4><span class="taxes-cart">{{ currencyFormat($taxes ?? 0, 'CLP', true) }}</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 text-left">
                        <h4>Total</h4>
                    </div>
                    <div class="col-4 text-danger text-right">
                        <h4><span class="total-cart">{{ currencyFormat($total ?? 0, 'CLP', true) }}</span></h4>
                    </div>
                </div>
                <div class="row border border-warning rounded" id="cash-div">
                    <div class="col-8  text-left">
                        <h4 id="payment-method-text">Efectivo</h4>
                    </div>
                    <div class="col-4 text-danger text-right">
                        <h4><span class="total-cash">$ 0</span></h4>
                    </div>
                </div>
                <div class="row" id="change-div">
                    <div class="col-8  text-left ">
                        <h4>Cambio</h4>
                    </div>
                    <div class="col-4 text-danger text-right">
                        <h4> <span class="total-change">$0</span></h4>
                    </div>
                </div>
                {{-- <div class="row" id="tip-input" style="display: none">
                    <div class="col-6  text-left ">
                        <span class="h4">Propina </span><span id="calculate-tip" style="display: none">(<a href="#">Click para canjear con el cambio</a> )</span>
                    </div>
                    <div class="col-6 text-danger text-right">
                        <h4><span class="total-tip">{{ currencyFormat(0, 'CLP', true) }}</span></h4>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="card col-md-6 mb-1">
            {{-- <div class='card-body'>
                <input class='input' id='display' disabled>
            </div> --}}
            <div class='card-body p-1'>
                <table class='table table-sm table-borderless' id="panel-calc" style="display:none;">
                    <tbody>
                        <tr class="text-center">
                            <td><a class='btn ' onclick='chr("7")'>7</a></td>
                            <td><a class='btn ' onclick='chr("8")'>8</a></td>
                            <td><a class='btn ' onclick='chr("9")'>9</a></td>
                        </tr>
                        <tr class="text-center">
                            <td><a class='btn ' onclick='chr("4")'>4</a></td>
                            <td><a class='btn ' onclick='chr("5")'>5</a></td>
                            <td><a class='btn ' onclick='chr("6")'>6</a></td>
                        </tr>
                        <tr class="text-center">
                            <td><a class='btn ' onclick='chr("1")'>1</a></td>
                            <td><a class='btn ' onclick='chr("2")'>2</a></td>
                            <td><a class='btn ' onclick='chr("3")'>3</a></td>
                        </tr>
                        <tr class="text-center">
                            <td><a class='btn ' onclick='chr("C")'>C</a></td>
                            <td><a class='btn ' onclick='chr("0")'>0</a></td>
                            <td><a class='btn ' onclick='chr("<<")'><i class="las la-backspace"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <input type="number"  min="0" class="w-100"  id="inputCash" value="0">
            </div>

            <div class='card-body p-1'>
                <select name="type_document_select" id="type_document_select" class="form-control form-control-lg">
                    <option value="39">Boleta electrónica </option>
                    <option value="33">Factura electrónica </option>
                </select>
            </div>

            @php
            $business_activities = App\Models\BusinessActivity::all()->sortBy('name');
            @endphp

            <div class='card-body p-1' id="business_activity_div" style="display: none">
                <select name="" id="business_activity_select" class="form-control form-control-lg">
                    @foreach ($business_activities as $activity)
                        <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class='card-body p-1'>
                <button class="btn btn-danger btn-block " id="confirm-pay" disabled>Confirmar pago
                </button>
            </div>
        </div>
    </div>
</div>

