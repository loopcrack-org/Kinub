<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section('title-meta') ?>
<?= view('partials/title-meta', ['title' => 'Ver Email']); ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <?= view('partials/page-title', ['title' => 'Ver Email', 'titleUrl' => '/admin/emails', 'pagetitle' => 'Emails', 'pagetitleInner' => 'Ver Email']); ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-end align-items-center flex-wrap">
                        <a href="/admin/emails" class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                            <i class="ri-arrow-left-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Volver
                        </a>
                    </div>

                    <!-- card-header -->
                    <div class="card-body d-flex justify-content-center m-3">
                        <iframe width="500" height="550" frameborder="0" srcdoc="<?= $email['emailContent']; ?>">
                        </iframe>
                    </div>
                    <!-- card-body -->
                </div>
                <!-- card -->
            </div>
            <!-- col -->
        </div>
        <!-- row -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?= $this->endSection() ?>