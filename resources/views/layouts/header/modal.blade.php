<!-- Sign in / sign up modal-->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="#signin-tab" data-toggle="tab" role="tab" aria-selected="true"><i class="czi-unlocked mr-2 mt-n1"></i>Inicia sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="#signup-tab" data-toggle="tab" role="tab" aria-selected="false"><i class="czi-user mr-2 mt-n1"></i>Regístrate</a></li>
                </ul>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body tab-content py-4">
                <form class="needs-validation tab-pane fade show active" autocomplete="off" novalidate id="signin-tab">
                    <div class="form-group">
                        <label for="si-email">Email</label>
                        <input class="form-control" type="email" id="si-email" placeholder="" required>
                        <div class="invalid-feedback">Por favor ingresa un email válido.</div>
                    </div>
                    <div class="form-group">
                        <label for="si-password">Contraseña</label>
                        <div class="password-toggle">
                            <input class="form-control" type="password" id="si-password" required>
                            <label class="password-toggle-btn">
                                <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Mostrar contraseña</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-wrap justify-content-between">
                        <div class="custom-control custom-checkbox mb-2">
                            <input class="custom-control-input" type="checkbox" id="si-remember">
                            <label class="custom-control-label" for="si-remember">Recordarme</label>
                        </div><a class="font-size-sm" href="#">¿Olvidaste tu contraseña??</a>
                    </div>
                    <button class="btn btn-primary btn-block btn-shadow" type="submit">Iniciar sesión</button>
                </form>
                <form class="needs-validation tab-pane fade" autocomplete="off" novalidate id="signup-tab">
                    <div class="form-group">
                        <label for="su-firstname">Nombre</label>
                        <input class="form-control" type="text" id="su-firstname" placeholder="Escribe aquí tu nombre" required>
                        <div class="invalid-feedback">Por favor ingresa tu nombre.</div>
                    </div>
                    <div class="form-group">
                        <label for="su-lastname">Apellido</label>
                        <input class="form-control" type="text" id="su-lastname" placeholder="Escribe aquí tu apellido" required>
                        <div class="invalid-feedback">Por favor ingresa tu apellido.</div>
                    </div>
                    <div class="form-group">
                        <label for="su-email">Email</label>
                        <input class="form-control" type="email" id="su-email" placeholder="Escribe aquí tu email" required>
                        <div class="invalid-feedback">Por favor ingresa un email válido.</div>
                    </div>
                    <div class="form-group">
                        <label for="su-password">Contraseña</label>
                        <div class="password-toggle">
                            <input class="form-control" type="password" id="su-password" required>
                            <label class="password-toggle-btn">
                                <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Mostrar contraseña</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="su-password-confirm">Confirmar contraseña</label>
                        <div class="password-toggle">
                            <input class="form-control" type="password" id="su-password-confirm" required>
                            <label class="password-toggle-btn">
                                <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Mostrar contraseña</span>
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-shadow" type="submit">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
