<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section("title-meta") ?>
<?php echo view('partials/title-meta', array('title' => 'Categoria')); ?>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<link rel="stylesheet" href="/assets/admin/css/filepond.min.css">
<link href="/assets/common/css/sweetAlert.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="page-content">
    <div class="container-fluid">
        <div class="container-sm">

            <h1 class="text-center">Test Files Form</h1>

            <div class="d-flex justify-content-start align-items-center mb-3">
                <a href="/admin/testFiles" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                    <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
                </a>
            </div>

            <!-- Filepond Config -->
            <form id="form" autocomplete="off" class="needs-validation" novalidate method="POST">
                <div class="row justify-content-center">
                    <div class="col-sm-11">

                        <!-- Just a text input -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Nombre</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <?= validation_show_error('name', 'validationError') ?>
                                        <label class="card-text" for="name">Ingresa un nombre</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Ingrese el título" value="<?= old("name") ?? ''?>" required>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <!-- Images -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Imagenes</h4>
                                    </div><!-- end card header -->
                                    <?= view("admin/components/inputFilePond", [
                                        "config" => $config["image"],
                                    ]) ?>

                                </div>
                                <!-- end card -->
                            </div>
                        </div>

                        <div class="row">
                            <!-- Íconos (SVG) -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Íconos (SVG)</h4>
                                    </div><!-- end card header -->

                                    <?= view("admin/components/inputFilePond", [
                                        "config" => $config['icon'],
                                    ]) ?>
                                </div>
                                <!-- end card -->
                            </div>
                        </div>

                        <div class="row">
                            <!-- Videos -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Video</h4>
                                    </div><!-- end card header -->

                                    <?= view("admin/components/inputFilePond", [
                                        "config" => $config["video"],
                                    ]) ?>

                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>

                        <div class="row">
                            <!-- Documents -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Documents (PDF)</h4>
                                    </div><!-- end card header -->
                                    <?= view("admin/components/inputFilePond", [
                                        "config" => $config['datasheet'],
                                    ]) ?>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-primary w-lg">Guardar</button>
                        </div>
                    </div>
                </div>
                <div class="filepondConfig">
                    <input id="config" type="hidden" value="<?= esc(json_encode($config)) ?? "" ?>">
                </div>
            </form>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?= $this->endSection() ?>


<?= $this->section("js") ?>
<script src="/assets/admin/js/testFiles.min.js"></script>
<?= $this->endSection() ?>