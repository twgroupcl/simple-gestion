<div class="row pb-3">
    <div class="col-lg-4 col-md-5">
        <h2 class="h3 mb-4">{{ $count }} Evaluaciones</h2>
        <div class="star-rating mr-2">
                <i class="{{ round($generalRating) >= 1 ? 'czi-star-filled font-size-sm text-accent' : 'czi-star font-size-sm text-muted mr-1' }} mr-1"></i>
                <i class="{{ round($generalRating) >= 2 ? 'czi-star-filled font-size-sm text-accent' : 'czi-star font-size-sm text-muted mr-1' }} mr-1"></i>
                <i class="{{ round($generalRating) >= 3 ? 'czi-star-filled font-size-sm text-accent' : 'czi-star font-size-sm text-muted mr-1' }} mr-1"></i>
                <i class="{{ round($generalRating) >= 4 ? 'czi-star-filled font-size-sm text-accent' : 'czi-star font-size-sm text-muted mr-1' }} mr-1"></i>
                <i class="{{ round($generalRating) >= 5 ? 'czi-star-filled font-size-sm text-accent' : 'czi-star font-size-sm text-muted mr-1' }} mr-1"></i>
        </div>
        <span class="d-inline-block align-middle">{{ $generalRating }} Calificación general</span>
        {{-- <p class="pt-3 font-size-sm text-muted">58 de 74 (77%)<br>clientes recomendaron este producto</p> --}}
    </div>
    <div class="col-lg-8 col-md-7">
        <div class="d-flex align-items-center mb-2">
            <div class="text-nowrap mr-3"><span class="d-inline-block align-middle text-muted">5</span><i
                    class="czi-star-filled font-size-xs ml-1"></i></div>
            <div class="w-100">
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $starPercentages['five'] }}%;"
                         aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <span class="text-muted ml-3">{{ $stars['five'] }}</span>
        </div>
        <div class="d-flex align-items-center mb-2">
            <div class="text-nowrap mr-3"><span class="d-inline-block align-middle text-muted">4</span><i
                    class="czi-star-filled font-size-xs ml-1"></i></div>
            <div class="w-100">
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar" role="progressbar" style="width: {{ $starPercentages['four'] }}%; background-color: #a7e453;"
                         aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <span class="text-muted ml-3">{{ $stars['four'] }}</span>
        </div>
        <div class="d-flex align-items-center mb-2">
            <div class="text-nowrap mr-3"><span class="d-inline-block align-middle text-muted">3</span><i
                    class="czi-star-filled font-size-xs ml-1"></i></div>
            <div class="w-100">
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar" role="progressbar" style="width: {{ $starPercentages['three'] }}%; background-color: #ffda75;"
                         aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <span class="text-muted ml-3">{{ $stars['three'] }}</span>
        </div>
        <div class="d-flex align-items-center mb-2">
            <div class="text-nowrap mr-3"><span class="d-inline-block align-middle text-muted">2</span><i
                    class="czi-star-filled font-size-xs ml-1"></i></div>
            <div class="w-100">
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar" role="progressbar" style="width:{{ $starPercentages['two'] }}%; background-color: #fea569;"
                         aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <span class="text-muted ml-3">{{ $stars['two'] }}</span>
        </div>
        <div class="d-flex align-items-center">
            <div class="text-nowrap mr-3"><span class="d-inline-block align-middle text-muted">1</span><i
                    class="czi-star-filled font-size-xs ml-1"></i></div>
            <div class="w-100">
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width:{{ $starPercentages['one'] }}%;" aria-valuenow="4"
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <span class="text-muted ml-3">{{ $stars['one'] }}</span>
        </div>
    </div>
</div>
