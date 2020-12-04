@if ($crud->hasAccess('bulkReject') && $crud->get('list.bulkActions'))
  <a href="javascript:void(0)" onclick="bulkRejectEntries(this)" class="btn btn-sm btn-secondary bulk-button"><i class="fa fa-clone"></i> Rechazar</a>
@endif

@push('after_scripts')
<script>
  if (typeof bulkRejectEntries != 'function') {
    function bulkRejectEntries(button) {

        if (typeof crud.checkedItems === 'undefined' || crud.checkedItems.length == 0)
        {
            new Noty({
            type: "warning",
            text: "<strong>{{ trans('backpack::crud.bulk_no_entries_selected_title') }}</strong><br>{{ trans('backpack::crud.bulk_no_entries_selected_message') }}"
          }).show();

          return;
        }

        var message = "¿Esta seguro que desea rechazar :number productos?";
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
          text: "Continuar",
          value: true,
          visible: true,
          className: "bg-primary",
        }
        },
      }).then((value) => {
        if (value) {
          var ajax_calls = [];
              var reject_route = "{{ url($crud->route) }}/bulk-reject";

          // submit an AJAX delete call
          $.ajax({
            url: reject_route,
            type: 'POST',
            data: { entries: crud.checkedItems },
            success: function(result) {
              // Show an alert with the result
                    new Noty({
                    type: "success",
                    text: "<strong>Productos rechazados</strong><br>"+crud.checkedItems.length+" productos han sido rechazados."
                  }).show();

              crud.checkedItems = [];
              crud.table.ajax.reload();
            },
            error: function(result) {
              // Show an alert with the result
                    new Noty({
                    type: "danger",
                    text: "<strong>Algo fallo!</strong><br>Uno o mas productos no pudieron ser rechazados. Intenta nuevamente."
                  }).show();
            }
          });
        }
      });
      }
  }
</script>
@endpush