@if ($crud->hasAccess('bulkApprove') && $crud->get('list.bulkActions'))
  <a href="javascript:void(0)" onclick="bulkApprovedEntries(this)" class="btn btn-sm btn-success bulk-button"><i class="fa fa-clone"></i> Aprobar</a>
@endif

@push('after_scripts')
<script>
  if (typeof bulkApprovedEntries != 'function') {
    function bulkApprovedEntries(button) {

        if (typeof crud.checkedItems === 'undefined' || crud.checkedItems.length == 0)
        {
            new Noty({
            type: "warning",
            text: "<strong>{{ trans('backpack::crud.bulk_no_entries_selected_title') }}</strong><br>{{ trans('backpack::crud.bulk_no_entries_selected_message') }}"
          }).show();

          return;
        }

        var message = "¿Esta seguro que desea aprobar :number productos?";
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
              var approve_route = "{{ url($crud->route) }}/bulk-approve";

          // submit an AJAX delete call
          $.ajax({
            url: approve_route,
            type: 'POST',
            data: { entries: crud.checkedItems },
            success: function(result) {
              // Show an alert with the result
                    new Noty({
                    type: "success",
                    text: "<strong>Productos aprobados</strong><br>"+crud.checkedItems.length+" productos han sido aprobados."
                  }).show();

              crud.checkedItems = [];
              crud.table.ajax.reload();
            },
            error: function(result) {
              // Show an alert with the result
                    new Noty({
                    type: "danger",
                    text: "<strong>Algo fallo!</strong><br>Uno o mas productos no pudieron ser aprobados. Intenta nuevamente."
                  }).show();
            }
          });
        }
      });
      }
  }
</script>
@endpush