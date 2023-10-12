<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section("title-meta") ?>
<?php echo view('partials/title-meta', array('title' => 'Crear Categoría')); ?>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<!-- Filepond css -->
<link rel="stylesheet" href="/assets/admin/css/filepond.min.css" type="text/css" />


<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="page-content">
    <div class="container-fluid">
        <?php echo view('partials/page-title', array('title' => 'Crear categoría', "titleUrl" => "/admin/categorias", 'pagetitle' => 'Categoría', 'pagetitleInner' => 'Crear categoría',)); ?>

        <form id="createproduct-form" autocomplete="off" class="needs-validation"  method="POST">
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
        <!-- end form -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?= $this->endSection() ?>


<?= $this->section("js") ?>
<!-- filepond js -->
<script src="/assets/admin/js/form-file-upload-category.init.min.js"></script>
<?= $this->endSection() ?>