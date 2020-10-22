@extends('layouts.base')

@section('content')
<!-- Page title-->
<!-- Page Content-->
<!-- Header-->
<div class="page-title-overlap bg-accent pt-4 bg-cp-gradient">
    <div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
        <div class="media media-ie-fix align-items-center pb-3">
            <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;"><img class="rounded-circle" src="img/marketplace/account/avatar.png" alt="Createx Studio"></div>
            <div class="media-body pl-3">
                <h3 class="text-light font-size-lg mb-0">Createx Studio</h3>
                {{-- <span class="d-block text-light font-size-ms opacity-60 py-1">Member since November 2017</span>
                <span class="badge badge-success"><i class="czi-check mr-1"></i>Available for freelance</span> --}}
            </div>
        </div>
        {{-- <div class="d-flex">
            <div class="text-sm-right mr-5">
                <div class="text-light font-size-base">Total sales</div>
                <h3 class="text-light">426</h3>
            </div>
            <div class="text-sm-right">
                <div class="text-light font-size-base">Seller rating</div>
                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                </div>
                <div class="text-light opacity-60 font-size-xs">Based on 98 reviews</div>
            </div>
        </div> --}}
    </div>
</div>
<div class="container mb-5 pb-3">
    <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4">
                <div class="cz-sidebar-static h-100 border-right">
                    <h6>About</h6>
                    <p class="font-size-ms text-muted">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium viras doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <hr class="my-4">
                    <h6>Contacts</h6>
                    <ul class="list-unstyled font-size-sm">
                        <li><a class="nav-link-style d-flex align-items-center" href="mailto:contact@example.com"><i class="czi-mail opacity-60 mr-2"></i>contact@example.com</a></li>
                        <li><a class="nav-link-style d-flex align-items-center" href="#"><i class="czi-globe opacity-60 mr-2"></i>www.createx.studio</a></li>
                    </ul><a class="social-btn sb-facebook sb-outline sb-sm mr-2 mb-2" href="#"><i class="czi-facebook"></i></a><a class="social-btn sb-twitter sb-outline sb-sm mr-2 mb-2" href="#"><i class="czi-twitter"></i></a><a class="social-btn sb-dribbble sb-outline sb-sm mr-2 mb-2" href="#"><i class="czi-dribbble"></i></a><a class="social-btn sb-behance sb-outline sb-sm mr-2 mb-2" href="#"><i class="czi-behance"></i></a>
                    <hr class="my-4">
                    <h6 class="pb-1">Send message</h6>
                    <form class="needs-validation pb-2" method="post" novalidate>
                        <div class="form-group">
                            <textarea class="form-control" rows="6" placeholder="Your message" required></textarea>
                            <div class="invalid-feedback">Please wirte your message!</div>
                        </div>
                        <button class="btn btn-primary btn-sm btn-block" type="submit">Send</button>
                    </form>
                </div>
            </aside>
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-md-4">
                <!-- Banner-->
                <div class="py-sm-2">
                    <div class="d-sm-flex justify-content-between align-items-center bg-secondary overflow-hidden mb-4 rounded-lg">
                        <div class="py-4 my-2 my-md-0 py-md-5 px-4 ml-md-3 text-center text-sm-left">
                            <h4 class="font-size-lg font-weight-light mb-2">Converse All Star</h4>
                            <h3 class="mb-4">Make Your Day Comfortable</h3><a class="btn btn-primary btn-shadow btn-sm" href="#">Shop Now</a>
                        </div><img class="d-block ml-auto" src="img/shop/catalog/banner.jpg" alt="Shop Converse">
                    </div>
                </div>
                <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
                    <h2 class="h3 pt-2 pb-4 mb-4 text-center text-sm-left border-bottom">Products<span class="badge badge-secondary font-size-sm text-body align-middle ml-2">6</span></h2>
                    <!-- Toolbar-->
                    <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-4 pb-sm-5">
                        <div class="d-flex flex-wrap">
                            <div class="form-inline flex-nowrap mr-3 mr-sm-4 pb-3">
                                <label class="text-dark opacity-75 text-nowrap mr-2 d-none d-sm-block" for="sorting">Sort by:</label>
                                <select class="form-control custom-select" id="sorting">
                                    <option>Popularity</option>
                                    <option>Low - Hight Price</option>
                                    <option>High - Low Price</option>
                                    <option>Average Rating</option>
                                    <option>A - Z Order</option>
                                    <option>Z - A Order</option>
                                </select><span class="font-size-sm text-dark opacity-75 text-nowrap ml-2 d-none d-md-block">of 287 products</span>
                            </div>
                        </div>
                        <div class="d-flex pb-3"><a class="nav-link-style nav-link-dark mr-3" href="#"><i class="czi-arrow-left"></i></a><span class="font-size-md text-dark">1 / 5</span><a class="nav-link-style nav-link-dark ml-3" href="#"><i class="czi-arrow-right"></i></a></div>
                        <div class="d-none d-sm-flex pb-3"><a class="btn btn-icon nav-link-style bg-dark text-light disabled opacity-100 mr-2" href="#"><i class="czi-view-grid"></i></a><a class="btn btn-icon nav-link-style nav-link-dark" href="shop-list-ls.html"><i class="czi-view-list"></i></a></div>
                    </div>
                    <!-- Products grid-->
                    <div class="row mx-n2">
                        <!-- Product-->
                        <div class="col-md-4 col-sm-6 px-2 mb-4">
                            <div class="card product-card">
                                <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/01.jpg" alt="Product"></a>
                                <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Sneakers &amp; Keds</a>
                                    <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Women Colorblock Sneakers</a></h3>
                                    <div class="d-flex justify-content-between">
                                        <div class="product-price"><span class="text-accent">$154.<small>00</small></span></div>
                                        <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-body-hidden">
                                    <div class="text-center pb-2">
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size1" id="s-75">
                                            <label class="custom-option-label" for="s-75">7.5</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size1" id="s-80" checked>
                                            <label class="custom-option-label" for="s-80">8</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size1" id="s-85">
                                            <label class="custom-option-label" for="s-85">8.5</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size1" id="s-90">
                                            <label class="custom-option-label" for="s-90">9</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                                    <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                                </div>
                            </div>
                            <hr class="d-sm-none">
                        </div>
                        <!-- Product-->
                        <div class="col-md-4 col-sm-6 px-2 mb-4">
                            <div class="card product-card"><span class="badge badge-danger badge-shadow">Sale</span>
                                <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/02.jpg" alt="Product"></a>
                                <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Women’s T-shirt</a>
                                    <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Cotton Lace Blouse</a></h3>
                                    <div class="d-flex justify-content-between">
                                        <div class="product-price"><span class="text-accent">$28.<small>50</small></span>
                                            <del class="font-size-sm text-muted">38.<small>50</small></del>
                                        </div>
                                        <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i><i class="sr-star czi-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-body-hidden">
                                    <div class="text-center pb-2">
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="color1" id="white" checked>
                                            <label class="custom-option-label rounded-circle" for="white"><span class="custom-option-color rounded-circle" style="background-color: #eaeaeb;"></span></label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="color1" id="blue">
                                            <label class="custom-option-label rounded-circle" for="blue"><span class="custom-option-color rounded-circle" style="background-color: #d1dceb;"></span></label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="color1" id="yellow">
                                            <label class="custom-option-label rounded-circle" for="yellow"><span class="custom-option-color rounded-circle" style="background-color: #f4e6a2;"></span></label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="color1" id="pink">
                                            <label class="custom-option-label rounded-circle" for="pink"><span class="custom-option-color rounded-circle" style="background-color: #f3dcff;"></span></label>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <select class="custom-select custom-select-sm mr-2">
                                            <option>XS</option>
                                            <option>S</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XL</option>
                                        </select>
                                        <button class="btn btn-primary btn-sm" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                                    </div>
                                    <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                                </div>
                            </div>
                            <hr class="d-sm-none">
                        </div>
                        <!-- Product-->
                        <div class="col-md-4 col-sm-6 px-2 mb-4">
                            <div class="card product-card">
                                <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/03.jpg" alt="Product"></a>
                                <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Women’s Shorts</a>
                                    <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Mom High Waist Shorts</a></h3>
                                    <div class="d-flex justify-content-between">
                                        <div class="product-price"><span class="text-accent">$39.<small>50</small></span></div>
                                        <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-body-hidden">
                                    <div class="text-center pb-2">
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size2" id="xs">
                                            <label class="custom-option-label" for="xs">XS</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size2" id="s" checked>
                                            <label class="custom-option-label" for="s">S</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size2" id="m">
                                            <label class="custom-option-label" for="m">M</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size2" id="l">
                                            <label class="custom-option-label" for="l">L</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                                    <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                                </div>
                            </div>
                            <hr class="d-sm-none">
                        </div>
                        <!-- Product-->
                        <div class="col-md-4 col-sm-6 px-2 mb-4">
                            <div class="card product-card">
                                <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/04.jpg" alt="Product"></a>
                                <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Sportswear</a>
                                    <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Women Sports Jacket</a></h3>
                                    <div class="d-flex justify-content-between">
                                        <div class="product-price"><span class="text-accent">$68.<small>40</small></span></div>
                                        <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-body-hidden">
                                    <div class="text-center pb-2">
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size3" id="xs2" checked>
                                            <label class="custom-option-label" for="xs2">XS</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size3" id="s2">
                                            <label class="custom-option-label" for="s2">S</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size3" id="m2">
                                            <label class="custom-option-label" for="m2">M</label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="size3" id="l2">
                                            <label class="custom-option-label" for="l2">L</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                                    <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                                </div>
                            </div>
                            <hr class="d-sm-none">
                        </div>
                        <!-- Product-->
                        <div class="col-md-4 col-sm-6 px-2 mb-4">
                            <div class="card product-card">
                                <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/05.jpg" alt="Product"></a>
                                <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Men’s Sunglasses</a>
                                    <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">Polarized Sunglasses</a></h3>
                                    <div class="d-flex justify-content-between">
                                        <div class="product-price"><span class="text-muted font-size-sm">Out of stock</span></div>
                                        <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-body-hidden"><a class="btn btn-secondary btn-sm btn-block mb-2" href="shop-single-v1.html">View details</a>
                                    <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                                </div>
                            </div>
                            <hr class="d-sm-none">
                        </div>
                        <!-- Product-->
                        <div class="col-md-4 col-sm-6 px-2 mb-4">
                            <div class="card product-card">
                                <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/06.jpg" alt="Product"></a>
                                <div class="card-body py-2"><a class="product-meta d-block font-size-xs pb-1" href="#">Backpacks</a>
                                    <h3 class="product-title font-size-sm"><a href="shop-single-v1.html">TH Jeans City Backpack</a></h3>
                                    <div class="d-flex justify-content-between">
                                        <div class="product-price"><span class="text-accent">$79.<small>50</small></span></div>
                                        <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i><i class="sr-star czi-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-body-hidden">
                                    <div class="text-center pb-2">
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="color2" id="khaki" checked>
                                            <label class="custom-option-label rounded-circle" for="khaki"><span class="custom-option-color rounded-circle" style="background-color: #97947c;"></span></label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="color2" id="jeans">
                                            <label class="custom-option-label rounded-circle" for="jeans"><span class="custom-option-color rounded-circle" style="background-color: #99a8be;"></span></label>
                                        </div>
                                        <div class="custom-control custom-option custom-control-inline mb-2">
                                            <input class="custom-control-input" type="radio" name="color2" id="white2">
                                            <label class="custom-option-label rounded-circle" for="white2"><span class="custom-option-color rounded-circle" style="background-color: #eaeaeb;"></span></label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
                                    <div class="text-center"><a class="nav-link-style font-size-ms" href="#quick-view" data-toggle="modal"><i class="czi-eye align-middle mr-1"></i>Quick view</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
