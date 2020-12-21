@if (!$entry->parent_id)
<a href="{{ backpack_url('product') }}/{{ $entry->id }}/edit#inventario" target="_blank" class="btn btn-sm btn-link"><i class="la la-box"></i> Actualizar</a>
@else
<a href="{{ backpack_url('product') }}/{{ $entry->parent_id }}/edit#variaciones"target="_blank" class="btn btn-sm btn-link"><i class="la la-box"></i> Actualizar</a>
@endif
