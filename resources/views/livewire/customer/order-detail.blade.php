<div wire:ignore.self class="modal fade" id="order-details">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Detalles</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">Historial</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent" style="overflow: auto">
                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <div class="modal-body pb-0">
                        @forelse ($items ?? [] as $item)
                            <div class="d-sm-flex justify-content-between mb-4 pb-3 pb-sm-2 border-bottom">
                                <div class="media d-block d-sm-flex text-center text-sm-left">
                                    <a class="d-inline-block mx-auto mr-sm-4" style="width: 10rem;">
                                        <img 
                                            src="{{ url($item->product->getFirstImagePath()) ?? '' }}" 
                                            alt="{{ $item->product->name ?? '' }}"
                                            style="width: 125px"
                                        >
                                    </a>
                                    <div class="media-body pt-2">
                                        <h3 class="product-title font-size-base mb-2"><a>{{ $item->name ?? '' }}</a></h3>
                                        @if(filled($item->product->getAttributesWithNames()))
                                            @foreach ($item->product->getAttributesWithNames() as $attribute)
                                                <div class="font-size-sm"><span class="text-muted mr-2">{{ $attribute['name'] }}</span>{{ $attribute['value'] }}</div>
                                            @endforeach
                                        @endif
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
                        <div class="px-2 py-1"><span class="text-muted">Envío:&nbsp;</span><span>{{ currencyFormat($order->shipping_total ?? 0, 'CLP', true) }}</span></div>
                        <div class="px-2 py-1"><span class="text-muted">Total:&nbsp;</span><span class="font-size-lg">{{ currencyFormat($order->total ?? 0, 'CLP', true) }}</span></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                    <div style="padding-left: 19px; padding-right: 19px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->getStatusHistory()->sortBy('created_at') as $history)
                                <tr>
                                    <td>{{ (new Carbon\Carbon($history->created_at))->format('d/m/Y H:i') }}</td>
                                    <td>{{ App\Models\Order::orderStatusString($history->order_status) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
              
            
            
        </div>
    </div>
</div>
