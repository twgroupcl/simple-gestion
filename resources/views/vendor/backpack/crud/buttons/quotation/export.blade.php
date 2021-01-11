@if ($crud->hasAccess('update'))
<a href="{{ url($crud->route.'/'.$entry->getKey().'/export') }} " target="_blank" class="btn btn-sm btn-link"><i class="la la-file-download"></i> Exportar PDF</a>
@endif