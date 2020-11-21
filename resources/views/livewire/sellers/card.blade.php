<div class="card product-card">
    <a class="card-img-top d-block overflow-hidden" href="{{url('seller-shop/'.$seller->id)}}">
        @if($seller->logo)
            <img class="w-100 min-height-8 max-height-10" src="{{ url($seller->logo) }}" alt="">
        @else
            <img class="w-100 min-height-8 max-height-10" src="{{ url('/img/default/default-product-image.png') }}" alt="">
        @endif     
    </a>
    <div class="card-body py-2">
        <h3 class="product-title font-size-sm"><a href="{{url('seller-shop/'.$seller->id)}}">{{ $seller->visible_name }}</a></h3>
        <div class="d-flex justify-content-between">
            
        </div>
    </div>
    <div class="card-body card-body-hidden">
        <div class="text-center">
            <a class="nav-link-style font-size-ms" href="{{url('seller-shop/'.$seller->id)}}">
                <i class="czi-eye align-middle mr-1"></i>Ver tienda
            </a>
        </div>
    </div>
</div>
