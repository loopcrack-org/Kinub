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

            <a href="#" class="equipment">
                <img src="assets/images/equipments-icons/Telemetria-icono.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">TELEMETRÍA</h3>
                <p class="equipment__text"></p>
            </a> <!--equipment-->
            <a href="#" class="equipment">
                <img src="assets/images/equipments-icons/Icono-SERIEE.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">SERIES E</h3>
                <p class="equipment__text">electromagnéticos</p>
            </a> <!--equipment-->
            <a href="#" class="equipment">
                <img src="assets/images/equipments-icons/icono-software.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">SOFTWARE</h3>
                <p class="equipment__text"></p>
            </a> <!--equipment-->
            <a href="#" class="equipment">
                <img src="assets/images/equipments-icons/icono-serie-m.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">SERIES M</h3>
                <p class="equipment__text">mass meters</p>
            </a> <!--equipment-->
                  <a href="#" class="equipment">
                <img src="assets/images/equipments-icons/icono-ultrasonicos.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">SERIES U</h3>
                <p class="equipment__text">ultrasónicos</p>
            </a> <!--equipment-->
            <a href="#" class="equipment">
                <img src="assets/images/equipments-icons/icono-series-ele.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">SERIES L</h3>
                <p class="equipment__text">level meters</p>
            </a> <!--equipment-->
            <a href="#" class="equipment">
                <img src="assets/images/equipments-icons/ICONO-SERIES-I.svg" alt="equipment" class="equipment__icon">
                <h3 class="equipment__name">SERIES I</h3>
                <p class="equipment__text">industriales</p>
            </a> <!--equipment-->




        </div>
    </div>
</main>
<?php $this->endSection('content'); ?>