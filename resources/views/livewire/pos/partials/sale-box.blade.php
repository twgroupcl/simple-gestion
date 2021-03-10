<div class="col-md-11 col-12 sale-box-view" style="display: none;" wire:ignore.self>
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
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#salesBoxModal" data-backdrop="false" >
                    Abrir Caja
                </button>
            @else
          {{--   <a class="btn btn-danger text-white"  data-toggle="modal" data-target="#salesBoxModal" data-backdrop="false"> --}}
            <a class="btn btn-danger text-white"   data-toggle="collapse" href="#collapseCloseBox" role="button" aria-expanded="false" aria-controls="collapseCloseBox">
                Cerrar Caja
            </a>
            @endif
        </div>
        <div class="col-4">
            @if ($isSaleBoxOpen)
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#movementSalesBoxModal" data-backdrop="false">
                Agregar Movimiento
            </button>
            @endif
        </div>
    </div>
    <div class="collapse" id="collapseCloseBox">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row  ">
                    <div class="col-12 text-center">
                        <h3>Cierre de caja</h3>
                    </div>
                    <div class="col-12">
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
                       {{--  <p class="text-uppercase font-weight-bold">Monto fin: <span class="ml-2 text-primary">{{ currencyFormat($saleBox->calculateClosingAmount() ?? 0, 'CLP', true) }}</span></p> --}}

                    </div>
                    <div class="col-12">
                    <!-- Sales -->
                    @if(!is_null($sales))
                    <table class="table table-sm mt-1">
                        <thead>
                            <tr>
                                <th>Forma de pago</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                             $totalBox = 0;
                             $totalSale = 0;
                            @endphp
                            @foreach ($sales as $sale)
                            @php
                             $totalBox += $sale->total
                            @endphp
                            <tr>
                                <td>{{ $sale->method_title }}</td>
                                <td class="text-right">{{currencyFormat(($sale->total ) ?? 0, 'CLP', true)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Total Caja</strong></td>
                                <td class="text-right"><strong>{{currencyFormat(($totalBox ) ?? 0, 'CLP', true)}}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Total Ventas</strong></td>
                                <td class="text-right"><strong>{{currencyFormat(($totalSale ) ?? 0, 'CLP', true)}}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Movements -->
    @if(!is_null($movements))
    <div class="row mt-2">
        <div class="col-12">
            <div class="col-12 text-center">
                <h3>Movimientos Efectivo</h3>
            </div>
            <table class="table table-sm mt-1">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Tipo Mov.</th>
                        <th>Importe</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movements as $mov)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($mov->date)->translatedFormat('j/m/Y') }}</td>
                        <td>{{ $mov->movementtype->name }}</td>
                        <td class="text-right">{{currencyFormat(($mov->amount ) ?? 0, 'CLP', true)}}</td>
                        <td>{{$mov->notes}}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

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
                            <p class="text-uppercase font-weight-bold">Monto fin: <span class="ml-2 text-primary">{{ currencyFormat($saleBox->calculateClosingAmount() ?? 0, 'CLP', true) }}</span></p>

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

    @if($isSaleBoxOpen)
    <div    class="modal fade"  id="movementSalesBoxModal" tabindex="-1" role="dialog" aria-labelledby="movementSalesBoxModalLabel"
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

                    <form   >
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
                                <input type="date" class="form-control" wire:model.defer="movement.date" >
                            @error('movement.date')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                            </div>

                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-4">
                                <label for="movement.movement_type_id"">Tipo de movimiento</label>
                            </div>
                            <div class="col-8">
                                <select wire:model.defer="movement.movement_type_id"
                                class="custom-select" name="movement.movement_type_id""
                                id="movement.movement_type_id"" required>
                                <option  value="" >Seleccione </option>
                                @foreach ($movementtypes as $index => $movementtype)
                                    <option wire:key="{{ $movementtype->id }}" value="{{ $movementtype->id }}">{{ $movementtype->name }}</option>
                                @endforeach
                            </select>
                            @error('movement.movement_type_id')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                            </div>

                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-4">
                                <label id="movement.for">Monto de movimiento</label>
                            </div>
                            <div class="col-8">
                                <input  type="number" step="any" min="0"
                                class="form-control"
                                placeholder="0"
                                maxlength="8"
                                wire:model.defer="movement.amount"
                                name="movement.amount"
                                id="movement.amount"
                                required>
                            @error('movement.amount')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                            </div>


                        </div>
                        <div class="form-group">
                            <label for="movement.notes">Notas</label>
                            <textarea
                                class="form-control"
                                wire:model.defer="movement.notes"
                                name="movement.notes"
                                id="movement.notes"
                                rows="3"></textarea>

                        </div>
                        <div class="text-right">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                                <button type="button" wire:click="storeMovement()" class="btn btn-primary close-modal">Guardar</button>
                            </div>
                        </div>
                    </form>

            </div>

        </div>
    </div>
</div>
@endif
</div>

