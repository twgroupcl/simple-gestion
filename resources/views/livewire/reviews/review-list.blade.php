<div class="col-md-7">
    <div class="d-flex justify-content-end pb-4">
        <div class="form-inline flex-nowrap">
            <label class="text-muted text-nowrap mr-2 d-none d-sm-block" for="sort-reviews">Ordenar por:</label>
            <select class="custom-select custom-select-sm" id="sort-reviews">
                <option>Más recientes</option>
                <option>Más antiguos</option>
                <option>Más populares</option>
                <option>Calificación alta</option>
                <option>Calificación baja</option>
            </select>
        </div>
    </div>
    <!-- Review-->
    @forelse ($reviews as $review)
        <div class="product-review pb-4 mb-4 border-bottom">
            <div class="d-flex mb-3">
                <div class="media media-ie-fix align-items-center mr-4 pr-2">
                    {{-- <img class="rounded-circle"
                                                                                width="50"
                                                                                src="img/shop/reviews/01.jpg"
                                                                                alt="Rafael Marquez"/> --}}
                    <div class="media-body pl-3">
                        <h6 class="font-size-sm mb-0">{{ $review->customer->first_name }}</h6><span class="font-size-ms text-muted">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div>
                    <div class="star-rating">
                        <i class="sr-star {{ $review->rating >= 1 ? 'czi-star-filled active' : 'czi-star' }}"></i>
                        <i class="sr-star {{ $review->rating >= 2 ? 'czi-star-filled active' : 'czi-star' }}"></i>
                        <i class="sr-star {{ $review->rating >= 3 ? 'czi-star-filled active' : 'czi-star' }}"></i>
                        <i class="sr-star {{ $review->rating >= 4 ? 'czi-star-filled active' : 'czi-star' }}"></i>
                        <i class="sr-star {{ $review->rating >= 5 ? 'czi-star-filled active' : 'czi-star' }}"></i>
                    </div>
                    <div class="font-size-ms text-muted">83% de los usuarios consideraron útil esta revisión</div>
                </div>
            </div>
            <p class="font-size-md mb-2">{{ $review->comment }}</p>
            <ul class="list-unstyled font-size-ms pt-1">
                <li class="mb-1"><span class="font-weight-medium">Pros:&nbsp;</span>{{ $review->pros }}</li>
                <li class="mb-1"><span class="font-weight-medium">Contras:&nbsp;</span>{{ $review->cons }}</li>
            </ul>
            <div class="text-nowrap">
                <button class="btn-like" type="button">15</button>
                <button class="btn-dislike" type="button">3</button>
            </div>
        </div>
    @empty
        <h6>No hay opiniones</h6>
    @endforelse
    <div class="text-center">
        <button class="btn btn-outline-accent" type="button"><i class="czi-reload mr-2"></i>Cargar más
            opiniones
        </button>
    </div>
</div>