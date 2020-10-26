@push('after_scripts')
<script type="text/javascript">

    $( document ).ready(function() {

        let productClassField = $("#product_class_id")
        let categoriesField = $("#categories")
        let inventoryCheck = $(".inventory_check")
        let serviceCheck = $(".service_check")

        let serviceField = $(".is_service_checkbox")
        let inventoryField = $(".is_inventory_checkbox")

        inventoryField.change( function() {
            if (inventoryCheck.prop('checked')) {
                serviceField.hide()
                serviceCheck.prop('checked', false)
                $('input[name="is_service"]').val(0)
            } else {
                serviceField.show();
            }
        })

        serviceField.change( function() {
            if (serviceCheck.prop('checked')) {
                inventoryField.hide()
                inventoryCheck.prop('checked', false)
                $('input[name="use_inventory_control"]').val(0)
            } else {
                inventoryField.show();
            }
        })

        categoriesField.change(function () {
            productClassField.val(null).trigger('change');
        })

    });

</script>
@endpush 