@handheld
<div class="col-12 sale-box" style="display: none;">
</div>
@elsehandheld
<div class="col-11 sale-box" style="display: none;">
    <div class="row">
        <div class="col-12"><i class="la la-close float-right close-sale-box" ></i></div>
    </div>

    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6">
            @if ($isSaleBoxOpen)
                <form wire:submit.prevent="closeSaleBox">
                    <p class="text-uppercase font-weight-bold">Monto iniciado: <span class="ml-2 text-primary">{{ currencyFormat($saleBox->opening_amount ?? 0, 'CLP', true) }}</span></p>
                    <p class="text-uppercase font-weight-bold">Monto fin: <span class="ml-2 text-primary">{{ currencyFormat($saleBox->calculateClosingAmount() ?? 0, 'CLP', true) }}</span></p>
                    <p class="text-uppercase font-weight-bold">Inicio: <span class="ml-2 text-primary">{{ \Carbon\Carbon::parse($saleBox->opened_at)->translatedFormat('j/m/Y - g:i a') }}</span></p>
                    <p class="text-uppercase font-weight-bold">Cierre: <span class="ml-2 text-primary">{{ now()->translatedFormat('j/m/Y - g:i a') }}</span></p>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            Confirmar y cerrar caja
                        </button>
                    </div>
                </form>
            @else
                <form wire:submit.prevent="openSaleBox">
                    <div class="form-group">
                        <label for="openingAmount">Monto de apertura</label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <input wire:model.defer="opening_amount" type="number" step="any" min="0" class="form-control @error('amount') is-invalid @enderror" id="opening_amount" placeholder="1000" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "8" required>
                        </div>
                        @error('opening_amount')
                        <small class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="remarks">Observaciones</label>
                        <textarea wire:model.defer="remarks" class="form-control @error('remarks') is-invalid @enderror" id="remarks" rows="3"></textarea>
                        @error('remarks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            Abrir caja
                        </button>
                    </div>
                </form>
            @endif
        </div>
        <div class="col-3">
        </div>
    </div>

</div>
@endhandheld
