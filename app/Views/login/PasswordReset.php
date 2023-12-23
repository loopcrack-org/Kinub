<?= $this->include('partials/main') ?>

<head>

    <?= view('partials/title-meta', ['title' => 'Restablecer Contraseña']); ?>

    <?= $this->include('partials/head-css') ?>

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="/" class="d-inline-block auth-logo">
                                    <img class="d-inline-block auth-logo" src="https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829" alt="logo kinub">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Restablece tu contraseña</h5>
                                    <p class="text-muted">Tu nueva contraseña debe de ser diferente a la anterior</p>
                                </div>

                                <div class="p-2">
                                    <form method="POST">
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Contraseña</label>

                                            <?php $errors = session()->get('errors') ?>

                                            <div class="position-relative auth-pass-inputgroup">
                                                <input name="password" required type="password" class="form-control pe-5 password-input <?= isset($errors['password']) ? 'is-invalid' : '' ?>" style="background-image:none" onpaste="return false" placeholder="Ingresa tu nueva contraseña" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                                <?php if (isset($errors['password'])) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $errors['password'] ?>
                                                    </div>
                                                <?php endif ?>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none shadow-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="confirm-password-input">Confirmar Contraseña</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input name="confirm-password" required type="password" class="form-control pe-5 password-input <?= isset($errors['confirm-password']) ? 'is-invalid' : '' ?>" style="background-image:none" onpaste="return false" placeholder="Confirma tu contraseña" id="confirm-password-input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                                <?php if (isset($errors['confirm-password'])) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $errors['confirm-password'] ?>
                                                    </div>
                                                <?php endif ?>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none shadow-none text-muted password-addon" type="button"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
                                        <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13">La contraseña debe tener:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Mínimo <b>8 caracteres</b></p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">Una letra <b>minúscula</b> de la (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">Al menos una letra <b>mayúscula</b> de la (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">Al menos un <b>número</b> del (0-9)</p>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Restablecer Contraseña</button>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">He recordado mi contraseña... <a href="/login" class="fw-semibold text-primary text-decoration-underline"> Haz Click Aquí</a> </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->
    </div>
    <!-- end auth-page-wrapper -->
    <?= $this->include('partials/vendor-scripts') ?>

    <!-- particles js -->
    <script src="/assets/admin/js/particles.min.js"></script>
    <!-- particles app js -->
    <script src="/assets/admin/js/particles.app.min.js"></script>

    <!-- password-create init -->
    <script src="/assets/admin/js/passowrd-create.init.min.js"></script>
</body>

</html>