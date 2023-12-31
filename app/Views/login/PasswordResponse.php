<?= $this->include('partials/main') ?>

<head>

    <?= view('partials/title-meta', ['title' => 'Contraseña registrada']); ?>

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
        <div class="auth-page-content mt-5">
            <div class="container">

                <div class="row justify-content-center mt-5">
                    <div class="col-md-8 col-lg-6 col-xl-5 mt-5">
                        <div class="card mt-4">
                            <?php
                            $response = session()->get('response') ?? $response = [
                                'type'    => 'danger',
                                'title'   => '¡Oops!',
                                'message' => 'Parece que no cuenta con el permiso para acceder a esta página',
                            ];
if ($response) { ?>
                                <?= view('login/response', ['response' => $response]) ?>
                            <?php } ?>
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
</body>

</html>