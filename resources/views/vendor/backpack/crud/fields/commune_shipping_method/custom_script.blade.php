@push('after_scripts')
    <script>
        function removeButtonDel() {
            $('.delete-element').remove();
        }

        function removeButtonAddItem() {
            $('.add-repeatable-element-button').remove();
        }

        $(document).ready(function() {
            removeButtonDel();
            removeButtonAddItem();
        })

    </script>
@endpush
