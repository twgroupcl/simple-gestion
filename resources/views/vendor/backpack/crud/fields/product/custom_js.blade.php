@push('after_scripts')
<script type="text/javascript">

    $( document ).ready(function() {

        let productClassField = $("#product_class_id")
        let categoriesField = $("#categories")
        
        categoriesField.change(function () {
            productClassField.val(null).trigger('change');
        })

    });

</script>
@endpush 