
<div class="w-100">
    <div class="row">
        <div class="col-md-12">
            <div class="w-100">
                <button class="font-weight-bold border border-light width-25 fs-1-2 p-1 bg-gray"  wire:click.prevent="dec">-</button>
                <input type="text" class="w-50 text-center border border-light fs-1-2 p-1 bg-gray" wire:model="qty" disabled>
                <button class="font-weight-bold border border-light width-25 fs-1-2 p-1 bg-gray" wire:click.prevent="add">+</button>
            </div>
        </div>
    </div>
</div>