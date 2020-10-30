
<div class="w-100">
    <label class="font-weight-medium">Cantidad
        <input class="form-control" type="number" min="1" wire:model="qty" wire:change="set">
        @error('qty') <span class="error">{{ $message }}</span> @enderror
    </label>
</div>