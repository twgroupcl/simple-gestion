<div class="input-group-overlay d-none d-lg-block mx-4">
    <div class="input-group-prepend-overlay"><span class="input-group-text"><btn wire:click="search" class="btn-search"><i class="czi-search"></i></btn></span></div>
    <input wire:keydown.enter="search" class="form-control prepended-form-control appended-form-control input-search" wire:model="query" type="text" placeholder="Título, Autor, ISBN">
    <div class="input-group-append-overlay">
        <select class="custom-select select-search" wire:model="selected">
            <option value="0" selected>Todas las categorías</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>   
            @endforeach
        </select>
    </div>
</div>
