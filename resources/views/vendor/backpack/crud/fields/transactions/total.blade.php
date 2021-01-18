@php
    $repeatable = $field['repeatable_field'];
    $amountField = $field['amount_field'];
@endphp
@include('crud::fields.inc.wrapper_start')
<label for="total_amounts"> Total: </label>
<input id="total_amounts" class="form-group" name="total_amounts" />
@include('crud::fields.inc.wrapper_end')
@push('crud_fields_scripts')
<!--<script src="{{asset('js/jquery-number.min.js')}}" >-->

<script>
var amountFieldName = "{{$amountField}}";
function showSelect(select, value, expected) {
    if (value == expected) {
        select.next(".select2-container").show();
        select.parent().find('label').show();
    } else {
        select.next(".select2-container").hide();
        select.parent().find('label').hide();
    }
}

function calculate() {
    amountFields = $('[data-repeatable-input-name="'+amountFieldName+'"]')
    var total = 0;
    amountFields.each(function (index){
        if (this.value == "" || isNaN(this.value)) {
            $(this).val(0)
        }
        total += parseDecimal(this.value)

    })
    var totalField = $('#total_amounts');
    //totalField.val(total)
    totalField.val(formatWithComma(total))
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

function formatWithComma(number) {
    if (typeof number == 'number') {
        number = parseFloat(number).toFixed(2);
    }

    number = parseFloat(number).toFixed(0)
    //number = number.toString()
    number = number.replace('.', ',')
    number = number.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return number;
}

function setOnChangeAmounts() {
    amountFields = $('[data-repeatable-input-name="'+amountFieldName+'"]')
    amountFields.each(function (index) {
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
