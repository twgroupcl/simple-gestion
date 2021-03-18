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
                    <div>
                        <span class="text-muted">$</span>
                        <span id="subtotal-card" class="text-muted subtotal">0</span>
                    </div>
                    <input type="hidden" name="sub_total">
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div class="col-md-4 pl-0">
                        <h6 class="mt-2">Descuento global</h6>
                    </div>
                    <div class="input-group mb-6 pr-0">
                        <input type="text" 
                        value="{{ old('discount_amount_field') ?? ( isset($entry) ? ($entry->discount_percent > 0 ? number_format($entry->discount_percent, 2, ',', '') : number_format($entry->discount_amount, 2, ',', '')) : 0 ) }}" 
                        class="form-control format-number" 
                        aria-label="Descuento" 
                        name="discount_amount_field">
                        <div class="input-group-append">
                            <select class="form-control" name="discount_type">
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
                        <h6 class="my-0">Descuento global</h6>
                    </div>
                    <div>
                        <span class="text-muted">-$</span>
                        <span id="total-discount-field" class="text-muted">0</span>
                    </div>
                </li> 
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Neto</h6>
                    </div>
                    <div>
                        <span class="text-muted">$</span>
                        <span id="net-card" class="text-muted net">0</span>
                    </div>
                    <input type="hidden" name="net">
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Impuestos adicionales</h6>
                    </div>
                    <div>
                        <span class="text-muted">$</span>
                        <span id="total-tax-additional" class="text-muted">$0</span>
                    </div>
                    <input type="hidden" name="tax_specific">
                </li> 
                <li id="iva-container" class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">IVA (19%)</h6>
                    </div>
                    <div>
                        <span class="text-muted">$</span>
                        <span id="amount-tax-field" class="text-muted">$0</span>
                    </div>
                    <input type="hidden" name="tax_amount">
                </li> 
                <li id="retencion-container" class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Retención (10.75%)</h6>
                    </div>
                    <div>
                        <span class="text-muted">-$</span>
                        <span id="retencion-field" class="text-muted retencion">0</span>
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
        var invoiceType = '';

        function getCodeDTE(id) {
            if (id.length <= 0) {
                return;
            }

            /* var code = '';
            $.ajax({
                url: '/admin/invoice-type/' + id + '/get-code',
                async: false,
                success: function (response) {
                    code = response;
                }
            });

            return code; */

            var type = invoiceTypeArray.filter( item => {
                return item.id == id
            })

            if (type.length === 0) return;

            return type[0]['code'].toString();
        }

        function getTaxValue() {
            switch (invoiceType){
                case '33':
                case '39':
                    return 19;
                    break;
                case 'H':
                    return 10.75;
                    break;
                default:
                    return 0;
                    break;
            }
        }

        function calculateGeneralTax(itemPrice, itemQty, itemDiscount) {
            let itemSubtotal = (itemQty * itemPrice) - itemDiscount
            switch (invoiceType) {
                case '33':
                case '39':
                    return itemSubtotal * 19 / 100;
                    break;
                case 'H':
                    return 10.75 * itemSubtotal / 100 * (-1);
                    break;
                default:
                    return 0;
                    break;
            }
        }

        function isExent()
        {
            return invoiceType !== '33' && invoiceType !== '39';
        }
    
        function calculateAndSetTaxItem(item, itemPrice, itemQty, itemDiscount) {
            let itemSubtotal = (itemQty * itemPrice) - itemDiscount

            let taxAmountField = item.find('.tax_amount_item')
            let taxIdField = item.find('.tax_id_field')
            let taxPercentField = item.find('.tax_percent_item')
            let taxTotalField = item.find('.tax_total_item')

            if  (taxIdField.val() == 0 || isExent()) { 
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
            let itemSubTotal = itemQty * itemPrice

            let itemDiscount = 0
            let totalDiscount = 0

            let discountType = item.find('.discount_type').val()
            let discountValue = parseDecimal(item.find('input[data-repeatable-input-name="discount"]').val())

            // Item discount
            if (discountType == 'amount') {
                itemDiscount = discountValue
            } else if (discountType == 'percentage') {
                itemDiscount = (itemPrice * discountValue / 100) * itemQty
            }

            // Global discount after item discount
            let globalDiscount = calculateGlobalDiscount(itemSubTotal - itemDiscount)
            totalDiscount = itemDiscount + globalDiscount

            return {
                itemDiscount,
                globalDiscount,
            }
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

        function setDiscountFields(globalDiscount) {
            let discountType = $('select[name="discount_type"]').val()
            let discountValue = parseDecimal($('input[name="discount_amount_field"]').val())
            let totalDiscount = 0
        
            if (discountType == 'percentage') {
                $('input[name="discount_percent"]').val(discountValue)
                $('input[name="discount_amount"]').val(globalDiscount)
            } else {
                $('input[name="discount_amount"]').val(globalDiscount)
                $('input[name="discount_percent"]').val(0)
            }

            globalDiscount 
            document.querySelector('#total-discount-field').innerText = formatWithComma(globalDiscount)
            //$('input[name="discount_amount"]').val(globalDiscount)
        }

        function calculateItemsData(items) {
            let subTotalGeneral = 0
            let totalDiscountItems = 0
            let totalDiscountGlobal = 0
            let totalVaxItem = 0
            let totalVaxGeneral = 0
            let acumTotalValue = 0

            $(items).each( function() {
                let price = parseDecimal($(this).find('.price').val());
                let discountItem = calculateItemDiscount($(this)).itemDiscount;
                let discountGlobal = calculateItemDiscount($(this)).globalDiscount;
                let itemQty = Number($(this).find('.qty').val());
                let subTotal = $(this).find('.subtotal');
                let isExempt = $(this).find('.ind_exe').val() == 0 ? false : true;
                let taxAmount = 0;
                let taxAmountGeneral = 0;

                // check exe_ind in row item
                if (!isExempt) {
                    taxAmount = calculateAndSetTaxItem($(this), price, itemQty, discountItem + discountGlobal)
                    taxAmountGeneral = calculateGeneralTax(price, itemQty, discountItem + discountGlobal)
                } 
                
                let subTotalValue = (price * itemQty) 
                let totalValue = getRounded(( (price * itemQty) - discountItem))
                
                subTotal.val(formatWithComma(totalValue))

                subTotalGeneral += subTotalValue
                acumTotalValue += totalValue
                totalDiscountItems+= discountItem
                totalDiscountGlobal += discountGlobal
                totalVaxItem += taxAmount
                totalVaxGeneral += taxAmountGeneral
            })

            return {
                totalValue: acumTotalValue,
                subTotalGeneral,
                totalDiscountItems,
                totalVaxItem,
                totalVaxGeneral,
                totalDiscountGlobal,
            }
        }


        function calculateTotals() {
            invoiceType = getCodeDTE($('select[name="invoice_type_id"]').val());
            let items = $('div[data-repeatable-holder="items_data"]').children()
            let itemsData = calculateItemsData(items)

            let subTotalGeneral = getRounded(itemsData.totalValue)
            
            let totalDiscountGlobal = getRounded(itemsData.totalDiscountGlobal)
            let totalVaxItems = getRounded(itemsData.totalVaxItem)
            let totalVaxGeneral = getRounded(itemsData.totalVaxGeneral)

            //TODO show or hide 
            if (invoiceType === 'H') { //TO DO Honorarios??
                $('input[name="tax_amount"]').val( (-1) * totalVaxGeneral)
                document.querySelector('#retencion-field').innerText = formatWithComma((-1) * totalVaxGeneral);
                document.querySelector('#amount-tax-field').innerText = 0
                $('#iva-container').removeClass('d-flex')
                $('#iva-container').hide()
                $('#retencion-container').addClass('d-flex')
                $('#retencion-container').show()
            } else if (!isExent()){ 
                $('input[name="tax_amount"]').val(totalVaxGeneral)
                document.querySelector('#amount-tax-field').innerText = formatWithComma(totalVaxGeneral);
                document.querySelector('#retencion-field').innerText = 0
                $('#retencion-container').removeClass('d-flex')
                $('#retencion-container').hide()
                $('#iva-container').addClass('d-flex')
                $('#iva-container').show()
            } else {
                $('input[name="tax_amount"]').val(0)
                $('#retencion-container').removeClass('d-flex')
                $('#retencion-container').hide()
                $('#iva-container').removeClass('d-flex')
                $('#iva-container').hide()
            }

            let net = subTotalGeneral - totalDiscountGlobal
            let total = subTotalGeneral - totalDiscountGlobal + totalVaxItems + totalVaxGeneral

            setDiscountFields(totalDiscountGlobal)

            $('input[name="tax_specific"]').val(totalVaxItems)
            document.querySelector('#total-tax-additional').innerText = formatWithComma(totalVaxItems);

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
            number = number.replaceAll('.', '')
            number = number.replace(',', '.')
            return parseFloat(number);
        }


        // PENDING TEST THIS
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

        function getRounded(value) {
            var result = parseFloat(value);
            result = Math.round(result);
            return result;
        }

        function getTruncated(value) {
            var result = parseFloat(value);
            result = Math.trunc(result);
            return result;
        }

        function checkTypeTax() {
            
            switch (invoiceType){
                case '33':
                case 'H':
                console.log('33')
                    disableItemTaxFields(false)
                    disableGlobalDiscountField(false)
                    break;
                case '39':
                case '41':
                console.log('41')
                    disableItemTaxFields(true)
                    disableGlobalDiscountField(true)
                    break;
                default:
                console.log('default')
                    disableItemTaxFields(true)
                    disableGlobalDiscountField(false)
                    break;
            }
        }


        function checkGiroField() {
            let giroField = $('select[name="business_activity_id"]');
            if (invoiceType == 39 || invoiceType == 41) {
                giroField.val(0).trigger('change');
                giroField.prop('disabled', true);
            } else {
                giroField.prop('disabled', false);
            }
        }

        function disableItemTaxFields (status) {
            $('select[data-repeatable-input-name="additional_tax_id"]').each(function () {
                if ($(this).prop('disabled') == status ) {
                    return;
                }

                $(this).val(0).trigger('change');
                $(this).prop('disabled', status);
            })
        }

        function disableGlobalDiscountField (status) {
            if ($('input[name="discount_amount_field"]').prop('readonly') == status ) {
                return 0
            }

            $('input[name="discount_amount"]').val(0)
            $('input[name="discount_percent"]').val(0)
            $('input[name="discount_amount_field"]').val(0);
            document.querySelector('#total-discount-field').innerText = 0

            $('input[name="discount_amount_field"]').prop('readonly', status)
        }


        /**********************************************
        *  
        * Event listeners
        *
        ***********************************************/
        $(document).on('click', '.add-repeatable-element-button', function () {
            checkTypeTax();
            invoiceType = getCodeDTE($('select[name="invoice_type_id"]').val());
            setItemsExempts();
        })

        function setItemsExempts() {
            let exempts = $('[data-repeatable-input-name="ind_exe"]');
            exempts.each((index, elem) => {
                if (invoiceType == 34) {
                    $(elem).val(1)

                } else {
                    $(elem).val(0)
                }
            })
        }

        $(document).on('change', 'select[name="invoice_type_id"]', function () {
            invoiceType = getCodeDTE($('select[name="invoice_type_id"]').val());
            setItemsExempts();
            calculateTotals();
            checkGiroField();
            checkTypeTax()
        });
    
        $(document).on('keyup', 'input[data-repeatable-input-name="qty"]', function () {
            calculateTotals();
        });

        $(document).on('blur', 'input[data-repeatable-input-name="qty"]', function () {
            calculateTotals();
        });

        $(document).on('blur', 'input[data-repeatable-input-name="discount"]', function (event) {
            let field = $(event.target);
            let type = field.parent().find('.discount_type').val()
            if (field.val() > 100 && type == 'percentage') {
                field.val(100);
            }
            calculateTotals();
        });

        $(document).on('keyup', 'input[data-repeatable-input-name="price"]', function () {
            let removeDots = $(this).val().replace(/\./g, ',')
            $(this).val(removeDots)
            calculateTotals();
        });

        $(document).on('click', 'button', function () {
            calculateTotals();
        });

        $(document).on('keyup', 'input[data-repeatable-input-name="discount"]', function () {
            let removeDots = $(this).val().replace(/\./g, ',')
            $(this).val(removeDots)
            calculateTotals();
        });

        $(document).on('keyup', 'input[name="discount_amount_field"]', function () {
            let removeDots = $(this).val().replace(/\./g, ',')
            if (removeDots > 100) {
                $(this).val(100)    
            } else {
                $(this).val(removeDots)
            }
            calculateTotals();
        });

        $(document).on('change', 'select[name="discount_type"]', function () {
            calculateTotals();
        });

        $(document).on('change', 'select[data-repeatable-input-name="additional_tax_id"]', function () {
            calculateTotals();
        });

        $(document).on('change', 'select[data-repeatable-input-name="discount_type"]', function () {
            let field = $(event.target);
            let amount = field.parent().parent().find('input[data-repeatable-input-name="discount"]')
            if (amount.val() > 100 && field.val() == 'percentage') {
                amount.val(100)
            }
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

            var currentPrice = parseFloat($(this).select2('data')[0].price);
            var iva = 19 * currentPrice / 119 
            currentPrice = parseFloat(currentPrice - iva).toFixed(0)
            
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
            checkGiroField();
            checkTypeTax();
        })

    </script> 
@endpush

@push('after_styles')
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
@endpush
