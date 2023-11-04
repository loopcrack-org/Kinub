<?= $this->extend('templates/admin/dashboardTemplate') ?>

<?= $this->section('title-meta') ?>
<?= view('partials/title-meta', ['title' => 'Emails']); ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link href="/assets/common/css/sweetAlert.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <?= view('partials/page-title', ['title' => 'Emails']); ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="card-title mb-2 mb-md-0">Tabla de Emails</h5>
                    </div>

                    <!-- card-header -->
                    <div class="card-body">
                        <table id="emails-table" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del solicitante</th>
                                    <th>Email del solicitante</th>
                                    <th>Tipo de email</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($emails as $email) { ?>
                                    <tr>
                                        <td><?= $email['emailId']; ?></td>
                                        <td>
                                            <div class="d-flex align-items-center fw-medium">
                                                <p class="text-wrap"><?= $email['inquirerName']; ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center fw-medium">
                                                <p class="text-wrap"><?= $email['inquirerEmail']; ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-<?= ($email['emailTypeId'] === '1') ? 'warning' : (($email['emailTypeId'] === '2') ? 'info' : 'danger'); ?>">
                                                <?= ($email['emailTypeId'] === '1') ? 'Contacto' : (($email['emailTypeId'] === '2') ? 'Soporte técnico' : 'Información producto'); ?>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-between">
                                                <a href="#" class="btn btn-warning btn-icon waves-effect waves-light" style="width: 100%; margin-bottom:10px;"><i class="mdi mdi-email-search-outline ri-lg"></i></a>
                                                <a href="#" class="btn btn-danger btn-icon waves-effect waves-light" data-bs-toggle="modal" style="width: 100%;"><i class="ri-delete-bin-5-line ri-lg"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del solicitante</th>
                                    <th>Email del solicitante</th>
                                    <th>Tipo de email</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- table -->
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


<?= $this->section('js') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/r-2.5.0/datatables.min.js"></script>

<script src="/assets/admin/js/datatables-general-config.min.js"></script>
<script src="/assets/admin/js/email.min.js"></script>
<?= $this->endSection() ?>