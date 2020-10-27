<div class="modal fade" id="order-details">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Orden Nro. - {{ $order->id ?? '' }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body pb-0">
                @forelse ($items ?? [] as $item)
                    <div class="d-sm-flex justify-content-between mb-4 pb-3 pb-sm-2 border-bottom">
                        <div class="media d-block d-sm-flex text-center text-sm-left"><a class="d-inline-block mx-auto mr-sm-4" style="width: 10rem;"><img src="{{ url($item->product->getFirstImagePath()) ?? '' }}" alt="{{ $item->product->name ?? '' }}"></a>
                            <div class="media-body pt-2">
                                <h3 class="product-title font-size-base mb-2"><a>{{ $item->name ?? '' }}</a></h3>
                                <div class="font-size-lg text-accent pt-2">{{ currencyFormat($item->product->price ?? 0, 'CLP', true) }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                                <div class="text-muted mb-2">Cantidad:</div> {{ $item->qty ?? '' }}
                            </div>
                            <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                                <div class="text-muted mb-2">Subtotal</div>{{ currencyFormat($item->sub_total ?? 0, 'CLP', true) }}
                            </div>
                        </div>
                    </div>
                @empty
                 No se encontraron items
                @endforelse
            </div>
            <!-- Footer-->
            <div class="modal-footer flex-wrap justify-content-between bg-secondary font-size-md">
                <div class="px-2 py-1"><span class="text-muted">Subtotal:&nbsp;</span><span>{{ currencyFormat($order->sub_total ?? 0, 'CLP', true) }}</span></div>
                <div class="px-2 py-1"><span class="text-muted">Shipping:&nbsp;</span><span>{{ currencyFormat($order->shipping_total ?? 0, 'CLP', true) }}</span></div>
                <div class="px-2 py-1"><span class="text-muted">Tax:&nbsp;</span><span>{{ $order->tax_total ?? '' }}</span></div>
                <div class="px-2 py-1"><span class="text-muted">Total:&nbsp;</span><span class="font-size-lg">{{ currencyFormat($order->total ?? 0, 'CLP', true) }}</span></div>
            </div>
        </div>
    </div>
</div>