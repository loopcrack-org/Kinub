<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section('title-meta') ?>
<?= view('partials/title-meta', ['title' => 'Editar Usuario']); ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">
        <?= view('partials/page-title', ['title' => 'Editar Usuario', 'titleUrl' => '/admin/usuarios', 'pagetitle' => 'Usuarios', 'pagetitleInner' => 'Editar Usuario']); ?>


        <div class="row justify-content-center">
            <div class="col-sm-11">
                <div class="d-flex justify-content-start align-items-center mb-3">
                    <a href="/admin/usuarios" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                        <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
                    </a>
                </div>
                <form id="createproduct-form" autocomplete="off" class="needs-validation" method="POST">
                    <!-- end row -->
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
                                    <div class="hstack gap-3 align-items-start">
                                        <input type="text" class="form-control" name="userFirstName" id="userFirstName" value="<?= $user['userFirstName']?>" placeholder="Ingrese el nombre del usuario a registrar" required>
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
                                    <div class="hstack gap-3 align-items-start">
                                        <input type="text" class="form-control" name="userLastName" id="userLastName" value="<?= $user['userLastName']?>" placeholder="Ingrese el apellido del usuario a registrar" required>
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
                                    <h5 class="card-title">Email</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-7 mb-2">
                                            <input type="email" class="form-control" name="userEmail" id="userEmail" value="<?= $user['userEmail']?>" placeholder="Ingrese un correo electrónico" required>
                                        </div>
                                        <div class="col-md-5 mb-2">
                                            <div class="alert alert-<?= ($user['confirmed']) ? 'success' : 'warning'?> alert-dismissible alert-label-icon label-arrow fade show mb-0">
                                                <i class="ri-<?= ($user['confirmed']) ? 'checkbox-circle' : 'error-warning'?>-line label-icon"></i><strong><?= ($user['confirmed']) ? 'Cuenta confirmada' : 'Cuenta por confirmar'?></strong>
                                            </div>
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