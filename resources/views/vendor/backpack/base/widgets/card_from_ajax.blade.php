@php
	// preserve backwards compatibility with Widgets in Backpack 4.0
	$widget['wrapper']['class'] = $widget['wrapper']['class'] ?? $widget['wrapperClass'] ?? 'col-sm-6 col-md-4';
@endphp

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
	<div class="{{ $widget['class'] ?? 'card' }}">
		@if (isset($widget['content']))
			@if (isset($widget['content']['header']))
                <div class="card-header">{!! $widget['content']['header'] !!}</div>
			@endif
			<div class="card-body" id="body">
            </div>
	  	@endif
	</div>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')

@push('after_scripts')
<script>

$(document).ready(function() {
    console.log("Holiwis");

    $('#date-from').on('change', function() {
        ajaxCard($(this).val(), $('#date-to').val());

    });

    $('#date-to').on('change', function() {
        ajaxCard($('#date-from').val(), $(this).val());
    });
});

function ajaxCard (from, to) {
    $.ajax({
        url: "{{$widget['url']}}",
        type: 'POST',
        data: {
            'from': from,
            'to': to
        },
        success: function(content) {
            console.log(content)
            let body = $('#body');
            body.find(".content").remove();
            body.append('<p class="content">' + content.count + '</p>');
        },
        error: function() {
    
        }
       //dataType: 'mycustomtype'
    });

}
</script>

@endpush
