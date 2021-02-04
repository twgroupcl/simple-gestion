<div class="input-group-overlay d-lg-none my-3">
    <div class="input-group-prepend-overlay"><span class="input-group-text"><button wire:click="search" class="btn-search btn p-0"><i class="czi-search"></i></button></span></div>
    <input wire:keydown.enter="search" class="form-control prepended-form-control input-search" wire:model="query" type="text" placeholder="Título, Autor, ISBN, Editorial, Expositor">
</div>
