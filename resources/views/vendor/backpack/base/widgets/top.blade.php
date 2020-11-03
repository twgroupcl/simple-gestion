@php
    $attributes = $widget['columns'];
    $collection = $widget['collection'];
@endphp
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
    <table class="table {{ $widget['class'] ?? '' }}">
        <thead>
            <tr>
            @foreach ($attributes as $column => $value)
                <th scope="col">{{$value}}</th>
            @endforeach
            </tr>
        </thead>
        <tbody>
            
            @foreach ($collection as $item )
            <tr>
                @foreach ($attributes as $attribute => $value)
                        <td>{{ $item->$attribute }}</td>
                @endforeach
            </tr>    
            @endforeach
        </tbody>
    </table>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')