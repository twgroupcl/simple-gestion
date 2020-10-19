@php
    $checkbox = $field['checkbox'];
    $fields = json_encode($field['fields']);
@endphp

@push('crud_fields_scripts')
<script type="text/javascript">
    var checkbox = '{{$checkbox}}';
    var fields = {!! $fields !!};

    $(document).ready(function(){
        checkbox = $('input[name="'+checkbox+'"]')
        checkbox.parent().change(function(){
            fields.forEach(nameField => {
                readonly(nameField,checkbox.val())
            });
        })

        fields.forEach(nameField => {
            readonly(nameField,checkbox.val())
        });
    })

    readonly = (nameField, value) => {
        if(value == 0) {
            $('*[name="'+nameField+'"]').prop('disable', true).prop('readonly', true);
        } else {
            $('*[name="'+nameField+'"]').prop('disable', false).prop('readonly', false);
        }
    }
</script>
@endpush

