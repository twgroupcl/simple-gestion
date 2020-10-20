<header class="header bg-gradient w-100 z-index-999 position-fixed fixed-top">
    <div class="container-fluid p-3">
        <div class="row">
            <div class="col-md-2">
                @include('layouts.header.logo')
            </div>
            <div class="col-md-4 offset-md-2 align-center p-0">
                @include('layouts.header.search')
            </div>
            <div class="col-md-3 text-right text-white monserrat-bold mt-3">
                @include('layouts.header.login')
            </div>
            <div class="col-md-1 text-white monserrat-bold mt-3 p-0">
                @include('layouts.header.cart')
            </div>
        </div>
    </div>
</header>
