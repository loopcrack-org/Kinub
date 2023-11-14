<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section('title-meta') ?>
<?= view('partials/title-meta', ['title' => 'Categoria']); ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/admin/css/filepond.min.css">
<link href="/assets/common/css/sweetAlert.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
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

                        <!-- Images input -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Imagenes</h4>
                                    </div><!-- end card header -->
                                    <?= view('admin/components/inputFilePond', ['config' => $filepondConfig['image']]) ?>
                                </div>
                                <!-- end card -->
                            </div>
                        </div>

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-primary w-lg">Guardar</button>
                        </div>
                    </div>
                </div>
                <div class="filepondConfig">
                    <input id="config" type="hidden" value="<?= htmlspecialchars(json_encode($filepondConfig)) ?? '' ?>">
                </div>
            </form>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script src="/assets/admin/js/filepond-general-config.min.js"></script>
<?= $this->endSection() ?>