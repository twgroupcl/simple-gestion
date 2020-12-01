@include('crud::fields.inc.wrapper_start')
        <div class="form-group col-12" element="div">
            <label>Precio</label>
            <input
                type="text"
                name="price"
                value=""
                readonly="readonly"
                class="form-control input-price"
                data-init-function="bpFieldInitTextAreaDependsSelect2"
                >
        </div>
@include('crud::fields.inc.wrapper_end')
@push('crud_fields_scripts')
<script>
    $(function(){

        $('.select-plan').on('change', function() {
            let idPlan = this.value
            url = "{{ url('admin/api/getPlanById') }}",

            $.ajax({
                url: url,
                type: "POST",
                dataType: 'json',
                data: {
                    id : idPlan
                },
                success : function(response) {
                    let date = new Date(),
                    currentDay = date.getDate()+1,
                    currentMonth = date.getMonth()+1,
                    currentYear = date.getFullYear();
                    var currentDate = currentDay + '/' + currentMonth + '/' + currentYear;

                    $('.subscription_starts_at').val(currentDate)
                    $("input[name*='starts_at']").val(currentDate)

                    switch(response.invoice_interval){
                        case 'week':
                            date.setDate(date.getDate() + 7);
                            var day = date.getDate()+1,
                            month = date.getMonth()+1,
                            year = date.getFullYear();

                            var dateEnd = day + '/' + month + '/' + year;
                            $('.subscription_ends_at').val(dateEnd)
                            $("input[name*='ends_at']").val(dateEnd)

                        break;
                        case 'month':
                            date.setMonth(date.getMonth() + 1);
                            var day = date.getDate()+1,
                            month = date.getMonth()+1,
                            year = date.getFullYear();

                            var dateEnd = day + '/' + month + '/' + year;
                            $('.subscription_ends_at').val(dateEnd)
                            $("input[name*='ends_at']").val(dateEnd)

                        break;
                    }
                    $('.input-price').val(response.price)

                }
            });
        });
    });

</script>
@endpush
