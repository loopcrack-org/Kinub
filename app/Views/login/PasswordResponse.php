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
</body>

</html>