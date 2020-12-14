@push('after_scripts')
<script>

    function removeEventListeners(elementId) {
        var el = document.getElementById(elementId),
        elClone = el.cloneNode(true);
        el.parentNode.replaceChild(elClone, el);
    }

    var foreignCheck = $('.is_foreign_checkbox')
    var foreignField = $('.is_foreing_field')

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

        if (foreignCheck.prop('checked')) {
            removeEventListeners('rut_field')
        } else {
            $('*[name="uid"]').rut();
        }

        foreignField.change( function() {
            if (foreignCheck.prop('checked')) {
                removeEventListeners('rut_field')
            } else {
                $('*[name="uid"]').rut();
            }
        })



    })
</script>
@endpush
