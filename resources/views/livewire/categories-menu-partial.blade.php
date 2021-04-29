@foreach ($categories as $category)
<li class="dropdown">
    <a class="dropdown-item @if ($category->children->count()) dropdown-toggle @endif" href="{{ route('category.products', $category->slug) }}">
        <i class="{{ $category->icon }} opacity-60 font-size-lg mt-n1 mr-2"></i> {{ $category->name }}
    </a>

    @if ($category->children->count())
    <ul class="dropdown-menu">
        @include('livewire.categories-menu-partial', ['categories' => $category->children])
    </ul>
    @endif
</li>
@endforeach