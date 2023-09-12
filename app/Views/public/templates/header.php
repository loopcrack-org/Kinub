<?php $this->section('js'); ?>
<script src="assets/js/public/menuMobile.js"></script>
<?php $this->endSection(); ?>
<header class="header" id="header-nav">
        <div class="header__logo">
            <a href="/">
                <img src="https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829" alt="Logo Kinub">
            </a>
        </div>

        <nav class="navigation">
            <a href="#" class="navigation__link">Equipos</a>
            <a href="#" class="navigation__link">Soporte técnico</a>
            <a href="#" class="navigation__link">Certificados</a>
            <a href="/#form" class="navigation__link">Contacto</a>
        </nav>
    </header>

    <div class="header-mobile" id="header-mobile">
        <a class="header-mobile__logo" href="/">
            <img src="https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829" alt="Logo Kinub">
        </a>

        <div class="menu menu--collapse" id="menu-mobile">
            <div class="menu-box">
                <div class="menu-inner"></div>
            </div>
        </div>
    </div>

<aside class="sidebar"> 

    <!--Active link function is missing-->
    <nav class="navigation-mobile">
        <a href="#" class="navigation-mobile__link active">Equipos</a>
        <a href="#" class="navigation-mobile__link">Soporte técnico</a>
        <a href="#" class="navigation-mobile__link">Certificados</a>
        <a href="/#form" class="navigation-mobile__link">Contacto</a>
    </nav>
</aside>