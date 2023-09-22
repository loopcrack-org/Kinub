<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section("title-meta") ?>
<?php echo view('partials/title-meta', array('title' => 'Crear Solución')); ?>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<!-- Filepond css -->
<link rel="stylesheet" href="/assets/libs/filepond/filepond.min.css" type="text/css" />
<link rel="stylesheet" href="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">


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

                    <?= $this->include('admin/typeSolutions/solutionsFormTemplate') ?>

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
<script src="/assets/js/admin/plugins.js"></script>

<!-- filepond js -->
<script src="/assets/libs/filepond/filepond.min.js"></script>
<script src="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
<script src="/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
<script src="/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

<script src="/assets/js/pages/form-file-upload-img.init.js"></script>
<?= $this->endSection() ?>