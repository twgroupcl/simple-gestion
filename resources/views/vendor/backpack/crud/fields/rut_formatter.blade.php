@php
$rutFields = json_encode($field['rut_fields']);
@endphp
@push('crud_fields_scripts')

<script src="{{ asset('js/rut-formatter.js') }}"></script>

<script>
var rutFields = {!! $rutFields !!};
$(document).ready(function(){
    var observer = new MutationObserver(function(mutations, observer) {
        rutFields.forEach(nameField => {
            if ($('*[data-repeatable-input-name="'+nameField+'"]').length > 0)
                $('*[data-repeatable-input-name="'+nameField+'"]').rut();
        });    
    });
    document.querySelectorAll('.container-repeatable-elements').forEach(repeatable => {
        observer.observe(repeatable, {
            subtree: true,
            attributes: true,
        });
    })
    rutFields.forEach(nameField => {
        $('*[name="'+nameField+'"]').rut();
    });
})
</script>

@endpush

