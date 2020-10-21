@include('crud::fields.inc.wrapper_start')
    <div class="card mb-6" style="padding: 10px;">
        <div class="col-md-12 order-md-2 mb-6">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Totales</span>
                <span class="badge badge-secondary badge-pill total-items"></span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Subtotal base</h6>
                    </div>
                    <span id="subtotal-card" class="text-muted subtotal">$0</span>
                    <input type="hidden" name="sub_total">
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div class="col-md-4 pl-0">
                        <h6 class="mt-2">Descuento</h6>
                    </div>
                    <div class="input-group mb-6 pr-0">
                        <input type="text" 
                        value="{{ old('discount_amount_field') ?? ( isset($entry) ? ($entry->discount_percent > 0 ? number_format($entry->discount_percent, 2, ',', '') : number_format($entry->discount_amount, 2, ',', '')) : 0 ) }}" 
                        class="form-control format-number" 
                        aria-label="Descuento" 
                        name="discount_amount_field">
                        <div class="input-group-append">
                            <select class="form-control" name="discount_type">
                                <option value="amount" {{ isset($entry) && $entry->discount_type == 'amount' ? 'selected' : '' }}>$</option>
                                <option value="percentage" {{ isset($entry) && ($entry->discount_percent > 1) ? 'selected' : '' }}>%</option>
                            </select>
                        </div>
                        <div class="col-md-12 pr-0 pt-2">
                            <span class="text-muted float-right discount-total" style="display: none;"></span>
                            <input type="hidden" name="discount_total">
                            <input type="hidden" name="discount_amount">
                            <input type="hidden" name="discount_percent">
                        </div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Descuento total</h6>
                    </div>
                    <span id="total-discount-field" class="text-muted">$0</span>
                </li> 
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Neto</h6>
                    </div>
                    <span id="net-card" class="text-muted net">$0</span>
                    <input type="hidden" name="net">
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Impuestos</h6>
                    </div>
                    <span id="total-tax-field" class="text-muted">$0</span>
                </li> 
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div class="col-md-4 pl-0">
                        <h6 class="mt-2">% Retencion</h6>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="input-group mb-6 pr-0">
                        <input type="text" 
                        value="" 
                        class="form-control format-number" 
                        aria-label="Descuento" 
                        name="retencion">
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong id="total-card" class="total">$0</strong>
                    <input type="hidden" name="total">
                </li>
            </ul>
        </div>
    </div>
</div>

@push('after_scripts')
    <script>


        function calculateAndSetTaxItem(item, itemPrice, itemQty, itemDiscount) {
            let itemSubtotal = (itemQty * itemPrice) - itemDiscount

            let taxAmountField = item.find('.tax_amount_item')
            let taxIdField = item.find('.tax_id_field')
            let taxPercentField = item.find('.tax_percent_item')
            let taxTotalField = item.find('.tax_total_item')

            if  (taxIdField.val() == 0) { 
                taxPercentField.val(0)
                taxAmountField.val(0)
                taxTotalField.val(0)
                return 0
            }

            let taxPercent = taxIdField.select2('data')[0]['text'].split('%')[0]

            taxPercentField.val(taxPercent)
            taxAmountField.val(itemSubtotal * taxPercent / 100)
            taxTotalField.val(itemSubtotal * taxPercent / 100)

            return itemSubtotal * taxPercent / 100
        }

        function calculateItemDiscount(item) {
            let itemPrice = parseDecimal(item.find('.price').val())
            let itemQty = Number(item.find('.qty').val())

            let discountType = item.find('.discount_type').val()
            let discountValue = parseDecimal(item.find('input[data-repeatable-input-name="discount"]').val())
            let discount = 0

            if (discountType == 'amount') {
                discount = discountValue
            } else if (discountType == 'percentage') {
                discount = (itemPrice * discountValue / 100) * itemQty
            }

            return Number(discount)
        }

        function calculateGlobalDiscount(subtotal) {
            let discount = 0
            let discountValue = parseDecimal($('input[name="discount_amount_field"]').val())
            let discountType = $('select[name="discount_type"]').val()

            if (discountType == 'amount') {
                discount = Number(discountValue)

            } else if (discountType == 'percentage') {
                discount = Number(subtotal * discountValue / 100)
            }

            return discount
        }

        function setDiscountFields(globalDiscount, totalDiscountItems) {
            let discountType = $('select[name="discount_type"]').val()
            let discountValue = parseDecimal($('input[name="discount_amount_field"]').val())
            let totalDiscount = 0
        
            if (discountType == 'percentage') {
                $('input[name="discount_percent"]').val(discountValue)
                $('input[name="discount_amount"]').val(0)
            } else {
                $('input[name="discount_amount"]').val(globalDiscount)
                $('input[name="discount_percent"]').val(0)
            }

            totalDiscount = globalDiscount + totalDiscountItems
            document.querySelector('#total-discount-field').innerText = formatWithComma(totalDiscount)
            $('input[name="discount_total"]').val(totalDiscount)
        }

        function calculateItemsData(items) {
            let subTotalGeneral = 0
            let totalDiscountItems = 0
            let totalVax = 0

            $(items).each( function() {
                let price = parseDecimal($(this).find('.price').val())
                let discountAmount = calculateItemDiscount($(this))
                let itemQty = Number($(this).find('.qty').val())
                let subTotal = $(this).find('.subtotal')

                let taxAmount = calculateAndSetTaxItem($(this), price, itemQty, discountAmount)
                let subTotalValue = (price * itemQty) 
                let totalValue = ( (price * itemQty) - discountAmount) + taxAmount
                
                subTotal.val(formatWithComma(totalValue))

                subTotalGeneral += subTotalValue
                totalDiscountItems+= discountAmount
                totalVax += taxAmount
            })

            return {
                subTotalGeneral,
                totalDiscountItems,
                totalVax,
            }
        }


        function calculateTotals() {

            let items = $('div[data-repeatable-holder="quotation_items_json"]').children()

            let subTotalGeneral = calculateItemsData(items).subTotalGeneral
            let totalDiscountItems = calculateItemsData(items).totalDiscountItems
            let totalVaxItems = calculateItemsData(items).totalVax

            let globalDiscount = calculateGlobalDiscount(subTotalGeneral)

            let net = subTotalGeneral - globalDiscount - totalDiscountItems
            let total = subTotalGeneral - globalDiscount - totalDiscountItems + totalVaxItems

            setDiscountFields(globalDiscount, totalDiscountItems)

            document.querySelector('#total-tax-field').innerText = formatWithComma(totalVaxItems);

            $('input[name="sub_total"]').val(subTotalGeneral)
            document.querySelector('#subtotal-card').innerText = !isNaN(subTotalGeneral) ? formatWithComma(subTotalGeneral) : 0;

            $('input[name="net"]').val(net)
            document.querySelector('#net-card').innerText = !isNaN(net) ? formatWithComma(net) : 0;

            $('input[name="total"]').val(total)
            document.querySelector('#total-card').innerText = !isNaN(total) ? formatWithComma(total) : 0; 
        }



        /**********************************************
        *  
        * Functions to format and transform numbers
        *
        ***********************************************/

        function parseDecimal(number) {
            if (number == '') {
                return 0
            }
            number = number.toString()
            number = number.replace(',', '.')
            return parseFloat(number);
        }

        function formatWithComma(number) {
            if (typeof number == 'number') {
                number = parseFloat(number).toFixed(2);
            }
            number = number.toString()
            number = number.replace('.', ',')
            return number;
        }




        /**********************************************
        *  
        * Event listeners
        *
        ***********************************************/


        $(document).on('keyup', 'input[data-repeatable-input-name="qty"]', function () {
            calculateTotals();
        });

        $(document).on('keyup', 'input[data-repeatable-input-name="price"]', function () {
            let removeDots = $(this).val().replace(/\./g, ',')
            $(this).val(removeDots)
            calculateTotals();
        });

        $(document).on('keyup', 'input[data-repeatable-input-name="discount"]', function () {
            calculateTotals();
        });

        $(document).on('keyup', 'input[name="discount_amount_field"]', function () {
            calculateTotals();
        });

        $(document).on('change', 'select[name="discount_type"]', function () {
            calculateTotals();
        });

        $(document).on('change', 'select[data-repeatable-input-name="tax_id"]', function () {
            calculateTotals();
        });

        $(document).on('change', 'select[data-repeatable-input-name="discount_type"]', function () {
            calculateTotals();
        });

        $(document).on('select2:clear', 'select[data-repeatable-input-name="product_id"]', function () {
            // Clean fields if there is not product selected
           if ($(this).select2('data')[0] == undefined) {
                $(this).parent().parent().find('.price').val('');
                $(this).parent().parent().find('.qty').val(0);
                $(this).parent().parent().find('.product-name-field').val('');
                return;
            }
        })
    
        $(document).on('change', 'select[data-repeatable-input-name="product_id"]', function () {
            
           if ($(this).select2('data')[0] == undefined) {
                return;
            }

            // Set current product name on the field
            var currentName = $(this).select2('data')[0].text;
            $(this).parent().parent().find('.product-name-field').val(currentName);

            if ($(this).select2('data')[0].price == undefined) {
                return;
            }

            // Format price of the product
            var priceWithTwoDigits = parseFloat($(this).select2('data')[0].price).toFixed(2);
            var currentPrice = formatWithComma(priceWithTwoDigits);
            
            // Set price and qty 
            $(this).parent().parent().find('.price').val(currentPrice);
            $(this).parent().parent().find('.qty').val(1);
            
            // Trigger change
            $(this).parent().parent().find('.price').trigger('change');
            $(this).parent().parent().find('.qty').trigger('change');

            calculateTotals();
        });

        $(document).ready( function() {
            calculateTotals();
        })

    </script> 
@endpush
