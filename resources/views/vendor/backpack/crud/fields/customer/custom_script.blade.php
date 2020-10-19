@push('after_scripts')
<script>
    is_company_group = $('input[name="is_company"]').parent();

    function changeInputs(target) {
        if(target.find('input[name="is_company"]').val() == 1){
            $('input[name="last_name"]').val('');
            $('input[name="last_name"]').attr('disabled', 'disabled');

            // nombre/razón social
            $('input[name="first_name"]').parent().find('label').text('Razón social')

            // activities
            $('a[aria-controls="tab_actividades-comerciales"]').fadeIn();
        }else{
            $('input[name="last_name"]').removeAttr('disabled');

            // nombre/razón social
            $('input[name="first_name"]').parent().find('label').text('Nombre')

            // activities
            $('a[aria-controls="tab_actividades-comerciales"]').hide();
        }
    }

    is_company_group.parent().change(function(){
        changeInputs($(this))
    });

    $(document).ready(function() {
        changeInputs(is_company_group)
    })
</script>
@endpush
