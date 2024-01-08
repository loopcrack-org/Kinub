<?php use App\Utils\UrlGenerator; ?>
<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section('title-meta') ?>
<?= view('partials/title-meta', ['title' => 'Crear Usuario']); ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">
        <?= view('partials/page-title', ['title' => 'Crear Usuario', 'titleUrl' => '/admin/usuarios', 'pagetitle' => 'Usuarios', 'pagetitleInner' => 'Crear Usuario']); ?>


        <div class="row justify-content-center">
            <div class="col-sm-11">
                <div class="d-flex justify-content-start align-items-center mb-3">
                    <a href="/admin/usuarios" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                        <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
                    </a>
                </div>

                <?php $errors = session()->get('errors'); ?>
                <form id="createproduct-form" autocomplete="off" class="needs-validation" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label mb-0" for="category-title-input">
                                        <h5 class="card-title mb-0">Nombre</h5>
                                    </label>
                                </div>
                                <!-- end card-header -->
                                <div class="card-body">
                                    <div>
                                        <input type="text" class="form-control <?= isset($errors['userFirstName']) ? 'is-invalid' : '' ?>" name="userFirstName" id="userFirstName" value="<?= old('userFirstName'); ?>" placeholder="Ingrese el nombre del usuario a registrar" required>
                                        <?php if (isset($errors['userFirstName'])) : ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['userFirstName'] ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Apellido</h5>
                                </div>
                                <!-- end card-header -->
                                <div class="card-body">
                                    <div>
                                        <input type="text" class="form-control <?= isset($errors['userLastName']) ? 'is-invalid' : '' ?>" name="userLastName" id="userLastName" value="<?= old('userLastName'); ?>" placeholder="Ingrese el apellido del usuario a registrar" required>
                                        <?php if (isset($errors['userLastName'])) : ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['userLastName'] ?>
                                            </div>
                                        <?php endif ?>
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
                                    <h5 class="card-title mb-0">Email</h5>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="flex-grow-1">
                                            <input type="email" class="form-control <?= isset($errors['userEmail']) ? 'is-invalid' : '' ?>" name="userEmail" id="userEmail" value="<?= old('userEmail'); ?>" placeholder="Ingrese un correo electrónico" required>
                                            <?php if (isset($errors['userEmail'])) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $errors['userEmail'] ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
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
<!-- particles js -->
<script src="<?= UrlGenerator::asset_url('admin-js','particles.min.js') ?>"></script>
<!-- particles app js -->
<script src="<?= UrlGenerator::asset_url('admin-js','particles.app.min.js') ?>"></script>
<?= $this->endSection() ?>
