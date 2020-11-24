<div class="d-flex flex-wrap">
        <div class="form-inline flex-nowrap mr-3 mr-sm-4 pb-3">
            <label 
                class="text-light opacity-75 text-nowrap mr-2 d-none d-sm-block" 
                for="sorting"
                @if ($showFrom === 'vendor') style="color: black !important" @endif
            >
                Ordenar por:
            </label>
            <select wire:change="sortProducts" wire:model="sortingBy" class="form-control custom-select" id="sorting">
                {{-- <option>Popularity</option> --}}
                {{-- <option>Average Rating</option> --}}
                <option data-direction="DESC" data-field="created_at" value="0">Más nuevo</option>
                <option data-direction="ASC" data-field="name" value="1">Ordenar A - Z</option>
                <option data-direction="DESC" data-field="name" value="2">Ordenar Z - A</option>
                <option data-direction="ASC" data-field="price" value="3">Precio Menor - Mayor</option> 
                <option data-direction="DESC" data-field="price" value="4">Precio Mayor - Menor</option>
            </select>
            {{--  <span class="font-size-sm text-light opacity-75 text-nowrap ml-2 d-none d-md-block">of 287 products</span> --}}
        </div>
</div>
