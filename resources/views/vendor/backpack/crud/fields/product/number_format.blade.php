<!-- number input -->
@include('crud::fields.inc.wrapper_start')
    @php
    $decimals = isset($field['decimals']) ? intval($field['decimals']) : 2;
    $dec_point = $field['decimal_point'] ?? ',';

    $value = isset($field['value']) ? number_format(floatval($field['value']), $decimals, $dec_point, '') : ($field['default'] ?? '')
    @endphp
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    @if(isset($field['prefix']) || isset($field['suffix'])) <div class="input-group"> @endif
        @if(isset($field['prefix'])) <div class="input-group-prepend"><span class="input-group-text">{!! $field['prefix'] !!}</span></div> @endif
        <input
        	type="text"
        	name="{{ $field['name'] }}"
            value="{{ old(square_brackets_to_dots($field['name']))  ?? $value }}"
            pattern="[0-9 _,]*"
            @include('crud::fields.inc.attributes')
        	>
        @if(isset($field['suffix'])) <div class="input-group-append"><span class="input-group-text">{!! $field['suffix'] !!}</span></div> @endif

    @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')
