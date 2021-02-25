<div class="col-md-11 col-12 sale-box-view " style="display: none;">
    <div class="row mt-2 mr-2">
        <div class="col-12">
            <i class="la la-times-circle float-right close-sale-box-view " style="font-size: 32px;"></i>
        </div>
    </div>



    <div class="row ">
        <div class="col-4">
            <h5>Caja</h5>
        </div>
        <div class="col-4">
            @if (!$isSaleBoxOpen)
                <button type="button" class="btn btn-warning" wire:click="showSalesBoxModal" data-backdrop="false" >
                    Abrir Caja
                </button>
            @else
            <a class="btn btn-danger text-white"  data-toggle="modal" data-target="#salesBoxModal" data-backdrop="false">
                Cerrar Caja
            </a>
            @endif
        </div>
        <div class="col-4">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#movementSalesBoxModal" data-backdrop="false">
                Agregar Movimiento
            </button>
        </div>
    </div>

    <!-- Movements -->



    <!-- Modals -->
    <div  wire:ignore.self  class="modal fade"  id="salesBoxModal" tabindex="-1" role="dialog" aria-labelledby="salesBoxModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="salesBoxModalLabel">   @if ($isSaleBoxOpen) Cierre Caja @else Apertura Caja @endif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @if ($isSaleBoxOpen)
                        <form wire:submit.prevent="closeSaleBox">
                            <p class="text-uppercase font-weight-bold">Inicio: <span
                                    class="ml-2 text-primary">{{ \Carbon\Carbon::parse($saleBox->opened_at)->translatedFormat('j/m/Y - g:i a') }}</span>
                            </p>
                            <p class="text-uppercase font-weight-bold">Cierre: <span
                                    class="ml-2 text-primary">{{ now()->translatedFormat('j/m/Y - g:i a') }}</span>
                            </p>
                            <p class="text-uppercase font-weight-bold">Usuario: <span
                                    class="ml-2 text-primary">{{ $seller->visible_name }}</span></p>
                            <p class="text-uppercase font-weight-bold">Sucursal: <span
                                    class="ml-2 text-primary">{{ $saleBox->branch->name }}</span></p>
                            <p class="text-uppercase font-weight-bold">Monto de apertura: <span
                                    class="ml-2 text-primary">{{ currencyFormat($saleBox->opening_amount ?? 0, 'CLP', true) }}</span>
                            </p>
                            {{-- <p class="text-uppercase font-weight-bold">Monto fin: <span class="ml-2 text-primary">{{ currencyFormat($saleBox->calculateClosingAmount() ?? 0, 'CLP', true) }}</span></p> --}}

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Confirmar
                                </button>
                            </div>
                        </form>

                    @else

                        <form wire:submit.prevent="openSaleBox">
                            <div class="form-group">
                                <label for="openingAmount">Sucursal</label>
                                <div class="input-group-prepend">

                                    <select wire:model.defer="branch_id"
                                        class="custom-select @error('branch_id') is-invalid @enderror" name="branch_id"
                                        id="branch_id" required>
                                        @foreach ($branches as $index => $branch)
                                            <option wire:key="{{ $branch->id }}" value="{{ $branch->id }}" @if ($index == 0) selected @endif>{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('branch_id')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="openingAmount">Monto de apertura</label>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                    <input wire:model.defer="opening_amount" type="number" step="any" min="0"
                                        class="form-control @error('amount') is-invalid @enderror" id="opening_amount"
                                        placeholder="1000"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="8" required>
                                </div>
                                @error('opening_amount')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="remarks_open">Observaciones</label>
                                <textarea wire:model.defer="remarks_open"
                                    class="form-control @error('remarks_open') is-invalid @enderror" id="remarks_open"
                                    rows="3"></textarea>
                                @error('remarks_open')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Abrir caja
                                </button>
                            </div>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>


    <div  wire:ignore.self  class="modal fade"  id="movementSalesBoxModal" tabindex="-1" role="dialog" aria-labelledby="movementSalesBoxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="movementSalesBoxModalLabel"> Nuevo movimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <form wire:submit.prevent="openSaleBox"  >
                        <div class="row g-3 align-items-center">
                            <div class="col-4">
                                <label for="inputPassword6" class="col-form-label">Sucursal</label>
                            </div>
                            <div class="col-8">
                                <span class="form-control"> {{$saleBox->branch->name}}</span>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-4">
                                <label for="openingAmount">Fecha</label>
                            </div>
                            <div class="col-8">

                            </div>
                            {{-- @error('opening_amount')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror --}}
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-4">
                                <label for="openingAmount">Tipo de movimiento</label>
                            </div>
                            <div class="col-8">

                            </div>
                            {{-- @error('opening_amount')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror --}}
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-4">
                                <label for="openingAmount">Monto de movimiento</label>
                            </div>
                            <div class="col-8">

                            </div>
                            @error('opening_amount')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="remarks_open">Observacion</label>
                            <textarea wire:model.defer="remarks_open"
                                class="form-control @error('remarks_open') is-invalid @enderror" id="remarks_open"
                                rows="3"></textarea>
                            @error('remarks_open')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success btn-block" wire:click.prevent="saveMovement()">
                                Guardar
                            </button>
                        </div>
                    </form>

            </div>

        </div>
    </div>
</div>
</div>
