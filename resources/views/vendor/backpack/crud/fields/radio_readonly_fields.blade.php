@php
$readonlyFields = json_encode($field['readonly_fields'],true);
$isValue = json_encode($field['is_value']);
$radioButtonName = $field['radiobutton_name'];
@endphp

@push('crud_fields_scripts')
@include('crud::fields.readonly_fields_functions')

<script type="text/javascript">
    var readonlyFields = {!! $readonlyFields !!};
    var isValue = {!! $isValue !!}
    var radioButtonName = '{{$radioButtonName}}';

    $('input[type="radio"]').change( (event) => {
        // if is checked
        if (event.currentTarget.checked) {
            // get id and label
            radioButtonId = event.currentTarget.getAttribute('id');
            valueSelected = $('label[for="'+radioButtonId+'"]').text()
            // if label text exist in isValue array
            if (isValue.includes(valueSelected)) {
                setFieldsToReadonly(readonlyFields,true)
            } else {
                setFieldsToReadonly(readonlyFields,false)
            }
        }
    })
    
    // if status is true -> fields readonly, also remove attr readonly
    setFieldsToReadonly = (elements, status) => {
        Object.entries(readonlyFields).forEach(array => {
            const [fieldType, fields] = array;
            if (fieldType === 'textarea') {
                fields.some((element) => {
                    status ? textareas($('textarea[name="'+element+'"]')) : $('textarea[name="'+element+'"]').removeAttr('readonly')
                })
            } else if (fieldType === 'input') {
                fields.some((element) => {
                    status ? simpleInput($('input[name="'+element+'"]')) : $('input[name="'+element+'"]').removeAttr('readonly')
                })
            } 
            //@todo relationships and repeatables using readonly_fields_functions.blade.php
        })
    }
        
    setFieldsToReadonly(readonlyFields,true)
</script>
@endpush

