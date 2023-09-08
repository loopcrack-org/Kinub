<?= $this->include('partials/main') ?>

<head>

    <?php echo view('partials/title-meta', array('title' => 'Categoria')); ?>

    <?= $this->include('partials/head-css') ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?= $this->include('partials/menu') ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <?php echo view('partials/page-title', array('pagetitle' => 'Pages', 'title' => 'Categorías')); ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Tabla de Categorías</h5>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row justify-content-end">
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-success btn-label waves-effect waves-light rounded-pill"><i class="ri-add-circle-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Agregar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Icono</th>
                                                <th>Imagen</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>
                                                    <div class="d-flex align-items-center fw-medium">
                                                        <a href="javascript:void(0);">Telemetría</a>
                                                    </div>
                                                </td>
                                                <td>Icono.jpeg</td>
                                                <td>Imagen.jpeg</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-edit-2-fill"></i></button>
                                                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>02</td>
                                                <td>
                                                    <div class="d-flex align-items-center fw-medium">
                                                        <a href="javascript:void(0);">Serie E</a>
                                                    </div>
                                                </td>
                                                <td>Icono.jpeg</td>
                                                <td>Imagen.jpeg</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-edit-2-fill"></i></button>
                                                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>03</td>
                                                <td>
                                                    <div class="d-flex align-items-center fw-medium">
                                                        <a href="javascript:void(0);">Software</a>
                                                    </div>
                                                </td>
                                                <td>Icono.jpeg</td>
                                                <td>Imagen.jpeg</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-edit-2-fill"></i></button>
                                                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>04</td>
                                                <td>
                                                    <div class="d-flex align-items-center fw-medium">
                                                        <a href="javascript:void(0);">Serie M</a>
                                                    </div>
                                                </td>
                                                <td>Icono.jpeg</td>
                                                <td>Imagen.jpeg</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-edit-2-fill"></i></button>
                                                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>05</td>
                                                <td>
                                                    <div class="d-flex align-items-center fw-medium">
                                                        <a href="javascript:void(0);">Serie U</a>
                                                    </div>
                                                </td>
                                                <td>Icono.jpeg</td>
                                                <td>Imagen.jpeg</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-edit-2-fill"></i></button>
                                                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>06</td>
                                                <td>
                                                    <div class="d-flex align-items-center fw-medium">
                                                        <a href="javascript:void(0);">Serie L</a>
                                                    </div>
                                                </td>
                                                <td>Icono.jpeg</td>
                                                <td>Imagen.jpeg</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-edit-2-fill"></i></button>
                                                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>07</td>
                                                <td>
                                                    <div class="d-flex align-items-center fw-medium">
                                                        <a href="javascript:void(0);">Serie I</a>
                                                    </div>
                                                </td>
                                                <td>Icono.jpeg</td>
                                                <td>Imagen.jpeg</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-edit-2-fill"></i></button>
                                                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?= $this->include('partials/footer') ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <?= $this->include('partials/customizer') ?>

    <?= $this->include('partials/vendor-scripts') ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="/assets/js/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="/assets/js/admin/app.js"></script>


</body>

</html>