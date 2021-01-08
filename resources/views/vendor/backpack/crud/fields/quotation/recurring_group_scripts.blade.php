@push('after_scripts')
<script>

    let recurringGroup = $('.recurring_group')
    let isRecurringCheck = $('.is_recurring_check')
    let endTypeField = $('#end_type_field')
    let endDateField = $('#end_date_field')
    let endAfterRepsField = $('#end_after_reps_field')


    function hideGroup() {
        recurringGroup.hide()
    }

    function showGroup() {
        recurringGroup.show()
    }

    function checkEndTypeField() {
        if (endTypeField.val() == 'never') {
            endDateField.hide()
            endAfterRepsField.hide()
        } else if (endTypeField.val() == 'date') {
            endAfterRepsField.hide()
            endDateField.show()
        } else if (endTypeField.val() == 'repetition') {
            endAfterRepsField.show()
            endDateField.hide()
        }
    }

    function checkRecurringField() {
        if (isRecurringCheck.prop('checked')) {
            showGroup()
            checkEndTypeField()
        } else {
            hideGroup();
        }
    }

    function init() {
        checkRecurringField()
        checkEndTypeField()
    }

    endTypeField.on('change', function () {
        checkEndTypeField()
    })

    isRecurringCheck.on('change', function() {
        checkRecurringField()
    })


    $(document).ready( function() {
        init()
    })

</script>
@endpush