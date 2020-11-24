<div>
    @if(count($sellers))
        <div class="row">
            @foreach($sellers as $key => $seller)
                <div class="col-lg-3 col-md-4 col-sm-6 px-5 mb-4" wire:key="{{ $key }}">
                    @livewire('sellers.seller', ['seller' => $seller], key($seller->id . $key))
                </div>
                <hr class="d-sm-none">
            @endforeach
        </div>
    @else
        <div class="col-lg-12 col-md-12 col-sm-12">
            <p class="text-center">No existen tiendas en esta búsqueda.</p>
        </div>
    @endif
</div>
