@include('crud::fields.inc.wrapper_start')
    <div class="form-group" element="div">
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
@include('crud::fields.inc.wrapper_end')

@push('crud_fields_scripts')
<script>
    $(function(){

        //$('.delete-element').hide();

        $('body').on('change','.select-payment-method',function(){
            let value = $(this).val();
            $('.input-payment').addClass('d-none');

            switch(value){
                case 'EF':
                    $('.input-ef').removeClass('d-none')
                break;
                case 'CH':
                    $('.input-ch').removeClass('d-none')                    
                break;
                case 'CF':
                    $('.input-ch').removeClass('d-none')                    
                break;
                case 'TC':
                    $('.input-tc').removeClass('d-none')                    
                break;
                case 'TD':
                    $('.input-tc').removeClass('d-none')                    
                break;
                case 'TR':
                    $('.input-tr').removeClass('d-none')                    
                break;
                case 'PCC':
                    $('.input-pcc').removeClass('d-none')                    
                break;
                case 'OT':
                    $('.input-ef').removeClass('d-none')                    
                break;
            }
        })
    });

</script>
@endpush