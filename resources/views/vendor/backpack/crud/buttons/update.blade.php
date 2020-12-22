@if (get_class($crud->getModel()) === 'App\Models\Invoice')
	@include('vendor.backpack.crud.buttons.invoice.update')
@elseif (get_class($crud->getModel()) === 'App\Models\Quotation')
	@include('vendor.backpack.crud.buttons.quotation.update')
@else
	@include('vendor.backpack.crud.buttons.default_update')
@endif