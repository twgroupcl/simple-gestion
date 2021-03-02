@if ($crud->hasAccess('apply'))
<a href="javascript:void(0)" onclick="applyPriceList(this)" data-route="{{ url($crud->route.'/'.$entry->getKey().'/apply') }}" class="btn btn-sm btn-link"><i class="la la-edit"></i> Aplicar precios</a>
@endif

{{-- Button Javascript --}}
{{-- - used right away in AJAX operations (ex: List) --}}
{{-- - pushed to the end of the page, after jQuery is loaded, for non-AJAX operations (ex: Show) --}}
@push('after_scripts') @if (request()->ajax()) @endpush @endif
<script>

	if (typeof applyPriceList != 'function') {

	  function applyPriceList(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
		var button = $(button);
		var route = button.attr('data-route');

		swal({
		  title: "¿Está seguro que desea aplicar esta lista de precios?",
		  text: "Al aplicar se cambiara el precio y costo de todos productos por los precios y costos designados en la lista",
		  icon: "warning",
		  buttons: {
		  	cancel: {
			  text: "Cancelar",
			  value: null,
			  visible: true,
			  className: "bg-secondary",
			  closeModal: true,
			},
		  	delete: {
			  text: "Aceptar",
			  value: true,
			  visible: true,
			  className: "bg-success",
			}
		  },
		}).then((value) => {
			if (value) {
				$.ajax({
			      url: route,
			      type: 'GET',
			      success: function(result) {
			          if (result == 1) {
			          	  // Show a success notification bubble
			              new Noty({
		                    type: "success",
		                    text: "La lista de precios ha sido aplicada exitosamente"
		                  }).show();

			              // Hide the modal, if any
			              $('.modal').modal('hide');
			          } else {
			          	  // Show an error alert
                            swal({
                            title: "Ocurrio un error",
                            text: "La lista de precios no pudo ser aplicada",
                            icon: "error",
                            timer: 4000,
                            buttons: false,
                            });		          	  
			          }
			      },
			      error: function(result) {
			          // Show an alert with the result
			          swal({
		              	title: "Ocurrio un error",
                        text: "La lista de precios no pudo ser aplicada",
		              	icon: "error",
		              	timer: 4000,
		              	buttons: false,
		              });
			      }
			  });
			}
		});

      }
	}
</script>
@if (!request()->ajax()) @endpush @endif