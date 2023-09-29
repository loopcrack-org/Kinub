<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/app.min.css" type="text/css">
<?php $this->endSection(); ?>

<?php $this->section('fonts'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700;900&family=Nunito+Sans:opsz,wght@6..12,200;6..12,400;6..12,500;6..12,700;6..12,900&display=swap" rel="stylesheet">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<main class="certificates">

    <h1 class="certificates__heading">Certificados</h1>
    
    <section class="certificates__grid">
        <a href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Certificado">
            </div>
            <div class="certificate__information">
                <p class="certificate__name">Certificado con algún nombre no tan largo</p>
            </div>
        </a>

        <a href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="Certificado">
            </div>
            <div class="certificate__information">
                <p class="certificate__name">Certificado con nombre un poco más largo que el otro</p>
            </div>
        </a>

        <a href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="Certificado">
            </div>
            <div class="certificate__information">
                <p class="certificate__name">Certificado con algún nombre no tan largo</p>
            </div>
        </a>

        <a href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="Certificado">
            </div>
            <div class="certificate__information">
                <p class="certificate__name">Certificado con algún nombre no tan largo</p>
            </div>
        </a>

        <a href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="Certificado">
            </div>
            <div class="certificate__information">
                <p class="certificate__name">Certificado con algún nombre no tan largo</p>
            </div>
        </a>

        <a href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="Certificado">
            </div>
            <div class="certificate__information">
                <p class="certificate__name">Certificado con algún nombre no tan largo</p>
            </div>
        </a>

        <a href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="Certificado">
            </div>
            <div class="certificate__information">
                <p class="certificate__name">Certificado con algún nombre no tan largo</p>
            </div>
        </a>

        <a href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="Certificado">
            </div>
            <div class="certificate__information">
                <p class="certificate__name">Certificado con algún nombre no tan largo</p>
            </div>
        </a>

        <a href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="Certificado">
            </div>
            <div class="certificate__information">
                <p class="certificate__name">Certificado con algún nombre no tan largo</p>
            </div>
        </a>
    </section>
</main>

<?= $this->include("public/templates/pagination-nav");?>

<?php $this->endSection('content');?>