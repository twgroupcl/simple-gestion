@if ($crud->hasAccess('update'))
    <a href="{{ url($crud->route.'/'.$entry->getKey().'/to-invoice') }} " target="_blank" class="btn btn-sm btn-link"><i class="la la-edit"></i>Generar DTE</a>
@endif
