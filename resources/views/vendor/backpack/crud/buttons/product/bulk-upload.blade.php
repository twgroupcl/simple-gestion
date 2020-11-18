@if ($crud->hasAccess('create'))
	<a href="{{ route('products.bulk-upload') }}" class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i class="la la-plus"></i>Subir {{ $crud->entity_name_plural }} masivamente</span></a>
@endif