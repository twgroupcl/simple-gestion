@if ($crud->hasAccess('export'))
<a href="{{ url($crud->route.'/'.$entry->getKey().'/export') }}" class="btn btn-sm btn-link"><i class="la la-edit"></i> Exportar</a>
@endif