<?= $this->include('partials/main') ?>

<head>

    <?= view('partials/title-meta', ['title' => 'Olvide mi contraseña']); ?>

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
                        <div class="text-center mb-4 text-white-50">
                            <img class="d-inline-block auth-logo" src="https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829" alt="logo kinub">
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">¿Olvidaste tu contraseña?</h5>
                                    <p class="text-muted">¡Restablécela!</p>
                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl">
                                    </lord-icon>

                                </div>

                                <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                    Ingresa tu correo para enviarte las instrucciones
                                </div>

                                <?php $errors = session()->get('errors') ?>

                                <div class="p-2">
                                    <form action="/password_reset" method="post">
                                        <div class="mb-4">
                                            <label class="form-label">Correo</label>
                                            <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" placeholder="Ej: johnson@gmail.com" name="email" required value=<?= old('email'); ?>>

                                            <?php if (isset($errors['email'])) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $errors['email'] ?>
                                                </div>
                                            <?php endif ?>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-success w-100" type="submit">Enviar</button>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <p class="mb-0"> He recordado mi contraseña... <a href="/login" class="fw-semibold text-primary text-decoration-underline"> Haz click aquí</a> </p>
                                        </div>
                                    </form><!-- end form -->
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
    <!-- password-addon init -->
    <script src="/assets/admin/js/password-addon.init.min.js"></script>
</body>

</html>