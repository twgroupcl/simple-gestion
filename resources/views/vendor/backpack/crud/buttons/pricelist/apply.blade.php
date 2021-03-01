@if ($crud->hasAccess('apply'))
<a href="{{ url($crud->route.'/'.$entry->getKey().'/apply') }}" class="btn btn-sm btn-link"><i class="la la-edit"></i> Aplicar precios</a>
@endif