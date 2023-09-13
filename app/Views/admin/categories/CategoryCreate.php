<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section("title-meta") ?>
<?php echo view('partials/title-meta', array('title' => 'Crear Categoría')); ?>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<!-- Filepond css -->
<link rel="stylesheet" href="/assets/libs/filepond/filepond.min.css" type="text/css" />
<link rel="stylesheet" href="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">


<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="page-content">
    <div class="container-fluid">
        <?php echo view('partials/page-title', array('pagetitle' => 'Crear categoría', 'title' => 'Crear categoría')); ?>


        <div class="d-flex justify-content-end align-items-center mb-3">
            <a href="/admin/categorias" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
            </a>
        </div>

        <form id="createproduct-form" autocomplete="off" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Subir icono</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <input type="file" class="filepond filepond-input-multiple" multiple name="category_icon" data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3">
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Subir imagen de fondo</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <input type="file" class="filepond filepond-input-multiple" multiple name="category_bgImg" data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3">
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">
                                    <h5 class="card-title mb-0">Titulo de la categoría</h5>
                                </label>
                                <input type="text" class="form-control" name="category_title" id="product-title-input" value="" placeholder="Ingrese el título" required>
                                <div class="invalid-feedback">Please Enter a product title.</div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tags de la categoría</h5>
                        </div>
                        <div class="card-body">
                            <div class="hstack gap-3 align-items-start">
                                <div class="flex-grow-1">
                                    <input class="form-control" name="category_tags" id="choices-text-remove-button" data-choices data-choices-multiple-remove="true" type="text" />
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-primary w-lg">Submit</button>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </form>
        <!-- end form -->
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

<script src="/assets/js/pages/form-file-upload.init.js"></script>
<?= $this->endSection() ?>