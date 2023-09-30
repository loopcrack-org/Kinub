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
                                        <input type="file" id="images-files" name="image">
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
                                        <input type="file" id="svg-files" name="image">
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
                                        <input type="file" id="video-files" name="image">
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
                                        <input type="file" id="document-files" name="image">
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