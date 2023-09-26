<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section("title-meta") ?>
<?php echo view('partials/title-meta', array('title' => 'Soluciones de Medición')); ?>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="page-content">
    <div class="container-fluid">

        <?php echo view('partials/page-title', array('pagetitle' => '', 'title' => 'Soluciones de Medición')); ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="card-title mb-2 mb-md-0">Tabla de Soluciones de Medición</h5>
                        <div class="mt-2 mt-md-0 float-md-right">
                            <a href="/admin/soluciones/crear" class="btn btn-success btn-label waves-effect waves-light rounded-pill">
                                <i class="ri-add-circle-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Agregar Solución
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="measurementSolutions-table" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Icono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="d-flex align-items-center fw-medium">
                                            <p>Medidores Residenciales</p>
                                        </div>
                                    </td>
                                    <td>Icono.jpeg</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="btn btn-primary btn-icon waves-effect waves-light" style="width: 48%;"><i class="ri-edit-2-fill ri-lg"></i></a>
                                            <a href="#" class="btn btn-danger btn-icon waves-effect waves-light" style="width: 48%;"><i class="ri-delete-bin-5-line ri-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="d-flex align-items-center fw-medium">
                                            <p>Medidores Industriales</p>
                                        </div>
                                    </td>
                                    <td>Icono.jpeg</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="btn btn-primary btn-icon waves-effect waves-light" style="width: 48%;"><i class="ri-edit-2-fill ri-lg"></i></a>
                                            <a href="#" class="btn btn-danger btn-icon waves-effect waves-light" style="width: 48%;"><i class="ri-delete-bin-5-line ri-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <div class="d-flex align-items-center fw-medium">
                                            <p>Medición Remota</p>
                                        </div>
                                    </td>
                                    <td>Icono.jpeg</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="btn btn-primary btn-icon waves-effect waves-light" style="width: 48%;"><i class="ri-edit-2-fill ri-lg"></i></a>
                                            <a href="#" class="btn btn-danger btn-icon waves-effect waves-light" style="width: 48%;"><i class="ri-delete-bin-5-line ri-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        <div class="d-flex align-items-center fw-medium">
                                            <p>Calidad del agua</p>
                                        </div>
                                    </td>
                                    <td>Icono.jpeg</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="btn btn-primary btn-icon waves-effect waves-light" style="width: 48%;"><i class="ri-edit-2-fill ri-lg"></i></a>
                                            <a href="#" class="btn btn-danger btn-icon waves-effect waves-light" style="width: 48%;"><i class="ri-delete-bin-5-line ri-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Icono</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?= $this->endSection() ?>


<?= $this->section("js") ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/r-2.5.0/datatables.min.js"></script>


<script src="/assets/admin/js/datatables-general-config.min.js"></script>
<script src="/assets/admin/js/measurementSolution.min.js"></script>
<?= $this->endSection() ?>