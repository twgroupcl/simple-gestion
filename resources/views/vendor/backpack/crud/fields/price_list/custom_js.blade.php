@push('after_scripts')
<script>

    let surchargeInput = $('#surcharge_percentage')
    let discountInput = $('#discount_percentage')
    let initialPriceCostRadio = $('input[name="initial_price_cost"]')
    let radio = $('input[type="radio"]')

    if (initialPriceCostRadio.val() === 'actual_price') {
        surchargeInput.hide()
        discountInput.hide()
    } else if (initialPriceCostRadio.val() === 'price_with_surcharge') {
        surchargeInput.show()
        discountInput.hide()
    } else if (initialPriceCostRadio.val() === 'price_with_discount') {
        surchargeInput.hide()
        discountInput.show()
    }

    radio.click(function (el) {
        let value = el.currentTarget.value
        if (value === 'actual_price') {
            surchargeInput.hide()
            discountInput.hide()
        } else if (value === 'price_with_surcharge') {
            surchargeInput.show()
            discountInput.hide()
        } else if (value === 'price_with_discount') {
            surchargeInput.hide()
            discountInput.show()
        }
    })
</script>
@endpush