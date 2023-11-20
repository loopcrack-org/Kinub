<?= $this->include('partials/main') ?>

<head>

    <?= view('partials/title-meta', ['title' => 'Inicio']); ?>
    <?= $this->include('partials/head-css') ?>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?= $this->include('partials/menu') ?>

        <div class="main-content">
            <div class="page-content">

                <div class="row justify-content-center">
                    <div class="col-sm-11">
                        <h1>Bienvenido</h1>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <a href="/admin/nosotros">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-medium text-muted mb-0">Sección Sobre Nosotros</p>
                                                    <h2 class="d-flex align-items-center gap-2 mt-4 ff-secondary fw-semibold"><i data-feather="users" class="icon-dual"></i> <span>Sobre Nosotros</span></h2>
                                                </div>
                                                <div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-primary-subtle rounded-circle fs-2">
                                                            <i data-feather="external-link" class="text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div><!-- end card body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <a href="/admin/soluciones">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-medium text-muted mb-0">Página de soluciones de medición</p>
                                                    <h2 class="d-flex align-items-center gap-2 mt-4 ff-secondary fw-semibold"><i data-feather="tool" class="icon-dual"></i> <span>Soluciones de Medición</span></h2>
                                                </div>
                                                <div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-primary-subtle rounded-circle fs-2">
                                                            <i data-feather="external-link" class="text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div><!-- end card body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div> <!-- end row-->


                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <a href="/admin/productos">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-medium text-muted mb-0">Página de productos</p>
                                                    <h2 class="d-flex align-items-center gap-2 mt-4 ff-secondary fw-semibold"><i data-feather="truck" class="icon-dual"></i> <span>Productos</span></h2>
                                                </div>
                                                <div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-primary-subtle rounded-circle fs-2">
                                                            <i data-feather="external-link" class="text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div><!-- end card body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <a href="/admin/categorias">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-medium text-muted mb-0">Página de categorías</p>
                                                    <h2 class="d-flex align-items-center gap-2 mt-4 ff-secondary fw-semibold"><i data-feather="grid" class="icon-dual"></i> <span>Categorías</span></h2>
                                                </div>
                                                <div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-primary-subtle rounded-circle fs-2">
                                                            <i data-feather="external-link" class="text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div><!-- end card body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div> <!-- end row-->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <a href="/admin/certificados">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-medium text-muted mb-0">Página de certificados</p>
                                                    <h2 class="d-flex align-items-center gap-2 mt-4 ff-secondary fw-semibold"><i data-feather="file" class="icon-dual"></i> <span>Certificados</span></h2>
                                                </div>
                                                <div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-primary-subtle rounded-circle fs-2">
                                                            <i data-feather="external-link" class="text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div><!-- end card body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <a href="/admin/emails">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-medium text-muted mb-0">Página de emails</p>
                                                    <h2 class="d-flex align-items-center gap-2 mt-4 ff-secondary fw-semibold"><i data-feather="mail" class="icon-dual"></i> <span>Emails</span></h2>
                                                </div>
                                                <div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-primary-subtle rounded-circle fs-2">
                                                            <i data-feather="external-link" class="text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div><!-- end card body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div> <!-- end row-->

                        <?php $user = session()->get('user'); ?>
                        <?php if($user['admin'] === '1'): ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <a href="/admin/usuarios">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Página de usuarios</p>
                                                        <h2 class="d-flex align-items-center gap-2 mt-4 ff-secondary fw-semibold"><i data-feather="user" class="icon-dual"></i> <span>Usuarios</span></h2>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-primary-subtle rounded-circle fs-2">
                                                                <i data-feather="external-link" class="text-primary"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div><!-- end card body -->
                                    </div> <!-- end card-->
                                </div> <!-- end col-->
                            </div> <!-- end row-->
                        <?php endif ?>

                    </div><!-- end col-->
                </div><!-- end row-->
            </div> <!-- end page content-->
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?= $this->include('partials/vendor-scripts') ?>

    <!-- App js -->
    <script src="/assets/admin/js/app.min.js"></script>
</body>

</html>