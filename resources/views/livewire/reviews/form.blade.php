<div class="col-md-5 mt-2 pt-4 mt-md-0 pt-md-0">
    <div class="bg-secondary py-grid-gutter px-grid-gutter rounded-lg">
        <h3 class="h4 pb-2">Escribir mi opinión</h3>
        <form class="needs-validation" method="post" novalidate>
            <div class="form-group">
                <label for="review-name">Tu nombre<span class="text-danger">*</span></label>
                <input class="form-control" type="text" required id="review-name">
                <div class="invalid-feedback">Por favor escribe tu nombre!</div>
                <small class="form-text text-muted">Se mostrará en el comentario.</small>
            </div>
            <div class="form-group">
                <label for="review-email">Tu email<span class="text-danger">*</span></label>
                <input class="form-control" type="email" required id="review-email">
                <div class="invalid-feedback">Por favor escribe un email válido!</div>
                <small class="form-text text-muted">Solo autenticación - no le enviaremos spam.</small>
            </div>
            <div class="form-group">
                <label for="review-rating">Clasificación<span class="text-danger">*</span></label>
                <select class="custom-select" required id="review-rating">
                    <option value="">Escoge un clasificación</option>
                    <option value="5">5 estrellas</option>
                    <option value="4">4 estrellas</option>
                    <option value="3">3 estrellas</option>
                    <option value="2">2 estrellas</option>
                    <option value="1">1 estrella</option>
                </select>
                <div class="invalid-feedback">Por favor elige una clasificación :D!</div>
            </div>
            <div class="form-group">
                <label for="review-text">Opinión<span class="text-danger">*</span></label>
                <textarea class="form-control" rows="6" required id="review-text"></textarea>
                <div class="invalid-feedback">Por favor escribe una opinión!</div>
                <small class="form-text text-muted">Your review must be at least 50 characters.</small>
            </div>
            <div class="form-group">
                <label for="review-pros">Pros</label>
                <textarea class="form-control" rows="2" placeholder="Separado por comas"
                            id="review-pros"></textarea>
            </div>
            <div class="form-group mb-4">
                <label for="review-cons">Contras</label>
                <textarea class="form-control" rows="2" placeholder="Separado por comas"
                            id="review-cons"></textarea>
            </div>
            <button class="btn btn-primary btn-shadow btn-block" type="submit">Enviar mi opinión</button>
        </form>
    </div>
</div>
