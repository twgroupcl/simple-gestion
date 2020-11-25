@push('after_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/currencyformatter.js/2.2.0/currencyFormatter.min.js" integrity="sha512-zaNuym1dVrK6sRojJ/9JJlrMIB+8f9IdXGzsBQltqTElXpBHZOKI39OP+bjr8WnrHXZKbJFdOKLpd5RnPd4fdg==" crossorigin="anonymous"></script>

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


            if (statusdescription.val() == 'Completa') {
                statusdescription.after('<span class="badge badge-success">' + statusdescription.val() + '</span>');

            } else {
                statusdescription.after('<span class="badge badge-default">' + statusdescription.val() + '</span>');
            }
            statusdescription.hide()
        }

        function formatAmounts() {


            $('.order-amount :input').each((index, el) => {
               formatAmount = OSREC.CurrencyFormatter.format($(el).val(), { currency: 'CLP' })

               $(el).val(formatAmount)
            })
        }


        $(document).ready(function() {
            removeButtonDel();
            removeButtonAddItem();
            checkItemStatus();
            formatAmounts();
        })

    </script>
@endpush
