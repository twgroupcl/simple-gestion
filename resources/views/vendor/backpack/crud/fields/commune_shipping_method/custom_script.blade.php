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
            } else {
                communeField.prop('disabled', false)
            }
            
            isGlobalField.change(function() {
                if (isGlobalValue.val() == 1) {
                    communeField.prop('disabled', true)
                } else {
                    communeField.prop('disabled', false)
                }
            })
        }

        $(document).ready(function() {
            removeButtonDel();
            removeButtonAddItem();
            disabledCommuneSelector();
        })

    </script>
@endpush
