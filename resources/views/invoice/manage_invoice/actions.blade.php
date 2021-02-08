@php use \App\Models\Invoice; @endphp

@php
    Widget::add([
        'type' => 'title',
        'text' => 'Acciones'
    ]);
@endphp

@php
    Widget::add([
        'type' => 'view',
        'view' => 'invoice.manage_invoice.buttons',
        'wrapper' => [
            'class' => 'mr-1 mb-2',
        ]
    ]);
@endphp


