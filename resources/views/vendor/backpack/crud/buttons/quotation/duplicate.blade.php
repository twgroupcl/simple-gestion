@if ($crud->hasAccess('update'))
<a href="{{ url($crud->route.'/'.$entry->getKey().'/duplicate') }} " target="_blank" class="btn btn-sm btn-link"><i class="la la-edit"></i> Duplicar</a>
@endif