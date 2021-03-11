<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Realizar devolución</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        @if (!$invoice)
            <div class="row">
                <div class="col">
                    Esta orden no posee un documento emitido, por tanto no es posible realizar una nota de credito
                </div>
            </div>
        @else
            <div class="row">

                {{-- Product list --}}
                <div class="col-md-8">
                    @foreach ($itemsToRefund as $item)
                        <div class="card  ">
                            <div class="card-body pt-0 pb-0 ">
                                <div class="row">
                                    <div class="col-9">
                                        <h6 class="product-title font-size-base mb-2"><a {{-- href="{{ route('product', ['slug' => $product->url_key]) }}" --}}
                                                target="_blank">{{ $item['name'] }}</a></h6>
                                    </div>
                                    <div class="col-3">
                                        <a href="#">
                                            <i class="la la-trash" style="font-size: 32px;"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <a wire:click="removeQty({{ $item['item_id'] }}, 1)">
                                            <i class="la la-minus-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 text-center custom-currency"><strong>{{ $item['qty_to_return'] }}</strong></div>
                                    <div class="col-1">
                                        <a wire:click="addQty({{ $item['item_id'] }}, 1)">
                                            <i class="la la-plus-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-center">
                                        <small><strong> {{ currencyFormat($item['price'], 'CLP', true)  }}</strong>
                                            por
                                            unidad</small>
                                    </div>
                                    <div class="col-3  text-right">
                                        <span
                                            class="custom-currency"><strong>{{  currencyFormat($item['qty_to_return'] * $item['price'], 'CLP', true) }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    @endforeach
                </div>

                {{-- Options --}}
                <div class="col-md-4">
                    {{-- <div class="row">
                        <div class="col">
                            <label>Tipo de devolución</label>
                            <select class="form-control">
                                <option value="1">Correción de montos</option>
                                <option value="2">Otros</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col">
                            <label>Motivo de devolución</label>
                            <input wire:model.lazy="reason" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <strong>Subtotal: </strong> {{ currencyFormat($totals['subtotal'] ?? 0, 'CLP', true) }} <br>
                            <strong>Impuestos: </strong> {{ currencyFormat($totals['iva'] ?? 0, 'CLP', true) }} <br>
                            <strong>Total: </strong> {{ currencyFormat($totals['total'] ?? 0, 'CLP', true) }} <br>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" wire:click="issueCreditNote()">Emitir nota de credito</button>
    </div>
</div>
