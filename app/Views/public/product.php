<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/product.min.css" type="text/css">
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script src="assets/public/js/product.min.js"></script>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<header class="header-product" style="background-image: url('assets/images/auth-one-bg.jpg');">
    <div class="header-product__mask"></div>
    <h1 class="header-product__title">TELEMETRÍA</h1>
</header>

<main class="details">
    <div class="details__grid">
        <div class="carousel">
            <div class="carousel__big-image">
                <img src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Imagen Grande">
            </div>
            <div class="carousel__under-image">
                <div class="carousel__image">
                    <img src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Imagen pequeña">
                </div>
                <div class="carousel__image">
                    <img src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Imagen pequeña">
                </div>
                <div class="carousel__image">
                    <img src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Imagen pequeña">
                </div>
            </div>
        </div>

        <div class="details__information">
            <h2 class="details__heading">Medidor de nivel de radar 80G</h2>

            <div class="tags">
                <a href="#" class="tag">
                    <p class="tag__content">Dialog 3Gtm 9xx Mhz</p>
                </a>
                <a href="#" class="tag">
                    <p class="tag__content">LoRaWAN OMS</p>
                </a>
            </div>

            <div class="details__data-container">
            <p class="details__data"><span>Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
            <p class="details__data"><span>Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
            <p class="details__data"><span>Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
            <p class="details__data"><span>Potencia: </span>Lorem ipsum dolor sit amet consectetur</p>
            <p class="details__data"><span>Comunicación: </span>Lorem ipsum dolor sit amet consectetur</p>
            </div>
            <a href="#" class="details__button">Más información acerca de este equipo</a>
        </div>
    </div>
</main>

<nav class="product-navigation">
    <a href="#description" class="product-navigation__link-container">
        <p class="product-navigation__link">Descripción</p>
    </a>
    <a href="#tech-info" class="product-navigation__link-container">
        <p class="product-navigation__link">Especificaciones técnicas</p>
    </a>
    <a href="#download-area" class="product-navigation__link-container">
        <p class="product-navigation__link">Área de descarga</p>
    </a>
</nav>

<section class="product-info" id="description">
    <h2 class="product-info__heading product-info__heading--description">Descripción</h2>
    <div class="product-info__text-container">
        <p class="product-info__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus magni pariatur vero doloremque, id ipsa praesentium a nesciunt! Ullam, porro laudantium. Voluptas fugit possimus vero explicabo rerum id omnis nesciunt. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum alias praesentium explicabo, nesciunt expedita ducimus dolor a, id maxime quasi, cum culpa tempora quibusdam et. Rerum itaque soluta quo suscipit.</p>
    </div>
</section>

<section class="product-info" id="tech-info">
    <h2 class="product-info__heading product-info__heading--tech-info">Especificaciones Técnicas</h2>
    <div class="product-info__text-container">
        <ul>
            <li class="product-info__text"><span class="product-info__text--title">Frecuencia:</span>Sit amet, consectetuer</li>
            <li class="product-info__text"><span class="product-info__text--title">Rango de medición:</span>Euismod tincidunt ut laore</li>
            <li class="product-info__text"><span class="product-info__text--title">Presición de medición:</span>Commodo</li>
            <li class="product-info__text"><span class="product-info__text--title">Potencia:</span>Sit amet, consectetuer</li>
            <li class="product-info__text"><span class="product-info__text--title">Comunicación:</span>Ut wisi enim ad minim</li>
        </ul>
    </div>

    <div class="product-info__video-container">
        <video
        id="product-video"
        class="product-video__video"
        preload="auto"
        width="500"
        height="264"
        muted
        autoplay
        playsinline
        controls
        >
            <source src="assets/video/kinub-video-example.mp4" type="video/mp4" />
            <source src="assets/video/kinub-video-example.webm" type="video/webm" />
        </video>
    </div>
</section>

<section class="product-info download-area" id="download-area">

    <h2 class="product-info__heading product-info__heading--download-area">Área de descarga</h2>

    <div class="product-info__text-container product-info__text-container--download-area">
        <accordion-fan class="download-area__accordion-fan">
            <accordion-element class="download-area__accordion" data-title="Brochure">
                <ul class="download-area__links-container">
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                </ul>
            </accordion-element>
            <accordion-element class="download-area__accordion" data-title="Datasheet">
                <ul class="download-area__links-container">
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                </ul>
            </accordion-element>

            <a href="#" class="download-area__link download-area__link--single">Manual de Usuario</a>

            <accordion-element class="download-area__accordion" data-title="Certificados">
                <ul class="download-area__links-container">
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                    <li>
                        <a class="download-area__link" href="#">Algún titulo para sus descargas</a>
                    </li>
                </ul>
            </accordion-element>
        </accordion-fan>
    </div>
</section>

<?php $this->endSection('content'); ?>