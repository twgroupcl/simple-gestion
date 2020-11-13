@php
    $subscription = $widget['content'];



@endphp
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')

@if (!is_null($widget['content']))
    <div class="{{ $widget['class'] ?? 'well mb-2' }}">
        Subscripción: {{$subscription->name}}
    </div>
@else
<div class="{{ $widget['class'] ?? 'well mb-2' }}">
    No tiene una subscripción activa
</div>
@endif
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')
