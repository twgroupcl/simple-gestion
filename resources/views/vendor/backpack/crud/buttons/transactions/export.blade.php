@if ($crud->hasAccess('update'))
<a href="{{ url($crud->route.'/export') }} " target="_blank" class="btn btn-primary"><i class="la la-file"></i> Exportar </a>
@endif
