@php
    $data = json_encode($field['data']);
@endphp
<script>
    let {{ $field['variable_name'] }} = JSON.parse('{!! $data !!}')
</script>