<!-- Toolbar for handheld devices-->
@if($footer)
<div class="cz-handheld-toolbar">
    <div class="d-table table-fixed w-100">
        {{-- <a class="d-table-cell cz-handheld-toolbar-item" href="account-wishlist.html">
            <span class="cz-handheld-toolbar-icon"><i class="czi-heart"></i></span>
            <span class="cz-handheld-toolbar-label">Wishlist</span>
        </a> --}}
        <a class="d-table-cell cz-handheld-toolbar-item" href="#shop-sidebar"
                data-toggle="sidebar"><span class="cz-handheld-toolbar-icon"><i class="czi-filter-alt"></i></span><span
                class="cz-handheld-toolbar-label">Filters</span>
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
<script>

    $(document).ready(function () {
        console.log('cargado')

        let observer = new MutationObserver(function(mutations) {
            console.log('observer creado')

            mutations.forEach(function(mutationRecord) {

                console.log('probando')

                if (mutationRecord.target.className === "show") {
                    console.log("Class added....")

                } else {
                    console.log("Class not added....")
                };
            })
        });

        let target = document.querySelector("#shop-sidebar");

        observer.observe(target, { attributes : true, attributeFilter : ['style', 'className'] });

    })
    
</script>
@endpush
