@php
    $repeatable = $field['repeatable_field'];
    $amountField = $field['amount_field'];
@endphp
@include('crud::fields.inc.wrapper_start')
<label for="total_amounts"> Total detalle: </label>
<input id="total_amounts" class="form-control col-md-4" readonly name="total_amounts" />
@include('crud::fields.inc.wrapper_end')
@push('crud_fields_scripts')
<script src="{{asset('js/jquery-number.min.js')}}" > </script>

<script>
var amountFieldName = "{{$amountField}}";
function calculate() {
    var total = 0;
    amountFields = $('[data-repeatable-input-name="'+amountFieldName+'"]')
    amountFields.each(function (index){
        total += parseDecimal(this.value)

    })
    var totalField = $('#total_amounts');
    //totalField.val(total)
    totalField.val(formatNumber(total))
}

function parseDecimal(number) {
    if (number == '') {
        return 0
    }
    number = number.toString()
    number = number.replaceAll('.', '')
    number = number.replace(',', '.')
    return parseFloat(number);
}
function formatNumber(number) {
        return $.number(number, 0, ',', '.');
}

function setOnChangeAmounts() {
    amountFields = $('[data-repeatable-input-name="'+amountFieldName+'"]')
    amountFields.each(function (index) {
            $(this).number(true, 0, ',', '.')
        $(this).on('change', function() {
            calculate()
         })
    })
}

$(document).ready(function() {

    var repeatable = "{{$repeatable}}";

    const observerOptions = {
        attributes: true,
        childList: true,
        subtree: true,
        characterData: false,
        attributeOldValue: false,
        characterDataOldValue: false
    };

    setOnChangeAmounts();
    calculate();
    const repeatableList = document.querySelector('.container-repeatable-elements');
    const observer = new MutationObserver((mutationList) => {
        mutationList.forEach((mutation) => {
            calculate();
            setOnChangeAmounts();
        })
     })
     observer.observe(repeatableList, observerOptions);

})
</script>
@endpush
