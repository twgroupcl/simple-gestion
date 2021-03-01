@if ($crud->hasAccess('modify'))
<a href="{{ url($crud->route.'/'.$entry->getKey().'/modify') }}" class="btn btn-sm btn-link"><i class="la la-edit"></i> Editar</a>
@endif