@php
    $attributes = $widget['columns'];
    $collection = $widget['collection'];
@endphp
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
    <table class="table {{ $widget['class'] ?? '' }}">
        <thead>
            <tr>
            @foreach (collect($attributes) as $column => $value)
                @if (is_array($value))
                    <th scope="col">{{$value['column']}}</th>
                @else
                    <th scope="col">{{$value}}</th>
                @endif
            @endforeach
            </tr>
        </thead>
        <tbody>
            
            @foreach ($collection as $item )
            <tr>
                @foreach ($attributes as $attribute => $value)
                @if (is_array($value))
                    @php
                        $name = $value['attribute'];
                    @endphp
                    <td>{{ $item->$attribute->$name }}</td>
                @else
                    <td>{{ $item->$attribute }}</td>
                @endif
                @endforeach
            </tr>    
            @endforeach
        </tbody>
    </table>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')