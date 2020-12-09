<div
    wire:ignore.self
    class="modal fade"
    id="showSaleBoxModal"
    id="showSaleBoxModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="SaleBoxModalLabel"
    aria-hidden="true"
    >
    <div wire:init="validateSaleBox" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                @if ($isSaleBoxOpen)
                    Cerrar caja
                @else
                    Abrir caja
                @endif
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    @if ($isSaleBoxOpen)
                        <p class="text-uppercase font-weight-bold">Monto iniciado: <span class="ml-2 text-primary">{{ currencyFormat($saleBox->amount ?? 0, 'CLP', true) }}</span></p>
                        <p class="text-uppercase font-weight-bold">Inicio: <span class="ml-2 text-primary">{{ \Carbon\Carbon::parse($saleBox->opened_at)->translatedFormat('j/m/Y - g:i a') }}</span></p>
                        <p class="text-uppercase font-weight-bold">Cierre: <span class="ml-2 text-primary">{{ now()->translatedFormat('j/m/Y - g:i a') }}</span></p>
                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button wire:click="closeSaleBox()" type="button" class="btn btn-primary" data-dismiss="modal">
                                Confirmar y cerrar caja
                            </button>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="openingAmount">Monto de apertura</label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                                <input wire:model="amount" type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="1000">
                            </div>
                            @error('amount')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="remarks">Observaciones</label>
                            <textarea wire:model="remarks" class="form-control @error('remarks') is-invalid @enderror" id="remarks" rows="3"></textarea>
                            @error('remarks')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button wire:click="openSaleBox()" type="button" class="btn btn-primary">
                                Abrir caja
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@push('after_scripts')
<script>
    window.addEventListener('openSaleBoxModal', event => {
        $('#showSaleBoxModal').appendTo("body").modal('show');
    })
    window.addEventListener('closeSaleBoxModal', event => {
        $('#showSaleBoxModal').appendTo("body").modal('hide');
    })
</script>
@endpush
