<?= $this->include('partials/main') ?>

<head>

    <?= $this->renderSection('title-meta') ?>

    <?= $this->renderSection('css') ?>

    <?= $this->include('partials/head-css') ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?= $this->include('partials/menu') ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <?= $this->renderSection('content') ?>
            <?= $this->include('partials/footer') ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?= $this->include('partials/vendor-scripts') ?>

    <?= $this->renderSection('js') ?>

    <!-- App js -->
    <script src="/assets/admin/js/app.min.js"></script>


</body>

</html>