<ul class="navbar-nav mega-nav pr-lg-2 mr-lg-2">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle pl-0" href="#" data-toggle="dropdown">
            <i class="czi-menu align-middle mt-n1 mr-2"></i>Categorías
        </a>
        <ul class="dropdown-menu">
            @foreach ($categories as $category)
            <li class="dropdown mega-dropdown">
                <a class="dropdown-item" href="{{ route('category.products', $category->slug) }}">
                    <i class="{{ $category->icon }} opacity-60 font-size-lg mt-n1 mr-2"></i> {{ $category->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </li>
</ul>
