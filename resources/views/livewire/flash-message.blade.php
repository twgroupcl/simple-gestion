<div>
    <div  class="toast-container toast-bottom-center">
        <div wire:ignore.self class="toast mb-3" id="cart-toast" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white"><i class="czi-check-circle mr-2"></i>
                <h6 class="font-size-sm text-white mb-0 mr-auto">Añadido al carrito!</h6>
                <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="toast-body">{{$message}}</div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.addEventListener('show-toast', event => {
        @this.message = event.detail.message
        $('#cart-toast').toast('show')
    })
</script>
@endpush
