<a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{ $cursor === 'auto' ? route('shopping-cart') : '#' }}"  style="cursor:{{ $cursor }};">
    <span class="navbar-tool-label">{{$count}}</span><i class="navbar-tool-icon czi-cart"></i>
</a>