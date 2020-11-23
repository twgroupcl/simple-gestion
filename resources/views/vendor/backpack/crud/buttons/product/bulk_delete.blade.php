@if ($crud->hasAccess('bulkDelete') && $crud->get('list.bulkActions'))
  <a href="javascript:void(0)" onclick="bulkDeleteEntries(this)" class="btn btn-sm btn-danger bulk-button"><i class="fa fa-clone"></i> Eliminar</a>
@endif

@push('after_scripts')
<script>
  if (typeof bulkDeleteEntries != 'function') {
    function bulkDeleteEntries(button) {

        if (typeof crud.checkedItems === 'undefined' || crud.checkedItems.length == 0)
        {
            new Noty({
            type: "warning",
            text: "<strong>{{ trans('backpack::crud.bulk_no_entries_selected_title') }}</strong><br>{{ trans('backpack::crud.bulk_no_entries_selected_message') }}"
          }).show();

          return;
        }

        var message = "¿Esta seguro que desea eliminar :number libros? Esta acción no podrá ser revertida";
        message = message.replace(":number", crud.checkedItems.length);

        // show confirm message
        swal({
        title: "{{ trans('backpack::base.warning') }}",
        text: message,
        icon: "warning",
        buttons: {
          cancel: {
          text: "{{ trans('backpack::crud.cancel') }}",
          value: null,
          visible: true,
          className: "bg-secondary",
          closeModal: true,
        },
          delete: {
          text: "Eliminar libros",
          value: true,
          visible: true,
          className: "bg-danger",
        }
        },
      }).then((value) => {
        if (value) {
          var ajax_calls = [];
              var delete_route = "{{ url($crud->route) }}/bulk-delete";

          // submit an AJAX delete call
          $.ajax({
            url: delete_route,
            type: 'POST',
            data: { entries: crud.checkedItems },
            success: function(result) {
              // Show an alert with the result
                    new Noty({
                    type: "success",
                    text: "<strong>Libros eliminados</strong><br>"+crud.checkedItems.length+" libros han sido eliminados."
                  }).show();

              crud.checkedItems = [];
              crud.table.ajax.reload();
            },
            error: function(result) {
              // Show an alert with the result
                    new Noty({
                    type: "danger",
                    text: "<strong>Algo fallo!</strong><br>Uno o mas libros no pudieron ser eliminados. Intenta nuevamente."
                  }).show();
            }
          });
        }
      });
      }
  }
</script>
@endpush