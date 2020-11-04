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
    <div class="product-review pb-4 mb-4 border-bottom">
        <div class="d-flex mb-3">
            <div class="media media-ie-fix align-items-center mr-4 pr-2"><img class="rounded-circle"
                                                                              width="50"
                                                                              src="img/shop/reviews/01.jpg"
                                                                              alt="Rafael Marquez"/>
                <div class="media-body pl-3">
                    <h6 class="font-size-sm mb-0">Rafael Marquez</h6><span class="font-size-ms text-muted">{{ today()->diffForHumans() }}</span>
                </div>
            </div>
            <div>
                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i
                        class="sr-star czi-star-filled active"></i><i
                        class="sr-star czi-star-filled active"></i><i
                        class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                </div>
                <div class="font-size-ms text-muted">83% de los usuarios consideraron útil esta revisión</div>
            </div>
        </div>
        <p class="font-size-md mb-2">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil
            impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est...</p>
        <ul class="list-unstyled font-size-ms pt-1">
            <li class="mb-1"><span class="font-weight-medium">Pros:&nbsp;</span>Consequuntur magni,
                voluptatem sequi, tempora
            </li>
            <li class="mb-1"><span class="font-weight-medium">Contras:&nbsp;</span>Architecto beatae, quis
                autem
            </li>
        </ul>
        <div class="text-nowrap">
            <button class="btn-like" type="button">15</button>
            <button class="btn-dislike" type="button">3</button>
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-outline-accent" type="button"><i class="czi-reload mr-2"></i>Cargar más
            opiniones
        </button>
    </div>
</div>