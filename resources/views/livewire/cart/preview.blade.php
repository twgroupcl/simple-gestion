
<div class="container mb-5 pb-3">
    <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
            <!-- Content-->
            <section class="col-lg-8 pt-2 pt-lg-4 pb-4 mb-3">
                <div class="pt-2 px-4 pr-lg-0 pl-xl-5">
                    <!-- Header-->
                    <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-3">
                        <div class="py-1"><a class="btn btn-outline-accent btn-sm" href="{{ route('index') }}"><i
                                    class="czi-arrow-left mr-1 ml-n1"></i>Volver a comprar</a></div>
                        <div class="d-none d-sm-block py-1 font-size-ms">Tienes {{count($items)}} productos en tu carro</div>
                        {{-- <div class="py-1"><a class="btn btn-outline-danger btn-sm" href="marketplace-category.html"><i
                                    class="czi-close font-size-xs mr-1 ml-n1"></i>Limpiar carro</a></div> --}}
                    </div>
                    @foreach ($items as $item)
                        @livewire('cart.item', ['item' => $item , 'showShipping'=>false], key($item->id))
                    @endforeach
                </div>
            </section>
            <!-- Sidebar-->
            <aside class="col-lg-4">
                <hr class="d-lg-none">
                <div class="cz-sidebar-static h-100 ml-auto border-left">
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <h2 class="h6 mb-3 pb-1">Total en Carro</h2>
                        <!--<h3 class="font-weight-normal">$56.<small>00</small></h3>-->
                        <h3 class="font-weight-normal">{{ currencyFormat($total, 'CLP', true) }}</h3>
                    </div>
                    {{-- <div class="text-center mb-4 pb-3 border-bottom">
                        <h2 class="h6 mb-3 pb-1">Cupón de descuento</h2>
                        <form class="needs-validation pb-2" method="post" novalidate>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Ingrese un cupón de descuento"
                                    required>
                                <div class="invalid-feedback">Ingrese un cupón de descuento.</div>
                            </div>
                            <button class="btn btn-secondary btn-block" type="submit">Aplicar cupón</button>
                        </form>
                    </div> --}}
                    <a class="btn btn-primary btn-shadow btn-block mt-4" href="{{ route('checkout') }}"><i
                            class="czi-locked font-size-lg mr-2"></i>Realizar Pago</a>
                    {{-- <div class="text-center pt-2"><small
                            class="text-form text-muted">100% money back guarantee</small></div>
                    --}}
                </div>
            </aside>
        </div>
    </div>
</div>
