<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/css/public.min.css" type="text/css">
<?php $this->endSection(); ?>

<?php $this->section('fonts'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700;900&family=Nunito+Sans:opsz,wght@6..12,200;6..12,400;6..12,700;6..12,900&display=swap" rel="stylesheet">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<main class="equipments">

    <h1 class="equipments__heading">Equipos</h1>

    <div class="equipments__content">
        <video class="equipments__video" autoplay muted loop> 
            <!--Add more video formats-->
            <source src="assets/video/equipment-video.mp4">
        </video>     

        <div class="equipments__grid">
            
            <a href="#" class="equipment">
                <img src="assets/images/drop.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">Telemetría</h3>
                <p class="equipment__text">Electromagnéticos</p>
            </a> <!--equipment-->

            <a href="#" class="equipment">
                <img src="assets/images/drop.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">Telemetría</h3>
                <p class="equipment__text">Electromagnéticos</p>
            </a> <!--equipment-->

            <a href="#" class="equipment">
                <img src="assets/images/drop.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">Telemetría</h3>
                <p class="equipment__text">Electromagnéticos</p>
            </a> <!--equipment-->

            <a href="#" class="equipment">
                <img src="assets/images/drop.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">Telemetría</h3>
                <p class="equipment__text">Electromagnéticos</p>
            </a> <!--equipment-->

            <a href="#" class="equipment">
                <img src="assets/images/drop.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">Telemetría</h3>
                <p class="equipment__text">Electromagnéticos</p>
            </a> <!--equipment-->

            <a href="#" class="equipment">
                <img src="assets/images/drop.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">Telemetría</h3>
                <p class="equipment__text">Electromagnéticos</p>
            </a> <!--equipment-->

            <a href="#" class="equipment">
                <img src="assets/images/drop.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">Telemetría</h3>
                <p class="equipment__text">Electromagnéticos</p>
            </a> <!--equipment-->

        </div>
    </div>
</main>
<?php $this->endSection('content');?>