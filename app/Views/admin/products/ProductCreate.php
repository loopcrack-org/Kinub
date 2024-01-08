<?php use App\Utils\UrlGenerator; ?>
<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section('title-meta') ?>
<?= view('partials/title-meta', ['title' => 'Crear Producto']); ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- Filepond css -->
<link rel="stylesheet" href="<?= UrlGenerator::asset_url('admin-css','filepond.min.css') ?>" type="text/css" />
<link href="<?= UrlGenerator::asset_url('common-css','sweetAlert.min.css') ?>" rel="stylesheet">
<link href="<?= UrlGenerator::asset_url('admin-css','wysiwyg.min.css') ?>" rel="stylesheet">
<link href="<?= UrlGenerator::asset_url('admin-css','tippy.min.css') ?>" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">
        <?= view('partials/page-title', ['title' => 'Crear producto', 'titleUrl' => '/admin/productos', 'pagetitle' => 'Producto', 'pagetitleInner' => 'Crear producto']); ?>

        <form id="form" autocomplete="off" class="needs-validation" method="POST">
            <div class="row justify-content-center">
                <div class="col-sm-11">

                    <div class="d-flex justify-content-start align-items-center mb-3">
                        <a href="/admin/productos" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                            <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
                        </a>
                    </div>

                    <?= $this->include('admin/products/productsFormTemplate', ['fileConfig' => $fileConfig, 'categories' => $categories]) ?>

                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-primary w-lg">Guardar</button>
                    </div>
                </div>
            </div>
            <div class="filepondConfig">
                <input id="config" type="hidden" value="<?= esc(json_encode($fileConfig)) ?? '' ?>">
            </div>
        </form>
        <!-- end form -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?= $this->endSection() ?>


<?= $this->section('js') ?>
<!-- filepond js -->
<script src="<?= UrlGenerator::asset_url('admin-js','alertElement.min.js') ?>"></script>
<script src="<?= UrlGenerator::asset_url('admin-js','filepond-general-config.min.js') ?>"></script>
<script src="<?= UrlGenerator::asset_url('admin-js','wysiwyg-general-config.min.js') ?>"></script>
<script src="<?= UrlGenerator::asset_url('admin-js','productChoices.min.js') ?>"></script>
<script src="<?= UrlGenerator::asset_url('admin-js','keyValueInput.min.js') ?>"></script>
<?= $this->endSection() ?>
