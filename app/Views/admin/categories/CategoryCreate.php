<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section('title-meta') ?>
<?= view('partials/title-meta', ['title' => 'Crear Categoría']); ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- Filepond css -->
<link rel="stylesheet" href="/assets/admin/css/filepond.min.css" type="text/css" />
<link href="/assets/common/css/sweetAlert.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">
        <?= view('partials/page-title', ['title' => 'Crear categoría', 'titleUrl' => '/admin/categorias', 'pagetitle' => 'Categoría', 'pagetitleInner' => 'Crear categoría']); ?>

        <form id="form" autocomplete="off" class="needs-validation" method="POST">
            <div class="row justify-content-center">
                <div class="col-sm-11">
                    <div class="d-flex justify-content-start align-items-center mb-3">
                        <a href="/admin/categorias" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                            <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
                        </a>
                    </div>

                    <?= $this->include('admin/categories/categoriesFormTemplate') ?>

                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-primary w-lg">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="filepondConfig">
            <input id="config" type="hidden" value="<?= htmlspecialchars(json_encode($filepondConfig)) ?? '' ?>">
        </div>
        <!-- end form -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script src="/assets/admin/js/alertElement.min.js"></script>
<script src="/assets/admin/js/filepond-general-config.min.js"></script>
<?= $this->endSection() ?>