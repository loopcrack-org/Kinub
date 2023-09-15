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

        <form id="createproduct-form" autocomplete="off" class="needs-validation" novalidate>
            <div class="row justify-content-center">
                <div class="col-sm-11">
                    <div class="d-flex justify-content-start align-items-center mb-3">
                        <a href="/admin/categorias" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                            <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label mb-0" for="category-title-input">
                                        <h5 class="card-title mb-0">Titulo de la categoría</h5>
                                    </label>
                                </div>
                                <div class="card-body">
                                    <div class="hstack gap-3 align-items-start">
                                        <input type="text" class="form-control" name="category_title" id="category-title-input" value="" placeholder="Ingrese el título" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Tags de la categoría</h5>
                                </div>
                                <div class="card-body">
                                    <div class="hstack gap-3 align-items-start">
                                        <div class="flex-grow-1">
                                            <input class="form-control" name="category_tags" id="choices-text-remove-button" data-choices data-choices-multiple-remove="true" type="text"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Icono</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <input type="file" class="filepond filepond-input-multiple" name="category_icon" data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3">
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Imagen de fondo</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <input type="file" class="filepond filepond-input-multiple" name="category_bgImg" data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3">
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
<script src="/assets/js/admin/plugins.js"></script>

<!-- filepond js -->
<script src="/assets/libs/filepond/filepond.min.js"></script>
<script src="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
<script src="/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
<script src="/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

<script src="/assets/js/pages/form-file-upload-category.init.js"></script>
<?= $this->endSection() ?>