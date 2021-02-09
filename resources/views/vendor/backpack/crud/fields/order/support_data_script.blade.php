@push('after_scripts')
    <script>
        function removeButtonDel() {
            $('.delete-element').remove();
        }

        function removeButtonAddItem() {
            $('.add-repeatable-element-button').remove();
        }

        function checkItemStatus() {
            statusdescription = $( "#order_status option:selected" ).text();
            $('.shipping_status_select').each((index, el) => {

                if (statusdescription != 'Pagada') {
                    $(el).find('select').attr('disabled', 'disabled');
                } else {
                    if ($(el).find('option:selected').val() == 2) {
                        $(el).find('select').attr('disabled', 'disabled');
                    }
                }
            });
        }

        function orderStatus() {
            statusdescription =  $('input[name="status_description"]');

            console.log(statusdescription);

            if (statusdescription.val() == 'Completa') {
                statusdescription.after('<span class="badge badge-success">' + statusdescription.val() + '</span>');

            } else {
                statusdescription.after('<span class="badge badge-default">' + statusdescription.val() + '</span>');
            }
            statusdescription.hide()
        }


        function clearStyles(){
           // $('.select2-selection__clear').remove();
          //  $('.select2-selection__arrow').remove();
            $('.oi_seller_name').each((index, el) => {
                spanSellerName  = $(el).find('.select2-selection__rendered');
                $(el).find('span').remove();
                $(el).append('<input type="text" class="form-control"  value="'+spanSellerName.text() +'" disabled>')
            });
            // spanSellerName  = contentSellerName.find('.select2-selection__rendered');
            // contentSellerName.find('span').remove();
            // contentSellerName.append('<input type="text" class="form-control"  value="'+spanSellerName.text() +'" disabled>')

        }


        $(document).ready(function() {
            removeButtonDel();
            removeButtonAddItem();
            checkItemStatus();
            //orderStatus();
            clearStyles();
        })

    </script>
@endpush
