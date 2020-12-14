<div>
    @isset($product)
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

                        @foreach ($options as $key => $option)
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center pb-1">
                                    <label class="font-weight-medium" for="product-size">{{ $option['name'] }}</label>
                                </div>
                                <select class="custom-select"
                                    wire:model="options.{{ $key }}.selectedValue"
                                    name="attribute-{{ $option['id'] }}"
                                    @if(!$option['enableOptions']) disabled @endif
                                >
                                    @foreach ($option['items'] as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach

                        {{-- Price --}}
                        @if ($selectedChildrenId)
                            <div class="h3 font-weight-normal text-accent mb-3 mr-1">{{ currencyFormat($currentProduct->real_price ?? 0, defaultCurrency(), true) }}</div>
                        @else
                            <div class="h3 font-weight-normal text-accent mb-1 mr-1">Desde {{currencyFormat($currentPrice, 'CLP', true) }}</div>
                        @endif

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>
                <button wire:click="addProductToCart()" type="button" class="btn btn-primary " @if(! $enableAddButton) disabled @endif>Agregar al carrito</button>
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

        window.addEventListener('openSaleBoxModal', event => {
        $('#showSaleBoxModal').appendTo("body").modal('show');
    })
    </script>
@endpush
