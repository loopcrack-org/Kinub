<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section("title-meta") ?>
<?php echo view('partials/title-meta', array('title' => 'Crear Solución')); ?>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<!-- Filepond css -->
<link rel="stylesheet" href="/assets/admin/css/filepond.min.css" type="text/css" />

<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="page-content">
    <div class="container-fluid">
        <?php echo view('partials/page-title', array('title' => 'Crear Solución', 'pagetitle' => 'Soluciones de Medición', 'pagetitleInner' => 'Crear Solución',)); ?>


        <div class="row justify-content-center">
            <div class="col-sm-11">
                <div class="d-flex justify-content-start align-items-center mb-3">
                    <a href="/admin/soluciones" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                        <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
                    </a>
                </div>
                <form id="createproduct-form" autocomplete="off" class="needs-validation" novalidate method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label mb-0" for="category-title-input">
                                        <h5 class="card-title mb-0">Titulo de la Solución de Medición</h5>
                                    </label>
                                </div>
                                <div class="card-body">
                                    <div class="hstack gap-3 align-items-start">
                                        <input type="text" class="form-control" name="name" id="name" value="" placeholder="Ingrese el título" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Descripción de la Solución de Medición</h5>
                                </div>
                                <div class="card-body">
                                    <div class="hstack gap-3 align-items-start">
                                        <div class="flex-grow-1">
                                            <textarea class="form-control" rows="3" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Icono</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <input type="file" class="filepond" name="icon">
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Imagen de fondo</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <input type="file" class="filepond" name="image">
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-primary w-lg">Guardar</button>
                    </div>
                </form>
                <!-- end form -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?= $this->endSection() ?>


<?= $this->section("js") ?>
<!-- filepond js -->
<script src="/assets/admin/js/form-file-upload-measurementSolution.init.min.js"></script>
<?= $this->endSection() ?>