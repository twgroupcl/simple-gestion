@push('after_scripts')
    <script>
        function removeButtonDel() {
            $('.delete-element').remove();
        }

        function removeButtonAddItem() {
            $('.add-repeatable-element-button').remove();
        }

        function checkItemStatus() {

            $('.shipping_status_select').each((index, el) => {
                if ($(el).find('option:selected').val() == 2) {
                    $(el).find('select').attr('disabled', 'disabled');
                }
            });
        }

        function orderStatus() {
           statusdescription = $('input[name="status_description"]');

            if (statusdescription.val() == 'Completa') {
                statusdescription.after('<span class="badge badge-success">' + statusdescription.val() + '</span>');

            } else {
                statusdescription.after('<span class="badge badge-default">' + statusdescription.val() + '</span>');
            }
            statusdescription.hide()
        }


        $(document).ready(function() {
            removeButtonDel();
            removeButtonAddItem();
            checkItemStatus();
            //orderStatus();
        })

    </script>
@endpush
