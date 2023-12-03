<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/app.min.css" type="text/css">
<link rel="stylesheet" href="assets/public/css/certificates.min.css" type="text/css">
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

<?= $this->include('public/templates/pagination'); ?>

<?php $this->endSection('content'); ?>