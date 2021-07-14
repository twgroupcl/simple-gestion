<!-- Toolbar for handheld devices-->
@if($footer)
<div class="cz-handheld-toolbar">
    <div class="d-table table-fixed w-100">
        {{-- <a class="d-table-cell cz-handheld-toolbar-item" href="account-wishlist.html">
            <span class="cz-handheld-toolbar-icon"><i class="czi-heart"></i></span>
            <span class="cz-handheld-toolbar-label">Wishlist</span>
        </a> --}}
        <a class="d-table-cell cz-handheld-toolbar-item" href="#shop-sidebar" data-toggle="sidebar"><span class="cz-handheld-toolbar-icon"><i class="czi-filter-alt"></i></span><span class="cz-handheld-toolbar-label">Filters</span>
        </a>
        <a class="d-table-cell cz-handheld-toolbar-item" href="#navbarCollapse" data-toggle="collapse" onclick="window.scrollTo(0, 0)">
            <span class="cz-handheld-toolbar-icon"><i class="czi-menu"></i></span>
            <span class="cz-handheld-toolbar-label">Menú</span>
        </a>
        @stack('cart-toolbar')
    </div>
</div>
@endif

@push('scripts')
<script type="text/javascript">
    var elemToObserve = document.getElementById('shop-sidebar');
    var prevClassState = elemToObserve.classList.contains('your_class');

    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName == 'class') {
                var currentClassState = mutation.target.classList.contains('show');

                if (currentClassState) {
                    console.log('class added!');
                } else {
                    console.log('class removed!');

                    //var e = document.querySelectorAll('[data-toggle="sidebar"]');
                    //e.closest(".cz-sidebar").classList.remove("show");
                    document.querySelector('body').classList.remove('offcanvas-open');
                }
            }
        });
    });

    observer.observe(elemToObserve, {
        attributes: true
    });
</script>
@endpush