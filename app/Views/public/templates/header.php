<?php $this->section('js'); ?>
<script src="assets/public/js/menuMobile.min.js"></script>
<?php $this->endSection(); ?>
<header class="header" id="header-nav">
    <a href="/" class="header__logo">
        <img src="assets/images/imagotipo.svg" height="60px" alt="Logo Kinub">
    </a>

    <div class="header__background" id="background"></div>

    <nav class="navigation" id="navigation">
        <a href="/equipos" class="navigation__link">Equipos</a>
        <a href="/soporte" class="navigation__link">Soporte técnico</a>
        <a href="/certificados" class="navigation__link">Certificados</a>
        <a href="/#form" class="navigation__link">Contacto</a>
    </nav>

    <div class="hamburger hamburger--collapse" id="menu-mobile">
        <div class="hamburger__box">
            <div class="hamburger__inner"></div>
        </div>
    </div>
</header>
