<!-- Toolbar for handheld devices-->
@if($footer)
<div class="cz-handheld-toolbar">
    <div class="d-table table-fixed w-100">
        {{-- <a class="d-table-cell cz-handheld-toolbar-item" href="account-wishlist.html">
            <span class="cz-handheld-toolbar-icon"><i class="czi-heart"></i></span>
            <span class="cz-handheld-toolbar-label">Wishlist</span>
        </a> --}}
        <a class="d-table-cell cz-handheld-toolbar-item" href="#navbarCollapse" data-toggle="collapse" onclick="window.scrollTo(0, 0)">
            <span class="cz-handheld-toolbar-icon"><i class="czi-menu"></i></span>
            <span class="cz-handheld-toolbar-label">Menú</span>
        </a>
        @stack('cart-toolbar')
    </div>
</div>
@endif
