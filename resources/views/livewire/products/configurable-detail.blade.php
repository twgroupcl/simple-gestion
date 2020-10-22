<div class="row">
    <!-- Product gallery-->
    <div class="col-lg-7 pr-lg-0">
        <div class="cz-product-gallery">
            <div class="cz-preview order-sm-2">
                @foreach($currentProduct->getImages() as $key => $value)
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
            <div class="cz-thumblist order-sm-1">
                @foreach($currentProduct->getImages() as $key => $value)
                    <a class="cz-thumblist-item" href="#img-{{$key}}"><img src="{{ url($value->path) }}" alt="Product thumb"></a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Product details-->
    <div class="col-lg-5 pt-4 pt-lg-0">
        <div class="product-details ml-auto pb-3">
{{--             <div class="h3 font-weight-normal text-accent mb-3 mr-1">{{ currencyFormat($product->price, 'CLP', true) }}</div>
 --}}            <!--
                <div class="font-size-sm mb-4"><span class="text-heading font-weight-medium mr-1">Color:</span><span class="text-muted" id="colorOption">Dark blue/Orange</span></div>
            -->
            <div class="position-relative mr-n4 mb-3">
                <!--
                    <div class="custom-control custom-option custom-control-inline mb-2">
                        <input class="custom-control-input" type="radio" name="color" id="color1" data-label="colorOption" value="Dark blue/Orange" checked>
                        <label class="custom-option-label rounded-circle" for="color1"><span class="custom-option-color rounded-circle" style="background-color: #f25540;"></span></label>
                    </div>
                    <div class="custom-control custom-option custom-control-inline mb-2">
                        <input class="custom-control-input" type="radio" name="color" id="color2" data-label="colorOption" value="Dark blue/Green">
                        <label class="custom-option-label rounded-circle" for="color2"><span class="custom-option-color rounded-circle" style="background-color: #65805b;"></span></label>
                    </div>
                    <div class="custom-control custom-option custom-control-inline mb-2">
                        <input class="custom-control-input" type="radio" name="color" id="color3" data-label="colorOption" value="Dark blue/White">
                        <label class="custom-option-label rounded-circle" for="color3"><span class="custom-option-color rounded-circle" style="background-color: #f5f5f5;"></span></label>
                    </div>
                    <div class="custom-control custom-option custom-control-inline mb-2">
                        <input class="custom-control-input" type="radio" name="color" id="color4" data-label="colorOption" value="Dark blue/Black">
                        <label class="custom-option-label rounded-circle" for="color4"><span class="custom-option-color rounded-circle" style="background-color: #333;"></span></label>
                    </div>
                -->
                <div class="product-badge product-available mt-n5"><i class="czi-security-check"></i>Producto disponible</div>
            </div>
            <button wire:click="testFunction">test</button>
            @foreach ($options as $key => $option)
                <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center pb-1">
                        <label class="font-weight-medium" for="product-size">{{ $option['name'] }}</label><a class="nav-link-style font-size-sm" href="#size-chart" data-toggle="modal"><i class="czi-ruler lead align-middle mr-1 mt-n1"></i>Size guide</a>
                    </div>
                    <select {{-- class="custom-select" --}} 
                        wire:change="updatedOptions"
                        wire:model="options.{{ $key }}.selectedValue"
                        name="attribute-{{ $option['id'] }}" 
                        {{-- @if(!$option['enableOptions']) disabled @endif --}}
                    >
                        @foreach ($option['items'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <div class="d-flex align-items-center pt-2 pb-4">
                <select class="custom-select mr-3" style="width: 5rem;">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button class="btn btn-primary btn-shadow btn-block" type="button"><i class="czi-cart font-size-lg mr-2"></i>Agregar al carro</button>
            </div>
            <!--
                <div class="d-flex mb-4">
                    <div class="w-100 mr-3">
                        <button class="btn btn-secondary btn-block" type="button"><i class="czi-heart font-size-lg mr-2"></i><span class='d-none d-sm-inline'>Add to </span>Wishlist</button>
                    </div>
                    <div class="w-100">
                        <button class="btn btn-secondary btn-block" type="button"><i class="czi-compare font-size-lg mr-2"></i>Compare</button>
                    </div>
                </div>
            -->
            <!-- Product panels-->
            <div class="accordion mb-4" id="productPanels">
                <div class="card">
                    <div class="card-header">
                        <h3 class="accordion-heading"><a href="#shippingOptions" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="shippingOptions"><i class="czi-delivery text-muted lead align-middle mt-n1 mr-2"></i>Opciones de envío<span class="accordion-indicator"></span></a></h3>
                    </div>
                    <div class="collapse show" id="shippingOptions" data-parent="#productPanels">
                        <div class="card-body font-size-sm">
                            <div class="d-flex justify-content-between border-bottom pb-2">
                                <div>
                                    <div class="font-weight-semibold text-dark">Local courier shipping</div>
                                    <div class="font-size-sm text-muted">2 - 4 days</div>
                                </div>
                                <div>$16.50</div>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div>
                                    <div class="font-weight-semibold text-dark">UPS ground shipping</div>
                                    <div class="font-size-sm text-muted">4 - 6 days</div>
                                </div>
                                <div>$19.00</div>
                            </div>
                            <div class="d-flex justify-content-between pt-2">
                                <div>
                                    <div class="font-weight-semibold text-dark">Local pickup from store</div>
                                    <div class="font-size-sm text-muted">&mdash;</div>
                                </div>
                                <div>$0.00</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="accordion-heading"><a class="collapsed" href="#localStore" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="localStore"><i class="czi-location text-muted font-size-lg align-middle mt-n1 mr-2"></i>Enviar a casa<span class="accordion-indicator"></span></a></h3>
                    </div>
                    <div class="collapse" id="localStore" data-parent="#productPanels">
                        <div class="card-body">
                            <select class="custom-select">
                                <option value>Selecciona tu comuna</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Belgium">Belgium</option>
                                <option value="France">France</option>
                                <option value="Germany">Germany</option>
                                <option value="Spain">Spain</option>
                                <option value="UK">United Kingdom</option>
                                <option value="USA">USA</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sharing-->
            {{-- <h6 class="d-inline-block align-middle font-size-base my-2 mr-2">Share:</h6><a class="share-btn sb-twitter mr-2 my-2" href="#"><i class="czi-twitter"></i>Twitter</a><a class="share-btn sb-instagram mr-2 my-2" href="#"><i class="czi-instagram"></i>Instagram</a><a class="share-btn sb-facebook my-2" href="#"><i class="czi-facebook"></i>Facebook</a> --}}
        </div>
    </div>
</div>
