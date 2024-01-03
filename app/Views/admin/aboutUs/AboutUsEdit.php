<?php use App\Utils\UrlGenerator; ?>
<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section('title-meta') ?>
<?= view('partials/title-meta', ['title' => 'Sección Sobre Nosotros']); ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= UrlGenerator::asset_url('admin-css','filepond.min.css') ?>" type="text/css" />
<link href="<?= UrlGenerator::asset_url('common-css','sweetAlert.min.css') ?>" rel="stylesheet" type="text/css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <?= view('partials/page-title', ['title' => 'Sobre Nosotros']); ?>

        <div class="row justify-content-center">
            <div class="col-sm-11">
                <div class="d-flex justify-content-start align-items-center mb-3">
                    <a href="/admin" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                        <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
                    </a>
                </div>
                <form id="form" autocomplete="off" class="needs-validation" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Imagen</h4>
                                </div><!-- end card header -->

                                <?= view('admin/components/inputFilePond', ['config' => $filepondConfig['aboutUsImage']]) ?>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Video</h4>
                                </div><!-- end card header -->

                                <?= view('admin/components/inputFilePond', ['config' => $filepondConfig['aboutUsVideo']]) ?>
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
                                    <h5 class="card-title mb-0">Descripción de Sobre Nosotros</h5>
                                </div>
                                <div class="card-body">
                                    <div class="hstack gap-3 align-items-start">
                                        <?php $errors = session()->get('errors') ?>
                                        <div class="flex-grow-1">
                                            <textarea class="form-control <?= isset($errors['aboutUsText']) ? 'is-invalid' : '' ?>" rows="3" name="aboutUsText"><?= old('aboutUsText') ?? $aboutUsData['aboutUsText'] ?? ''?></textarea>
                                            <?= view('admin/templates/invalidInputError', ['error' => $errors['aboutUsText'] ?? null])?>
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

                    <input type="hidden" name="homePageId" value="<?= old('homePageId') ?? $aboutUsData['homePageId'] ?? ''?>">

                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-primary w-lg">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
    <div class="filepondConfig">
        <input id="config" type="hidden" value="<?= htmlspecialchars(json_encode($filepondConfig)) ?? '' ?>">
    </div>
    <?php
    if (session()->has('response')) {
        $response = session()->get('response');
        ?>
    <div id="alertElement" data-response="<?= htmlspecialchars(json_encode($response)) ?>"></div>
    <?php } ?>
</div>
<!-- End Page-content -->
<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script src="<?= UrlGenerator::asset_url('admin-js','filepond-general-config.min.js') ?>"></script>
<script src="<?= UrlGenerator::asset_url('admin-js','alertElement.min.js') ?>"></script>
<?= $this->endSection() ?>
