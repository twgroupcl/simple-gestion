<div>
    <div class="card product-card">
        <div class="product-card-actions d-flex align-items-center"><a class="btn-action nav-link-style mr-2" href="#"><i class="czi-compare mr-1"></i>Compare</a>
            <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button>
        </div><a class="card-img-top d-block overflow-hidden" href="shop-single-v2.html"><img src="{{ url($product->getFirstImagePath()) }}" alt="Product"></a>
        <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Headphones</a>
            <h3 class="product-title font-size-sm"><a href="shop-single-v2.html">{{$product->name}}</a></h3>
            <div class="d-flex justify-content-between">
                <div class="product-price"><span class="text-accent">$198.<small>00</small></span></div>
                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i>
                </div>
            </div>
        </div>
        <div class="card-body card-body-hidden">
            @livewire('products.add-to-cart',['product' => $product])
            <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view-electro" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
        </div>
    </div>
    <hr class="d-sm-none">
</div>
