@php
$origen = json_encode($field['origen']);
$slug = json_encode($field['slug']);
@endphp

@push('after_scripts')
<script type="text/javascript">
    var origen = {!! $origen !!};
    var slug = {!! $slug !!};

    $(document).ready(function() {
        let nameField = $('input[name=' + origen + ']');
        let wasEmpty = nameField.val() === '';

        if(wasEmpty) {
            // TO DO
            // Refactor the callback into a separate function
            nameField.on('keyup', function(value) {
                $('input[name=' + slug + ']').val(nameField.val().toLowerCase().replace(/-+/g, '').replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, ''));
            })
        }
    });
</script>
@endpush
