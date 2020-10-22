<div>
    <section class="container pt-5">
        <!-- Heading-->
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
            <h2 class="h3 mb-0 pt-3 mr-2">Productos</h2>
            <div class="pt-3"><a class="btn btn-outline-accent btn-sm" href="{{ url('shop-list')}}">Más productos<i class="czi-arrow-right ml-1 mr-n1"></i></a></div>
        </div>
        <!-- Grid-->
        <div class="row pt-2 mx-n2">
            <!-- Product-->
            @foreach($products as $product)
            @php
            if ($product->parent()->count()) continue;
             @endphp
                <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <!--
                            <div class="product-card-actions d-flex align-items-center"><a class="btn-action nav-link-style mr-2" href="#"><i class="czi-compare mr-1"></i>Compare</a>
                                <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button>
                            </div>
                        -->
                        <a class="card-img-top d-block overflow-hidden" href="{{route('product',['slug' => $product->url_key])}}"><img src="{{ url($product->getFirstImagePath()) }}" class="w-100" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="{{route('product',['slug' => $product->url_key])}}">{{$product->name}}</a>
                            <h3 class="product-title font-size-sm"><a href="{{route('product',['slug' => $product->url_key])}}">{{$product->short_description}}</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent">{{ currencyFormat($product->price, 'CLP', true) }}</span></div>
                                <!--
                                    <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i>
                                    </div>
                                -->
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">
                            <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Agregar al carro</button>
                            <div class="text-center">
                                <a class="nav-link-style font-size-ms" href="{{route('product',['slug' => $product->url_key])}}"><i class="czi-eye align-middle mr-1"></i>Ver producto</a>
                            </div>
                        </div>
                    </div>
                    <hr class="d-sm-none">
                </div>
            @endforeach
        </div>
    </section>
</div>
