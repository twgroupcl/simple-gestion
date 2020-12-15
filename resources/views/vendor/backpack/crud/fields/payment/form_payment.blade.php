@include('crud::fields.inc.wrapper_start')
    <div class="card mb-6" style="padding: 10px;">
        <div class="order-md-2 mb-6">
            <p class="text-muted h5">Formulario de Pagos</p>
            <form name="form-payment" method="POST" >
                <div class="form-group col-md-6">
                    <label for="">Método de pago</label>
                    <select name="payment_method" class="select-payment-method form-control">
                        <option value="">Seleccione</option>
                        <option value="EF">Efectivo</option>
                        <option value="CH">Cheque</option>
                        <option value="CF">Cheque a Fecha</option>
                        <option value="TC">Tarjeta de crédito</option>
                        <option value="TD">Tarjeta de débito</option>
                        <option value="TR">Tranferencia</option>
                        <option value="PCC">Pago a cuenta corriente</option>
                        <option value="OT">Otro</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Banco</label>
                    <select name="payment_method" class="select-payment-method form-control">
                        <option value="">Seleccione</option>
                        @foreach($field['dataBank'] as $bank)
                            <option value="{{$bank->id}}">{{$bank->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Monto</label>
                    <input type="number" name="amount_payment" class="form-control">
                </div>
                <button type="submit" class="btn-primary">Guardar</button>
            </form>
        </div>
    </div>
@include('crud::fields.inc.wrapper_end')
