@push('after_scripts')
<script>
$(document).ready(function(){
    let customer = $('[name="customer_id"]');
    let activitySelection = $('[name="business_activity_id"]');

    customer.on('change', (event) => {
        $.ajax({
            url: "{{backpack_url('api/customer/get-data')}}" + "/" + customer.val(),
            success: function(response) {

                if (response.data.activities !== undefined && response.data.activities.length > 0) {
                    // get first activity
                    activitySelection.val(response.data.activities[0].business_activity_id);
                    activitySelection.trigger('change')
                }
            }
        })
    })
})
</script>
@endpush
