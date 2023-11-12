<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section("title-meta") ?>
<?php echo view('partials/title-meta', array('title' => 'Categoria')); ?>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link href="/assets/common/css/sweetAlert.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="page-content">
    <div class="container-fluid">

        <?php echo view('partials/page-title', array('title' => 'testFiles')); ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="card-title mb-2 mb-md-0">Tabla de tests</h5>
                        <div class="mt-2 mt-md-0 float-md-right">
                            <a href="/admin/testFiles/crear" class="btn btn-success btn-label waves-effect waves-light rounded-pill">
                                <i class="ri-add-circle-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Agregar test
                            </a>
                        </div>
                    </div>

                    <?php
                        if (session()->has('response')) {
                            $response = session()->get('response');
                            ?>
                    <div id="alert-deletedCategory" data-response="<?= esc(json_encode($response)) ?>"></div>
                    <?php }; ?>

                    <!-- card-header -->
                    <div class="card-body">
                        <table id="test-table" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Icono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tests as $test) { ?>
                                <tr>
                                    <td><?= $test["testId"] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center fw-medium">
                                            <p><?= $test["testName"] ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">

                                            <a href="/admin/testFiles/editar/<?= $test["testId"] ?>" class="btn btn-primary btn-icon waves-effect waves-light" style="width: 48%;"><i class="ri-edit-2-fill ri-lg"></i></a>

                                            <!-- <a href="#" class="btn btn-danger btn-icon waves-effect waves-light" data-id="<?=$test["testId"]?>" data-bs-toggle="modal" data-bs-target="#deleteCategoriesModal" style="width: 48%;"><i class="ri-delete-bin-5-line ri-lg"></i></a> -->
                                            <form class="btn btn-danger btn-icon waves-effect waves-light" style="min-width: 48%;" action="/admin/testFiles/borrar" method="POST">
                                                <input type="hidden" name="testId" value="<?= $test["testId"] ?>">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="ri-delete-bin-5-line ri-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- table -->
                    </div>
                    <!-- card-body -->
                </div>
                <!-- card -->

                <!-- Modal -->
                <div class="modal fade flip" id="deleteCategoriesModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mt-2 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#25a0e2,secondary:#00bd9d" style="width:130px;height:130px">
                                    </lord-icon>
                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                        <h4>¿Estás seguro?</h4>
                                        <p class="text-muted mx-4 mb-0">
                                            Eliminar un "tests" resultará en la eliminación permanente. Esta acción no se puede deshacer.</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="/admin/testFiles/borrar" method="post">
                                        <button type="submit" class="btn w-sm btn-primary" id="delete-record">¡Sí, bórralo!</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modal -->

            </div>
            <!-- col -->
        </div>
        <!-- row -->
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
<script src="/assets/admin/js/category.min.js"></script>
<script src="/assets/admin/js/alert-deleteElement.min.js"></script>
<?= $this->endSection() ?>