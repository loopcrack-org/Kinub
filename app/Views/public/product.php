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
        <h2 class="details__heading">Medidor de nivel de radar 80G</h2>

        <div class="carousel">
            <div class="carousel__wrapper">
                <div class="carousel__active-element">
                    <div class="carousel__counter"></div>
                    <div class="carousel__main-video-container">
                        <div class="carousel__video-overlay"></div>
                        <video class="carousel__main-video" muted></video>
                    </div>
                    <img class="carousel__main-img" id="main-image" alt="Imagen Principal">
                </div>
                <div class="swiper_container">
                    <div class="carousel__counter"></div>
                    <div class="swiper">
                        <div class="swiper-wrapper" id="lightgallery-product">
                            <li class="swiper-slide--selected swiper-slide" data-index="0" data-lg-size="2048-1152" data-poster="https://mail.monitoreointeligente.com/wp-content/uploads/2021/08/v1-3.png" data-video='{"source": [{"src":"assets/video/equipment-video.mp4", "type":"video/mp4"}], "attributes": {"preload": false, "controls": true}}' data-poster="https://mail.monitoreointeligente.com/wp-content/uploads/2021/08/v1-3.png">
                                <img src="https://mail.monitoreointeligente.com/wp-content/uploads/2021/08/v1-3.png" alt="Imagen Grande">
                            </li>

                            <li class="swiper-slide" data-index="1" data-lg-size="2048-1152" data-src="https://img.interempresas.net/fotos/1917174.jpeg">
                                <img src="https://img.interempresas.net/fotos/1917174.jpeg" alt="Imagen Grande">
                            </li>
                            <li class="swiper-slide" data-index="2" data-lg-size="2048-1152" data-video='{"source": [{"src":"assets/video/kinub-video-example.mp4", "type":"video/mp4"}], "attributes": {"preload": false, "controls": true}}' data-poster="https://mail.monitoreointeligente.com/wp-content/uploads/2021/08/v1-3.png">
                                <img src="https://mail.monitoreointeligente.com/wp-content/uploads/2021/08/v1-3.png" alt="Imagen Grande">
                            </li>
                            <li class="swiper-slide" data-index="3" data-lg-size="1000-1000" data-src="https://www.totalmentereflejante.com/wp-content/uploads/2021/03/Medidor-de-espesores.jpg">
                                <img src="https://www.totalmentereflejante.com/wp-content/uploads/2021/03/Medidor-de-espesores.jpg" alt="Imagen Grande">
                            </li>
                            <li class="swiper-slide" data-index="4" data-lg-size="1000-1453" data-src="https://wallpapercave.com/wp/wp8112249.jpg">
                                <img src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Imagen Grande">
                            </li>
                            <li class="swiper-slide" data-index="5" data-lg-size="225-225" data-src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCWQVS1EYceqxvr8rgCxm8Q1L9htUoZCRVnw&usqp=CAU">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCWQVS1EYceqxvr8rgCxm8Q1L9htUoZCRVnw&usqp=CAU" alt="Imagen Grande">
                            </li>
                            <li class="swiper-slide" data-index="6" data-lg-size="1000-1453" data-src="https://wallpapercave.com/wp/wp8112249.jpg">
                                <img src="https://wallpapercave.com/wp/wp8112249.jpg" alt="Imagen Grande">
                            </li>
                        </div>
                        <div class="swiper-pagination"></div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>


                </div>
            </div>
        </div>

        <div class="details__info">
            <div class="details__zoom-container"></div>
            <h2 class="details__heading details__heading--desktop">Medidor de nivel de radar 80G</h2>

            <div class="tags">
                <a href="/categoria" class="tags__tag">
                    <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                </a>
                <a href="/categoria" class="tags__tag">
                    <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                </a>
                <a href="/categoria" class="tags__tag">
                    <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                </a>
                <a href="/categoria" class="tags__tag">
                    <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                </a>
                <a href="/categoria" class="tags__tag">
                    <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                </a>
                <a href="/categoria" class="tags__tag">
                    <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                </a>
                <a href="/categoria" class="tags__tag">
                    <p class="tags__tag-content">LoRaWAN OMS</p>
                </a>
            </div>

            <div class="details__data-container">

                <p class="details__data"><span class="details__data--title">Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Rapidez de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Lorem ipsum: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Demanda: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Lorem ipsum: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Relación: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Lorem ipsum dolor: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Potencia: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Electrones: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Comunicación: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Delimitación: </span>Lorem ipsum dolor sit amet consectetur</p>
                <p class="details__data"><span class="details__data--title">Conmutación: </span>Lorem ipsum dolor sit amet consectetur</p>

                <button id="modal-form-btn" class="details__btn">
                    Más información acerca de este equipo
                </button>
            </div>
        </div>
</main>

<?php
$errors   = session()->get('errors');
$response = session()->get('response');
if(isset($response)):
    ?>
<div id="alert-response" data-response="<?= htmlspecialchars(json_encode($response)) ?>"></div>
<?php endif; ?>

<div hidden>
    <form class="modal-form <?= isset($errors) ? 'form-error' : ''?>" id="modal-form" method="POST" action="/email/producto">
        <div id="modal-form-close" class="modal-form__close">
            <svg class="modal-form__close-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#00899b" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
            </svg>
        </div>

        <h2 class="modal-form__title"><span class="modal-form__title--large">Contáctanos</span> para más información</h2>

        <div class="modal-form__field">
            <input class="modal-form__input modal-form__input--product" type="text" name="product-name" value="Medidor de nivel de radar 80G" readonly>
            <input type="text" id="model" name="product-model" value="1234" hidden>
        </div>

        <div class="modal-form__field">
            <label class="modal-form__label" for="name">Nombre</label>
            <?= isset($errors['inquirer-name']) ? '<p class="modal-form__error name">' . $errors['inquirer-name'] . '</p>' : '' ?>
            <input class="modal-form__input required" type="text" id="name" name="inquirer-name" value="<?=old('inquirer-name')?>">
        </div>

        <div class="modal-form__field">
            <label class="modal-form__label" for="phone">Teléfono</label>
            <?= isset($errors['inquirer-phone']) ? '<p class="modal-form__error phone">' . $errors['inquirer-phone'] . '</p>' : '' ?>
            <input class="modal-form__input required custom-validate" data-validate-key="intlTelInput" type="tel" id="phone" name="inquirer-phone" value="<?=old('inquirer-phone')?>">
        </div>

        <div class="modal-form__field">
            <label class="modal-form__label" for="email">E-Mail</label>
            <?= isset($errors['inquirer-email']) ? '<p class="modal-form__error email">' . $errors['inquirer-email'] . '</p>' : '' ?>
            <input class="modal-form__input required email" type="email" id="email" name="inquirer-email" value="<?=old('inquirer-email')?>">
        </div>

        <div class="modal-form__field">
            <label class="modal-form__label" for="message">Mensaje</label>
            <?= isset($errors['message']) ? '<p class="modal-form__error message">' . $errors['message'] . '</p>' : '' ?>
            <textarea class="modal-form__textarea required" id="message" name="message" rows="5"><?=old('message')?></textarea>
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
        <video id="product-video" class="product-video__video" preload="auto" width="500" height="264" muted playsinline controls>
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