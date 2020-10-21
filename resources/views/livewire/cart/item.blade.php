@php
    $product = $item->product;
@endphp
<div class="row mt-3 border-bottom-secondary">
    <div class="col-md-6 mb-3">
        <div class="row">
            <div class="col-md-4">
                <!-- //TO-DO url json to image ???? -->
                <img class="width-5" src="{{ url($product->getFirstImagePath()) }}">
            </div>
            <div class="col-md-8">
                <span>{{$product->name}}</span>
                <p>{{ currencyFormat($product->price,'CLP',true) }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-center">
        <div class="row">
            <div class="d-table height-2">
                @livewire('qty-item', ['qty' => $item->qty, 'add' => 'toAdd', 'dec' => 'toDec'], key($item->id))
            </div>
        </div>
    </div>
    <div class="col-md-3 text-center">                                
        <p class="fs-1-2">{{ currencyFormat($total,'CLP',true) }}</p>
    </div>
    <div class="">
        @if ($confirm == $item->id)
            <a wire:click.prevent="delete" class="btn btn-danger btn-block">Ok</a>
        @else
            <a href="#" wire:click.prevent="deleteConfirm({{$item->id}})"><i class="fas fa-trash-alt text-danger fs-1-5 cursor-pointer"></i></a>
        @endif   
    </div>
</div>
