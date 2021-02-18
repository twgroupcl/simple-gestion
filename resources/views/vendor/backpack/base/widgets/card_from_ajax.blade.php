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
$.ajax({
    url: "{{$widget['url']}}",
    type: 'POST',
    //data: {},
    success: function(content) {
            console.log(content)
        let body = $('#body');
        body.append('<p>' + content.count + '</p>');
    },
    error: function() {

    }
   //dataType: 'mycustomtype'
});
</script>

@endpush
