<?php use App\Utils\UrlGenerator; ?>
<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="<?= UrlGenerator::asset_url('public-css','certificates.min.css') ?>" type="text/css">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<main class="certificates">

    <h1 class="certificates__heading title--level-3">Certificados</h1>

    <section class="certificates__grid">
        <?php foreach ($certificates as $certificate) { ?>
        <a href="<?= $certificate['certificateFileRoute']?>" target="_blank" class="certificate kinub-card">
            <div class="certificate__image-container">
                <img class="certificate__image " src="<?= $certificate['previewFileRoute']?>" alt="<?= $certificate['certificatefileName']?>">
            </div>
            <div class="certificate__information">
                <p class="certificate__name"><?= $certificate['certificatefileName']?></p>
            </div>
        </a>
        <?php }?>
    </section>
</main>


<?php $this->endSection('content'); ?>
