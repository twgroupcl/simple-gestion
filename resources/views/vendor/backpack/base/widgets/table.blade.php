@php
$attributes = $widget['columns'];
$collection = $widget['collection'];
@endphp
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
<table id="{{ $widget['id'] ?? '' }}" class="table {{ $widget['class'] ?? '' }}">
    <thead>
        <tr>
            @foreach (collect($attributes) as $column => $value)
                @if (is_array($value))
                    <th scope="col">{{ $value['column'] }}</th>
                @else
                    <th scope="col">{{ $value }}</th>
                @endif
            @endforeach
        </tr>
    </thead>
</table>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')
