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
            <h5 class="modal-title" id="exampleModalLabel">Abrir caja</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    @if ($isSaleBoxOpen)
                        <h5>La caja ya está abierta</h5>
                    @else
                        <div class="form-group">
                            <label for="openingAmount">Monto de apertura</label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                                <input wire:model="amount" type="number" class="form-control" id="amount" placeholder="1000">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Observaciones</label>
                            <textarea wire:model="remarks" class="form-control" id="remarks" rows="3"></textarea>
                        </div>
                        <div class="text-right">
                            <button wire:click="openSaleBox()" type="button" class="btn btn-primary" data-dismiss="modal">Abrir caja</button>
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
</script>
@endpush
