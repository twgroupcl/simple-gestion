@php
$columnNames = $widget['columns'];
$collection = $widget['collection'];
$attributes = json_encode($widget['attributes']);
$functionName = \Str::slug($widget['name'], '_');
@endphp
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
<table class="table {{ $widget['class'] ?? '' }}">
    <thead>
        <tr>
            @foreach (collect($columnNames) as $column => $value)
                @if (is_array($value))
                    <th scope="col">{{ $value['column'] }}</th>
                @else
                    <th scope="col">{{ $value }}</th>
                @endif
            @endforeach
        </tr>
    </thead>
    <tbody id="body{{$functionName}}">
    </tbody>
    {{--<tfoot align="right">
		<tr>
            @foreach (collect($attributes) as $column => $value)
            <th></th>
            @endforeach
        </tr>
	</tfoot>--}}
</table>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')

@push('after_scripts')
<script>

$(document).ready(function() {

    let dateFrom = $('#date-from');
    let dateTo = $('#date-to');
    if (dateFrom) {
        dateFrom.on('change', function() {
            {{$functionName}}($(this).val(), $('#date-to').val());
        });
    }
    
    if (dateTo) {
        $('#date-to').on('change', function() {
            {{$functionName}}($('#date-from').val(), $(this).val());
        });
    }
    {{$functionName}}(dateFrom.val(), dateTo.val());
});

function {{$functionName}}(from, to) {
        //let attribute = false;
        //if ("{{$attribute}}" !== "") {
            //attribute = true;
        //}
        console.log({{$attributes}})
        $.ajax({
            url: "{{$widget['url']}}",
            type: 'POST',
            data: {
                from,
                to
            },
            success: function(content) {
                let tableBody = $("#body{{$functionName}}");
                tableBody.children().remove();
                content.forEach(element => {
                                    })
                    
            },
            error: function(error) {
                console.log(error)
            }
           //dataType: 'mycustomtype'
        });
};

</script>

@endpush
