<div>
    @isset($product)
        <div
        class="modal fade"
        id="productAttributesModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="productAttributesModalLabel"
        aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productAttributesModalLabel">{{ $product->name }}</h5>
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
                        @foreach ($product->getAttributesWithNames() as $attribute)
                            <li class="d-flex justify-content-between pb-2 border-bottom"><span class="text-muted">{{ $attribute['name'] }}:</span><span>{{ $attribute['value'] }}</span></li>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cerrar
                        </button>
                        <button wire:click="$emit('add-product-cart:post', {{ $product->id }})" type="button" class="btn btn-primary">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
@push('after_scripts')
    <script>
        window.addEventListener('showModal', event => {
            $('#productAttributesModal').appendTo("body").modal('show');
            // let value = @this.address['commune_id']
            // $('#product-attributes-modal').find(`option[value="${value}"]`).prop('selected', 'selected').change();
        })

        window.addEventListener('close-modal-form', event => {
            $('#productAttributesModal').appendTo("body").modal('hide');
        })
    </script>
@endpush