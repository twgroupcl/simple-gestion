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
                        <div class="col-lg-12 pt-4 pt-lg-0">
                            <div class="product-details ml-auto pb-3">



                                {{-- Price --}}
                                @if ($selectedChildrenId)
                                    @if ($currentProduct->special_price === $currentProduct->real_price)
                                    <div class="mb-3"><span class="h3 font-weight-normal text-accent mr-1">{{ currencyFormat($currentProduct->special_price ?? 0, defaultCurrency(), true) }}</span>
                                        <del class="text-muted font-size-lg mr-3">{{ currencyFormat($currentProduct->price ?? 0, defaultCurrency(), true) }}</del>
                                        <br>
                                        <span class="badge badge-warning badge-shadow align-middle mt-n2">Descuento</span>
                                    </div>
                                    @else
                                        <div class="h3 font-weight-normal text-accent mb-3 mr-1">{{ currencyFormat($currentProduct->price ?? 0, defaultCurrency(), true) }}</div>
                                    @endif
                                @else
                                    <div class="h3 font-weight-normal text-accent mb-1 mr-1">Desde {{currencyFormat($currentPrice, 'CLP', true) }}</div>
                                    @if ($parentProduct->has_special_price)
                                        <span class="badge badge-warning badge-shadow align-middle mt-n2">Descuento</span>
                                    @endif
                                @endif

                            </div>
                        </div>
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