<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/equipment.min.css" type="text/css">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<main class="equipments">

    <h1 class="equipments__heading title--level-3">EQUIPOS</h1>

    <div class="content">
        <video class="content__video" autoplay muted loop>
            <!--Add more video formats-->
            <source src="assets/video/equipment-video.mp4">
        </video>

        <div class="content__grid">
            <?php foreach ($categories as $category) { ?>
                <a href="/categoria/<?= $category['categoryId']; ?>" class="equipment">
                    <img src="<?= $category['fileRoute']; ?>" alt="equipment" class="equipment__icon">
                    <h3 class="equipment__name"><?= $category['categoryName']?></h3>
                    <p class="equipment__text">&nbsp;</p>
                </a> <!--equipment-->
            <?php } ?>
        </div>
    </div>
</main>
<?php $this->endSection('content'); ?>