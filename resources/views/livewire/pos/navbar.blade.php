<div wire:ignore.self>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">PUNTO DE VENTA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active pt-2">
                   <div class="custom-control custom-switch">
                       <input type="checkbox"  class="custom-control-input" id="boxSwitch" wire:model="checked">
                       <label
                            class="custom-control-label"
                            for="boxSwitch"
                            style="-webkit-touch-callout: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;"
                            >Caja abierta:
                        </label>
                    </div>
                    @isset($salesBox)
                        <strong class="text-primary">{{ \Carbon\Carbon::parse($salesBox->opened_at)->translatedFormat('j/m/Y - g:i a') }}</strong>
                    @endisset
                </li>
            </ul>
            <form class="form-inline">
                <input id="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>

@push('after_scripts')
    <script>
        const filter = search => {
            let value = search.val().toLowerCase();
            $(".product-cart").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }


        $("#search").on("keyup", () => filter($("#search")));
        $("#search").on("search", () => filter($("#search")));


        $("#boxSwitch").change(() => {
            event.target.checked = !event.target.checked
            $('#showSaleBoxModal').appendTo("body").modal('show');
        })
    </script>
@endpush
