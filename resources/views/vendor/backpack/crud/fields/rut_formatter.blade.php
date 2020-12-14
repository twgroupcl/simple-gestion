@php
$rutFields = json_encode($field['rut_fields']);
$foreignCheckField = isset($field['foreign_check_field']) ? $field['foreign_check_field'] : null; 
@endphp

@push('crud_fields_scripts')
<script src="{{ asset('js/rut-formatter.js') }}"></script>

<script type="text/javascript">
    var rutFields = {!! $rutFields !!};

    $(document).ready(function(){

        @if ($foreignCheckField)

        var foreignCheckField = $('.{{ $foreignCheckField }}') 

        console.log(foreignCheckField);
        @endif



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
        });

        rutFields.forEach(nameField => {
            $('*[name="'+nameField+'"]').rut();
        });
    })
</script>
@endpush

