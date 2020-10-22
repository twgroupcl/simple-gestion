
<div class="container mb-5 pb-3">
    <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
            <!-- Content-->
            <section class="col-lg-8 pt-2 pt-lg-4 pb-4 mb-3">
                <div class="pt-2 px-4 pr-lg-0 pl-xl-5">
                    <!-- Header-->
                    <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-3">
                        <div class="py-1"><a class="btn btn-outline-accent btn-sm" href="marketplace-category.html"><i
                                    class="czi-arrow-left mr-1 ml-n1"></i>Volver a comprar</a></div>
                        <div class="d-none d-sm-block py-1 font-size-ms">Tines 3 productos en tu carro</div>
                        <div class="py-1"><a class="btn btn-outline-danger btn-sm" href="marketplace-category.html"><i
                                    class="czi-close font-size-xs mr-1 ml-n1"></i>Limpiar carro</a></div>
                    </div>
                    @foreach ($items as $item)
                        @livewire('cart.item', ['item' => $item], key($item->id))
                    @endforeach
                    <!-- Item-->
                    <div class="d-sm-flex justify-content-between align-items-center my-4 pb-3 border-bottom">
                        <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left"><a
                                class="d-inline-block mx-auto mr-sm-4" href="shop-single-v1.html"
                                style="width: 10rem;"><img src="img/marketplace/products/widget/02.jpg" alt="Product"></a>
                            <div class="media-body pt-2">
                                <h3 class="product-title font-size-base mb-2"><a href="shop-single-v1.html">Gravity Devices UI Mockup (PSD)</a></h3>
                                <div class="font-size-sm"><span class="text-muted mr-2">Brand:</span>Tommy Hilfiger
                                </div>
                                <div class="font-size-sm"><span class="text-muted mr-2">Color:</span>Khaki</div>
                                <div class="font-size-lg text-accent pt-2">$79.<small>50</small></div>
                            </div>
                        </div>
                        <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left"
                            style="max-width: 9rem;">
                            <div class="form-group mb-0">
                                <label class="font-weight-medium" for="quantity2">Cantidad</label>
                                <input class="form-control" type="number" id="quantity2" value="1">
                            </div>
                            <button class="btn btn-link px-0 text-danger" type="button"><i
                                    class="czi-close-circle mr-2"></i><span class="font-size-sm">Eliminar</span></button>
                        </div>
                    </div>
                    <!-- Item-->
                    <div class="d-sm-flex justify-content-between align-items-center my-4 pb-3 border-bottom">
                        <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left"><a
                                class="d-inline-block mx-auto mr-sm-4" href="shop-single-v1.html"
                                style="width: 10rem;"><img src="img/marketplace/products/widget/03.jpg" alt="Product"></a>
                            <div class="media-body pt-2">
                                <h3 class="product-title font-size-base mb-2"><a href="shop-single-v1.html">3-Color Sun
                                        Stash Hat</a></h3>
                                <div class="font-size-sm"><span class="text-muted mr-2">Brand:</span>The North Face
                                </div>
                                <div class="font-size-sm"><span class="text-muted mr-2">Color:</span>Pink / Beige / Dark
                                    blue</div>
                                <div class="font-size-lg text-accent pt-2">$22.<small>50</small></div>
                            </div>
                        </div>
                        <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left"
                            style="max-width: 9rem;">
                            <div class="form-group mb-0">
                                <label class="font-weight-medium" for="quantity3">Cantidad</label>
                                <input class="form-control" type="number" id="quantity3" value="1">
                            </div>
                            <button class="btn btn-link px-0 text-danger" type="button"><i
                                    class="czi-close-circle mr-2"></i><span class="font-size-sm">Eliminar</span></button>
                        </div>
                    </div>


                </div>
            </section>
            <!-- Sidebar-->
            <aside class="col-lg-4">
                <hr class="d-lg-none">
                <div class="cz-sidebar-static h-100 ml-auto border-left">
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <h2 class="h6 mb-3 pb-1">Total Carro</h2>
                        <h3 class="font-weight-normal">$56.<small>00</small></h3>
                    </div>
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <h2 class="h6 mb-3 pb-1">Cupón de descuento</h2>
                        <form class="needs-validation pb-2" method="post" novalidate>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Ingrese un cupón de descuento"
                                    required>
                                <div class="invalid-feedback">Ingrese un cupón de descuento.</div>
                            </div>
                            <button class="btn btn-secondary btn-block" type="submit">Aplicar cupón</button>
                        </form>
                    </div><a class="btn btn-primary btn-shadow btn-block mt-4" href="{{ route('checkout') }}"><i
                            class="czi-locked font-size-lg mr-2"></i>Realizar Pago</a>
                    {{-- <div class="text-center pt-2"><small
                            class="text-form text-muted">100% money back guarantee</small></div>
                    --}}
                </div>
            </aside>
        </div>
    </div>
</div>