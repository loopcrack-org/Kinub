<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section("title-meta") ?>
<?php echo view('partials/title-meta', array('title' => 'Categoria')); ?>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<link rel="stylesheet" href="/assets/admin/css/filepond.min.css">
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="page-content">
    <div class="container-fluid">
        <div class="container-sm">

            <h1 class="text-center">Test Files Form</h1>

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
                                        <p class="card-text">Ingresa un nombre</p>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Ingrese el título" required>
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

                                    <div class="card-body">
                                        <p class="card-text">Ingresa imagenes en formato jpg, jpeg o png</p>
                                        <fieldset id="images-files">
                                            <?php if (isset($filesSaved['img'])) : ?>
                                                <ul>
                                                    <?php foreach ($filesSaved['img'] as $file) : ?>
                                                        <li>
                                                            <input value="<?= $file ?>" data-type="local" checked type="checkbox" />
                                                        </li>
                                                    <?php endforeach ?>
                                                </ul>
                                            <?php endif ?>
                                            <input type="file" name="image">
                                        </fieldset>
                                    </div>
                                    <!-- end card body -->
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

                                    <div class="card-body">
                                        <p class="card-text">Ingresa un ícono en formato svg</p>
                                        <fieldset id="svg-files">
                                            <?php if (isset($filesSaved['svg'])) : ?>
                                                <ul>
                                                    <?php foreach ($filesSaved['svg'] as $file) : ?>
                                                        <li>
                                                            <input value="<?= $file ?>" data-type="local" checked type="checkbox" />
                                                        </li>
                                                    <?php endforeach ?>
                                                </ul>
                                            <?php endif ?>
                                            <input type="file" name="svg">
                                        </fieldset>
                                    </div>
                                    <!-- end card body -->
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

                                    <div class="card-body">
                                        <p class="card-text">Ingresa videos en formato mp4</p>
                                        <fieldset id="video-files">
                                            <?php if (isset($filesSaved['video'])) : ?>
                                                <ul>
                                                    <?php foreach ($filesSaved['video'] as $file) : ?>
                                                        <li>
                                                            <input value="<?= $file ?>" data-type="local" checked type="checkbox" />
                                                        </li>
                                                    <?php endforeach ?>
                                                </ul>
                                            <?php endif ?>
                                            <input type="file" name="video">
                                        </fieldset>
                                    </div>
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

                                    <div class="card-body">
                                        <p class="card-text">Ingresa archivos en formato pdf</p>
                                        <fieldset id="document-files">
                                            <?php if (isset($filesSaved['pdf'])) : ?>
                                                <ul>
                                                    <?php foreach ($filesSaved['pdf'] as $file) : ?>
                                                        <li>
                                                            <input value="<?= $file ?>" data-type="local" checked type="checkbox" />
                                                        </li>
                                                    <?php endforeach ?>
                                                </ul>
                                            <?php endif ?>
                                            <input type="file" name="pdf">
                                        </fieldset>
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
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?= $this->endSection() ?>


<?= $this->section("js") ?>
<script src="/assets/admin/js/testFiles.min.js"></script>
<?= $this->endSection() ?>