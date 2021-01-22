@php
    $dependency = $field['dependency'];
    $selectShow = $field['field'];
@endphp
@push('after_scripts')
<script>

function showSelect(select, value, expected) {
    if (value == expected) {
        select.next(".select2-container").show();
        select.parent().find('label').show();
    } else {
        select.next(".select2-container").hide();
        select.parent().find('label').hide();
    }
}

$(document).ready(function() {
        var select = "{{$selectShow}}";
        var dependency = "{{$dependency}}";
        select = $('[name="'+select+'"]');
        dependency = $('[name="'+dependency+'"]');
        dependency.on('change', function(event) {
            showSelect(select, this.value, 1);
        })
        showSelect(select, dependency.val(), 1)

})
</script>
@endpush
