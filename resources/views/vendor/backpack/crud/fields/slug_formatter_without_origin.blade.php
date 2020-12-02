@php
$slug = json_encode($field['slug']);
@endphp

@push('after_scripts')
<script type="text/javascript">
    var slug = {!! $slug !!};
    $(document).ready(function() {
        let slugField = $('input[name=' + slug + ']');

        slugField.on('keyup', function(value) {
            $('input[name=' + slug + ']').val(slugFunction(slugField.val()));
        })
    });

    var slugFunction = function(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
        var to   = "aaaaaeeeeeiiiiooooouuuunc------";
        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    };

</script>
@endpush
