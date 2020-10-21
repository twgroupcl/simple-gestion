@push('after_scripts')
<script type="text/javascript">

    const PRODUCT_TYPE_CONFIGURABLE = 2

    $( document ).ready(function() {

        showHideSuperAttributesField()
    });

    function showHideSuperAttributesField() {
        let superAttributes = $("#super_attributes")
        let superAttributesWrapper = $('#super_attributes_wrapper')
        let productType = $("select[name=product_type_id]")

        if(productType.val() == PRODUCT_TYPE_CONFIGURABLE) {
            superAttributesWrapper.show()
        } else {
            superAttributesWrapper.hide()
            superAttributes.val(null).trigger('change');
        }
        
        productType.change(function() {
            if(productType.val() == PRODUCT_TYPE_CONFIGURABLE) {
                superAttributesWrapper.show()
            } else {
                superAttributesWrapper.hide()
                superAttributes.val(null).trigger('change');
            }
        })
    }


</script>
@endpush 