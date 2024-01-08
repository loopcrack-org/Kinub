<?php use App\Utils\UrlGenerator; ?>
<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section('title-meta') ?>
<?= view('partials/title-meta', ['title' => 'Editar Solución']); ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- Filepond css -->
<link rel="stylesheet" href="<?= UrlGenerator::asset_url('admin-css','filepond.min.css') ?>" type="text/css" />
<link href="<?= UrlGenerator::asset_url('common-css','sweetAlert.min.css') ?>" rel="stylesheet" type="text/css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">
        <?= view('partials/page-title', ['title' => 'Editar Solución', 'titleUrl' => '/admin/soluciones', 'pagetitle' => 'Soluciones de Medición', 'pagetitleInner' => 'Editar Solución']); ?>


        <div class="row justify-content-center">
            <div class="col-sm-11">
                <div class="d-flex justify-content-start align-items-center mb-3">
                    <a href="/admin/soluciones" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                        <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
                    </a>
                </div>

                <form id="form" autocomplete="off" class="needs-validation" method="POST">

                    <?= $this->include('admin/typeSolutions/solutionsFormTemplate') ?>

                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-primary w-lg">Guardar</button>
                    </div>

                    <div class="filepondConfig">
                        <input id="config" type="hidden" value="<?= htmlspecialchars(json_encode($filepondConfig)) ?? '' ?>">
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


<?= $this->section('js') ?>
<script src="<?= UrlGenerator::asset_url('admin-js','alertElement.min.js') ?>"></script>
<!-- filepond js -->
<script src="<?= UrlGenerator::asset_url('admin-js','filepond-general-config.min.js') ?>"></script>
<?= $this->endSection() ?>
