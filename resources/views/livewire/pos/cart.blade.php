<div>
    {{-- Do your work, then step back. --}}
    Cart
    @if (!is_null($products))
        @foreach ($products as $product)
            <div>{{ $product->name }} </div>
        @endforeach
    @endif
</div>
