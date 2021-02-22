@php
	// preserve backwards compatibility with Widgets in Backpack 4.0
	$widget['wrapper']['class'] = $widget['wrapper']['class'] ?? $widget['wrapperClass'] ?? 'col-sm-6 col-md-4';
    $functionName = $widget['name'];
    $attribute = "";
    if (array_key_exists('attribute', $widget)) {
        $attribute = $widget['attribute'];
    }
@endphp

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
	<div  class="{{ $widget['class'] ?? 'card' }}">
		@if (isset($widget['content']))
			@if (isset($widget['content']['header']))
                <div class="card-header">{!! $widget['content']['header'] !!}</div>
			@endif
			<div class="card-body" id="body{{$widget['name']}}">
            </div>
	  	@endif
	</div>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')

@push('after_scripts')
<script>

$(document).ready(function() {
    console.log("Holiwis");

    let dateFrom = $('#date-from');
    let dateTo = $('#date-to');
/*
    if (dateFrom) {
        dateFrom.on('change', function() {
            "{{$widget['name']}}"($(this).val(), $('#date-to').val());

        });
    }
    
    if (dateTo) {
        $('#date-to').on('change', function() {
            "{{$widget['name']}}"($('#date-from').val(), $(this).val());
        });
    }*/
    {{$functionName}}(dateFrom.val(), dateTo.val());
});

function {{$functionName}}(from, to) {
        //let attribute = false;
        //if ("{{$attribute}}" !== "") {
            //attribute = true;
        //}
        $.ajax({
            url: "{{$widget['url']}}",
            type: 'POST',
            data: {
                from,
                to
            },
            success: function(content) {
                let body = $("#body{{$widget['name']}}");
                body.find(".content").remove();
                body.append('<p class="content">' + (
                        "{{$attribute}}" !== "" ? content["{{$attribute}}"] : content
                ) + '</p>');
            },
            error: function(error) {
                console.log(error)
            }
           //dataType: 'mycustomtype'
        });
};

</script>

@endpush
