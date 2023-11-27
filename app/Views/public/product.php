<?php $this->extend('public/templates/layout'); ?>

<!-- CSS -->
<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/product.min.css" type="text/css">
<?php $this->endSection(); ?>

<!-- JS -->
<?php $this->section('js'); ?>
<script src="assets/public/js/product.min.js"></script>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<header class="jumbotron" style="background-image: url(/assets/images/Telemetria.jpeg);">
    <h1 class="jumbotron__title">Telemetría</h1>
</header>

<main class="details">
    <div class="details__grid">

    <div class="carousel">
        <div class="carousel__img-container" id="video-container">
            <video id="main-video" autoplay muted></video>
        </div>
        <div class="carousel__img-container magnify-wrapper" id="main-image-container">
            <img class="carousel__main-img" id="main-image" alt="Imagen Principal">
            <div id="large-img"></div>
        </div>

        <div class="glide" id="glide">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides" id="lightgallery-product">
                    <li class="glide__slide" data-video='{"source": [{"src":"assets/video/kinub-video-example.mp4", "type":"video/mp4"}], "attributes": {"preload": false, "controls": true}}' data-poster="https://u83y9h.c2.acecdn.net/wp-content/uploads/2020/06/cristiano-ronaldo_4822329.jpg" >
                        <img class="slide-media" src="https://u83y9h.c2.acecdn.net/wp-content/uploads/2020/06/cristiano-ronaldo_4822329.jpg" alt="Imagen Grande">
                    </li>
                    <li class="glide__slide" data-src="https://wallpapercave.com/wp/wp8112249.jpg">
                        <img class="slide-media" class="slide-media" src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Imagen Grande">
                    </li>
                    <li class="glide__slide" data-src="https://u83y9h.c2.acecdn.net/wp-content/uploads/2020/06/cristiano-ronaldo_4822329.jpg">
                        <img class="slide-media" src="https://u83y9h.c2.acecdn.net/wp-content/uploads/2020/06/cristiano-ronaldo_4822329.jpg" alt="Imagen Grande">
                    </li>
                    <li class="glide__slide" data-video='{"source": [{"src":"assets/video/kinub-video-example.mp4", "type":"video/mp4"}], "attributes": {"preload": false, "controls": true}}' data-poster="https://u83y9h.c2.acecdn.net/wp-content/uploads/2020/06/cristiano-ronaldo_4822329.jpg" >
                        <img class="slide-media" src="https://u83y9h.c2.acecdn.net/wp-content/uploads/2020/06/cristiano-ronaldo_4822329.jpg" alt="Imagen Grande">
                    </li>
                    <li class="glide__slide" data-src="https://wallpapercave.com/wp/wp8112249.jpg">
                        <img class="slide-media" src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Imagen Grande">
                    </li>
                    <li class="glide__slide" data-src="https://wallpapercave.com/wp/wp8112249.jpg">
                        <img class="slide-media" src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Imagen Grande">
                    </li>
                    <li class="glide__slide" data-src="https://wallpapercave.com/wp/wp8112249.jpg">
                        <img class="slide-media" src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Imagen Grande">
                    </li>
                    <li class="glide__slide" data-src="https://wallpapercave.com/wp/wp8112249.jpg">
                        <img class="slide-media" src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Imagen Grande">
                    </li>
                </ul>
            </div>

            <div class="glide__bullets" data-glide-el="controls[nav]">
                <button class="glide__bullet" data-glide-dir="=0"></button>
                <button class="glide__bullet" data-glide-dir="=1"></button>
                <button class="glide__bullet" data-glide-dir="=2"></button>
                <button class="glide__bullet" data-glide-dir="=3"></button>
                <button class="glide__bullet" data-glide-dir="=4"></button>
                <button class="glide__bullet" data-glide-dir="=5"></button>
                <button class="glide__bullet" data-glide-dir="=6"></button>
            </div>

              <div class="glide__arrows" data-glide-el="controls">
                <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M0 12l10.975 11 2.848-2.828-6.176-6.176H24v-3.992H7.646l6.176-6.176L10.975 1 0 12z"></path>
                    </svg>
                </button>
                <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

        <div class="details__info">
            <h2 class="details__heading">Medidor de nivel de radar 80G</h2>

            <div class="tags">
                <a href="#" class="tags__tag">
                    <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                </a>
                <a href="#" class="tags__tag">
                    <p class="tags__tag-content">LoRaWAN OMS</p>
                </a>
            </div>

            <div class="details__data-container">
            <p class="details__data"><span class="details__data--title">Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
            <p class="details__data"><span class="details__data--title">Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
            <p class="details__data"><span class="details__data--title">Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
            <p class="details__data"><span class="details__data--title">Potencia: </span>Lorem ipsum dolor sit amet consectetur</p>
            <p class="details__data"><span class="details__data--title">Comunicación: </span>Lorem ipsum dolor sit amet consectetur</p>
            </div>
            <span id="modal-form-btn" class="details__btn">Más información acerca de este equipo</span>
        </div>
    </div>
</main>

<div hidden>
    <form class="modal-form" id="modal-form" method="POST">
        <div id="modal-form-close" class="modal-form__close">
            <svg class="modal-form__close-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#00899b" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
            </svg>
        </div>

        <h2 class="modal-form__title"><span class="modal-form__title--big">Contáctanos</span> para más información</h2>

        <div class="modal-form__field">
            <input class="modal-form__input modal-form__input--product" type="text" name="product" value="Medidor de nivel de radar 80G" disabled>
        </div>

        <div class="modal-form__field">
            <input class="modal-form__input" type="text" id="model" name="model" value="" hidden>
        </div>

        <div class="modal-form__field">
            <label class="modal-form__label" for="name">Nombre</label>
            <input class="modal-form__input" type="text" id="name" name="name" value="">
        </div>

        <div class="modal-form__field">
            <label class="modal-form__label" for="phone">Teléfono</label>
            <input class="modal-form__input" type="tel" id="phone" name="phone" value="">
        </div>

        <div class="modal-form__field">
            <label class="modal-form__label" for="email">E-Mail</label>
            <input class="modal-form__input" type="email" id="email" name="email" value="">
        </div>

        <div class="modal-form__field">
            <label class="modal-form__label" for="name">Mensaje</label>
            <textarea class="modal-form__textarea" id="message" name="message" rows="5"></textarea>
        </div>

        <input type="submit" class="modal-form__submit" id="modal-form-submit" value="Enviar">
    </form>
</div>

<nav class="product-nav">
    <a href="#description" class="product-nav__link-container">
        <p class="product-nav__link">Descripción</p>
    </a>
    <a href="#tech-info" class="product-nav__link-container">
        <p class="product-nav__link">Especificaciones técnicas</p>
    </a>
    <a href="#download-area" class="product-nav__link-container">
        <p class="product-nav__link">Área de descarga</p>
    </a>
</nav>

<section class="product-info" id="description">
    <h2 class="product-info__heading product-info__heading--description">Descripción</h2>
    <div class="product-info__text-container product-info__text-container--description">
        <p class="product-info__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus magni pariatur vero doloremque, id ipsa praesentium a nesciunt! Ullam, porro laudantium. Voluptas fugit possimus vero explicabo rerum id omnis nesciunt. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum alias praesentium explicabo, nesciunt expedita ducimus dolor a, id maxime quasi, cum culpa tempora quibusdam et. Rerum itaque soluta quo suscipit.</p>
    </div>
</section>

<section class="product-info" id="tech-info">
    <h2 class="product-info__heading product-info__heading--tech-info">Especificaciones Técnicas</h2>
    <div class="product-info__text-container product-info__text-container--tech-info">
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