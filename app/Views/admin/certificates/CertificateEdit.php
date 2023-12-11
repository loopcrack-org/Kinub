<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section('title-meta') ?>
<?= view('partials/title-meta', ['title' => 'Editar Certificado']); ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- Filepond css -->
<link rel="stylesheet" href="/assets/admin/css/filepond.min.css" type="text/css" />

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">
        <?= view('partials/page-title', ['title' => 'Editar Certificado', 'titleUrl' => '/admin/certificados', 'pagetitle' => 'Certificados', 'pagetitleInner' => 'Editar Certificado']); ?>


        <div class="row justify-content-center">
            <div class="col-sm-11">
                <div class="d-flex justify-content-start align-items-center mb-3">
                    <a href="/admin/certificados" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                        <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
                    </a>
                </div>
                <form id="createproduct-form" autocomplete="off" class="needs-validation" method="POST">

                    <?= $this->include('admin/certificates/certificatesFormTemplate') ?>

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
<!-- filepond js -->
<script src="/assets/admin/js/form-file-upload-certificate.init.min.js"></script>
<?= $this->endSection() ?>