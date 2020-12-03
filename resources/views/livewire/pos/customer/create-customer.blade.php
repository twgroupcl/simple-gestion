<div class="modal-content">
    <div class="modal-header">
        <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        >
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-lg-12 pt-4 pt-lg-0">
            <div class="product-details ml-auto pb-3">

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Cerrar
        </button>
    </div>
</div>

@push('after_scripts')
    <script>
        console.log('asdfasd')
        window.addEventListener('showCustomerModal', event => {
            $('#productAttributesModal').appendTo("body").modal('show');
        })

        window.addEventListener('close-modal-form', event => {
            $('#productAttributesModal').appendTo("body").modal('hide');
        })
    </script>
@endpush
