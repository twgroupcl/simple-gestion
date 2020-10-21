@push('after_scripts')
<script type="text/javascript">

    $( document ).ready(function() {

        let typeAttribute = $("select[name=type_attribute]");
        let optionsField = $("#optionsItems");

        if(typeAttribute.val() == 'select') optionsField.show()

        typeAttribute.change(function() {
            if(typeAttribute.val() == 'select') {
                optionsField.show()
            } else {
                optionsField.hide()
            }              
        })

    });
</script>
@endpush 