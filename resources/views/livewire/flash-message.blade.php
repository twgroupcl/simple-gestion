<div>
    <div class="toast-container toast-bottom-center">
        <div class="toast fade {{$status}} mb-3" data-delay="{{$delay}}" id="cart-toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-{{$type}} text-white"><i class="{{$icon}} mr-2"></i>
                <h6 class="font-size-sm text-white mb-0 mr-auto">¡Añadido al carro!</h6>
                <!--<small class="text-muted">just now</small>-->
                <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="toast-body">{{$message}}</div>
        </div>
    </div>
</div>
@push('scripts')

<script>
    
    Livewire.on('showToast', (message,delay,type) => {
        if (delay === null) {
            delay = 3000;
        }

        @this.setMessage(message)
        @this.setType(type)
        @this.show();

        setTimeout(() => {
            @this.hide()
        }, delay)
        
    })
</script>
@endpush
