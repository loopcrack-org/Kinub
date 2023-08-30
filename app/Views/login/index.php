<?= $this->include('partials/main') ?>

<head>

    <?php echo view('partials/title-meta', array('title'=>'Iniciar Sesión')); ?>

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
        <div class="auth-page-content mt-sm-5">
            <div class="container">
                
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 shadow-lg">
                            
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center mb-4 text-white-50">
                                                <img class="d-inline-block auth-logo" src="https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829" alt="logo kinub">
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-primary">Bienvenido de Vuelta!</h5>
                                    <p class="text-muted">Inicie Sesión</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="/login" method="POST">
                                        <?php $errors = session()->get('errors'); ?>
                                        
                                        <?php if(isset($errors["credentials"])): ?>
                                            <!-- alert credentials -->
                                            <div class="alert alert-warning" role="alert">
                                                <?= $errors["credentials"] ?>
                                            </div>
                                        <?php endif ?>
                                        <!-- email -->
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Correo</label>
                                            <input name="email" type="email" class="form-control <?= isset($errors["email"]) ? 'is-invalid' : '' ?>" id="username validation" placeholder="Ej: jhonson@gmail.com" value="<?= old("email") ?>"  required>
                                            <?php if(isset($errors["email"])): ?>
                                                <div class="invalid-feedback">
                                                    <?= $errors["email"] ?>
                                                </div> 
                                            <?php endif ?>
                                        </div>
                                        <!-- password -->
                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="/login/password/reset" class="text-muted">Olvidaste tu contraseña?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Contraseña</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input name="password" type="password" class="form-control pe-5 password-input <?= isset($errors["password"]) ? 'is-invalid' : '' ?>" placeholder="Ingresa tu contraseña" id="password-input" style="background-image:none" required>
                                                <?php if(isset($errors["password"])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $errors["password"] ?>
                                                    </div> 
                                                <?php endif ?>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
                                        <!-- button submit -->
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Iniciar Sesión</button>
                                        </div>
                                    </form>
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
    <script src="/assets/libs/particles/particles.js"></script>
    <!-- particles app js -->
    <script src="/assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="/assets/js/pages/password-addon.init.js"></script>
</body>
</html>