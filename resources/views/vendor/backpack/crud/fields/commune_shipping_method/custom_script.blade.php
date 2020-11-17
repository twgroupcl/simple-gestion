@push('after_scripts')
    <script>
        function removeButtonDel() {
            $('.delete-element').remove();
        }

        function removeButtonAddItem() {
            $('.add-repeatable-element-button').remove();
        }

        function disabledCommuneSelector() {
            let communeField =  $('#commune_id_selector');
            let isGlobalValue  = $('input[name="is_global"]');
            let isGlobalField  = $('.is_global_checker');

            if (isGlobalValue.val() == 1) {
                communeField.prop('disabled', true)
                communeField.val(null).trigger('change');
            } else {
                communeField.prop('disabled', false)
            }

            isGlobalField.change(function() {
                if (isGlobalValue.val() == 1) {
                    communeField.prop('disabled', true)
                    communeField.val(null).trigger('change');
                } else {
                    communeField.prop('disabled', false)
                }
            })
        }

        function showHideTab (tabName, fieldName, classFieldName) {
            let tab = $(`a[tab_name="${tabName}"]`)
            let val = $(`input[name="${fieldName}"]`)
            let checkField =  $(`.${classFieldName}`)

            if (val.val() == 1) {
                tab.show()
            } else {
                tab.hide()
            }

            checkField.change(function() {
                if (val.val() == 1) {
                    tab.show()
                } else {
                    tab.hide()
                }
            })
        }

        $(document).ready(function() {

            showHideTab('envio-gratis', 'free_shipping_status', 'free_shipping_checker');
            showHideTab('retiro-en-tienda', 'pickup_status', 'pickup_checker');
            showHideTab('tarifa-fija', 'flat_rate_status', 'flat_rate_checker');
            showHideTab('variable', 'variable_status', 'variable_checker');
            showHideTab('retiro-en-tienda', 'picking_status', 'picking_checker');
            showHideTab('chilexpress', 'chilexpress_status', 'chilexpress_checker');

            removeButtonDel();
            removeButtonAddItem();
            disabledCommuneSelector();
        })

    </script>
@endpush
