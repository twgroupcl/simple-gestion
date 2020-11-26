@extends('layouts.base')

@section('content')
<!-- Page title-->
<!-- Custom page title-->
<div class="page-title-overlap bg-dark pt-4 bg-light-blue">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-light mb-2">{{$product->name}}</h1>
            @if ($product->categories()->count())
            <a href="{{ url('search-products/'.$product->categories[0]->id) }}">
                <span class="h5 text-light mb-2">{{ $product->showCategory() }}</span>
            @endif
            </a>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container">
    <div class="bg-light box-shadow-lg rounded-lg">
        <!-- Tabs-->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link p-4 active" href="#general" data-toggle="tab" role="tab">Información General</a></li>
            <!--
                <li class="nav-item"><a class="nav-link p-4" href="#specs" data-toggle="tab" role="tab">Detalles del Producto</a></li>
            -->
        </ul>
        @if ($product->product_type->id == 2)
                @livewire('products.configurable-detail', ['product' => $product])
        @elseif ($product->product_type->id == 1)
        <div class="px-4 pt-lg-3 pb-3 mb-5">
            <div class="tab-content px-lg-3">
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-4 pr-lg-0">
                            <div class="cz-product-gallery">
                                <div class="cz-preview order-sm-2 m-0">
                                    @foreach($product->getImages() as $key => $value)
                                        @if($key == 0)
                                            <div class="cz-preview-item active" id="img-{{$key}}"><img class="cz-image-zoom" src="{{ url($value->path) }}" data-zoom="{{ url($value->path) }}" alt="Product image">
                                                <div class="cz-image-zoom-pane"></div>
                                            </div>
                                        @else
                                            <div class="cz-preview-item" id="img-{{$key}}"><img class="cz-image-zoom" src="{{ url($value->path) }}" data-zoom="{{ url($value->path) }}" alt="Product image">
                                                <div class="cz-image-zoom-pane"></div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <!--
                                    <div class="cz-thumblist order-sm-1">
                                        @foreach($product->getImages() as $key => $value)
                                            <a class="cz-thumblist-item" href="#img-{{$key}}"><img src="{{ url($value->path) }}" alt="Product thumb"></a>
                                        @endforeach
                                    </div>
                                -->
                            </div>

                           


                        </div>
                        <!-- Product details-->
                        <div class="col-lg-8 pt-4 pt-lg-0">
                            <div class="ml-auto">
                                <a href="{{ url('seller-shop/'.$product->seller->id) }}" class="d-inline-block font-size-sm text-body align-middle mt-1 ml-1">{{ $product->seller->visible_name }}</a>
                            </div>
                            <div class="ml-auto pb-3">
                                @if ($product->has_special_price)
                                <div class="mb-3"><span class="h3 font-weight-normal text-accent mr-1">{{ currencyFormat($product->special_price, defaultCurrency(), true) }}</span>
                                    <del class="text-muted font-size-lg mr-3">{{ currencyFormat($product->price, defaultCurrency(), true) }}</del>
                                    <br>
                                    <span class="badge badge-warning badge-shadow align-middle mt-n2">Descuento</span>
                                </div>
                                @else
                                    <div class="h3 font-weight-normal text-accent mb-3 mr-1">{{ currencyFormat($product->price, defaultCurrency(), true) }}</div>
                                @endif
                                <small>Precio no incluye costos de envío. Estos se definirán al final de la compra.</small>
                            
                                <div class="position-relative mr-n4 mb-3">
                                    @if ($product->haveSufficientQuantity(1))
                                        <div class="product-badge product-available mt-n5"><i class="czi-security-check"></i>Producto disponible</div>
                                    @else
                                        <div class="product-badge product-not-available mt-n5"><i class="czi-security-close"></i>Producto no disponible</div>
                                    @endif
                                </div>
                                @if ($product->haveSufficientQuantity(1))
                                <div class="d-flex align-items-center pt-2 pb-4">
                                    @livewire('qty-item', [
                                        'qty' => 1,
                                        'emitTo' => [
                                            'addtocart.cant',
                                        ]
                                    ])
                                    <div style="margin-top: 14px">
                                    @livewire('products.add-to-cart',['product' => $product, 'view' => 'single'])
                                    </div>
                                </div>
                                @endif

                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        @if ($product->description)
                                            <h2 class="h3 pb-2">Reseña</h2>
                                            <p>{!!$product->description!!}</p>
                                        @endif
                                    </div>
                                </div>                               
                              
                                {{-- <h6 class="d-inline-block align-middle font-size-base my-2 mr-2">Share:</h6><a class="share-btn sb-twitter mr-2 my-2" href="#"><i class="czi-twitter"></i>Twitter</a><a class="share-btn sb-instagram mr-2 my-2" href="#"><i class="czi-instagram"></i>Instagram</a><a class="share-btn sb-facebook my-2" href="#"><i class="czi-facebook"></i>Facebook</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 pr-lg-0">
                        @if ( count($product->getAttributesWithNames()) )
                                <h3 class="h6">Especificaciones generales</h3>
                                <ul class="list-unstyled font-size-sm pb-2">
                                    @foreach ($product->getAttributesWithNames() as $attribute)
                                    <li class="d-flex justify-content-between pb-2 border-bottom"><span class="text-muted">{{ $attribute['name'] }}:</span><span>{{ $attribute['value'] }}</span></li>
                                    @endforeach
                                </ul>
                            @endif

                        </div>
                        <div class="col-lg-8 pt-4 pt-lg-0">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    @if (!$product->is_service)
                                        <h3 class="h6">Dimensiones de envio</h3>
                                        <ul class="list-unstyled font-size-sm pb-2">
                                            <li class="d-flex justify-content-between pb-2 border-bottom"><span class="text-muted">Peso:</span><span>{{ number_format($product->weight, 2, ',', '.') }} kg</span></li>
                                            <li class="d-flex justify-content-between pb-2 border-bottom"><span class="text-muted">Alto:</span><span>{{ number_format($product->height, 2, ',', '.') }} cm</span></li>
                                            <li class="d-flex justify-content-between pb-2 border-bottom"><span class="text-muted">Largo:</span><span>{{ number_format($product->depth, 2, ',', '.') }} cm</span></li>
                                            <li class="d-flex justify-content-between pb-2 border-bottom"><span class="text-muted">Ancho:</span><span>{{ number_format($product->width, 2, ',', '.') }} cm</span></li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tech specs tab-->
            
                <!-- Reviews tab-->
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Product description-->
<!--
    <div class="container pt-lg-3 pb-4 pb-sm-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                @if ($product->description)
                    <h2 class="h3 pb-2">Reseña</h2>
                    <p>{!!$product->description!!}</p>
                @endif
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-lg-5 col-sm-6">
                @if ( count($product->getAttributesWithNames()) )
                <h3 class="h6">Especificaciones generales</h3>
                <ul class="list-unstyled font-size-sm pb-2">
                    @foreach ($product->getAttributesWithNames() as $attribute)
                    <li class="d-flex justify-content-between pb-2 border-bottom"><span class="text-muted">{{ $attribute['name'] }}:</span><span>{{ $attribute['value'] }}</span></li>
                    @endforeach
                </ul>
                @endif
            </div>
            <div class="col-lg-5 col-sm-6 offset-lg-1">
                @if (!$product->is_service)
                    <h3 class="h6">Dimensiones de envio</h3>
                    <ul class="list-unstyled font-size-sm pb-2">
                        <li class="d-flex justify-content-between pb-2 border-bottom"><span class="text-muted">Peso:</span><span>{{ number_format($product->weight, 2, ',', '.') }} kg</span></li>
                        <li class="d-flex justify-content-between pb-2 border-bottom"><span class="text-muted">Alto:</span><span>{{ number_format($product->height, 2, ',', '.') }} cm</span></li>
                        <li class="d-flex justify-content-between pb-2 border-bottom"><span class="text-muted">Largo:</span><span>{{ number_format($product->depth, 2, ',', '.') }} cm</span></li>
                        <li class="d-flex justify-content-between pb-2 border-bottom"><span class="text-muted">Ancho:</span><span>{{ number_format($product->width, 2, ',', '.') }} cm</span></li>
                    </ul>
                @endif
                
            </div>
        </div>
    </div>

-->
@endsection
