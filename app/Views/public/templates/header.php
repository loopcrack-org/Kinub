<?php $this->section('js'); ?>
<script src="assets/public/js/menuMobile.min.js"></script>
<?php $this->endSection(); ?>
<header class="header" id="header-nav">
    <div class="header__logo">
        <a href="/">
            <img src="https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829" alt="Logo Kinub">
        </a>
    </div>

    <div class="header__background" id="background"></div>

    <nav class="navigation" id="navigation">
        <a href="/equipos" class="navigation__link">Equipos</a>
        <a href="/soporte" class="navigation__link">Soporte técnico</a>
        <a href="/certificados" class="navigation__link">Certificados</a>
        <a href="/#form" class="navigation__link">Contacto</a>
    </nav>

    <div class="menu menu--collapse display-none" id="menu-mobile">
        <div class="menu-box">
            <div class="menu-inner"></div>
        </div>
    </div>
</header>
