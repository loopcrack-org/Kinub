<?= $this->include('partials/main') ?>

<head>
    
    <?= view('partials/title-meta', array('title' => 'Inicio')); ?>
    <?= $this->include('partials/head-css') ?>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?= $this->include('partials/menu') ?>

        <div class="main-content">
            <div class="page-content">

                <h1>Bienvenido</h1>

            </div>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?= $this->include('partials/vendor-scripts') ?>

    <!-- App js -->
    <script src="/assets/js/admin/app.js"></script>
</body>

</html>