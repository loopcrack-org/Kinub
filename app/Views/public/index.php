<?php $this->extend('public/templates/layout'); ?>

<!-- CSS -->
<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/home.min.css" type="text/css">
<?php $this->endSection(); ?>

<!-- JS -->
<?php $this->section('js'); ?>
<script src="assets/public/js/home.min.js"></script>
<?php $this->endSection(); ?>


<?php $this->section('content'); ?>
<?php $errors = session()->get('errors'); ?>

<section class="about-us">
    <div class="about-us__grid">
        <div class="about-us__image-container">
            <picture>
                <source srcset="assets/images/home-about-us.avif" type="image/avif">
                <source srcset="assets/images/home-about-us.webp" type="image/webp">
                <img class="about-us__image" src="assets/images/home-about-us.jpg" alt="About us image">
            </picture>
        </div>

        <div class="about-us__content">
            <h2 class="about-us__heading title--level-2">Nosotros</h2>
            <p class="about-us__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero dolor itaque sit nesciunt nihil maiores placeat sequi recusandae earum voluptatibus accusantium modi natus dolorem, tenetur, quod reprehenderit nostrum. Error, sit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, illum saepe ab, sit iure dignissimos</p>
        </div>
    </div>
</section>

<section class="kinub-video">
    <div class="kinub-video__container">
        <video id="kinub-video" class="kinub-video__video" preload="auto" width="500" height="264" muted playsinline controls>
            <source src="assets/video/kinub-video-example.mp4" type="video/mp4" />
            <source src="assets/video/kinub-video-example.webm" type="video/webm" />
        </video>
    </div>
</section>

<section class="measurement-solutions">
    <h3 class="measurement-solutions__heading title--level-3">Soluciones de medición</h3>
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php foreach($measurementSolutions as $measurementSolution) { ?>
                <div class="swiper-slide">
                    <div class="measurement-solution" style="background-image: url('<?= $measurementSolution['msImageRoute']?>');">
                        <div class="measurement-solution__icon">
                            <?php include ".{$measurementSolution['msIconRoute']}"?>
                        </div>

                        <div class="measurement-solution__content">
                            <p class="measurement-solution__title"><span class="measurement-solution__title--strong"><?= $measurementSolution['msNameStrong']?></span><?= $measurementSolution['msNameNotStrong'] ?></p>
                            <p class="measurement-solution__description">
                                <?= $measurementSolution['msDescription']?>
                            </p>
                        </div>

                        <div class="measurement-solution__mask"></div>
                        <div class="measurement-solution__mask--hover"></div>
                        <div class="measurement-solution__bottom-highlight" style="--bottom-highlight-color: #1b90c7;"></div>
                    </div>
                </div>
            <?php }?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>



<section id="form" class="form-container">
    <?php
    $response = session()->get('response');
if (isset($response)) :
    ?>
    <div id="alert-response" data-response="<?= htmlspecialchars(json_encode($response)) ?>"></div>
    <?php endif; ?>

    <form class="form wrapper--large" action="/email/contacto" method="POST">
        <div class="form__icon">
            <svg class="form__svg" xmlns="http://www.w3.org/2000/svg" width="224" height="203" viewBox="0 0 224 203" fill="none">
                <path d="M219.146 0C219.396 0.08 219.656 0.17 219.906 0.25C222.236 0.93 223.766 2.91 223.836 5.33C223.846 5.63 223.836 5.94 223.836 6.24C223.836 62.59 223.836 118.94 223.826 175.29C223.826 175.96 223.836 176.66 223.686 177.3C222.946 180.49 219.596 182.22 216.486 181.01C212.876 179.6 209.286 178.13 205.676 176.69C185.946 168.79 166.226 160.89 146.496 153C146.186 152.88 145.876 152.76 145.536 152.63C145.296 152.91 145.066 153.15 144.846 153.41C131.946 168.9 119.036 184.39 106.166 199.9C105.126 201.15 103.976 202.15 102.456 202.73C101.716 202.73 100.966 202.73 100.226 202.73C97.746 202 96.496 200.27 95.806 197.82C89.336 174.99 82.816 152.19 76.306 129.38C76.276 129.28 76.226 129.19 76.216 129.09C76.146 128.38 75.736 128.09 75.066 127.9C72.376 127.13 69.706 126.3 67.016 125.5C46.056 119.21 25.096 112.91 4.12597 106.63C1.91597 105.97 0.515973 104.6 0.0859727 102.31C-0.304027 100.19 0.655973 98.04 2.49597 96.93C3.01597 96.62 3.57597 96.37 4.12597 96.12C47.616 76.53 91.116 56.94 134.616 37.36C161.626 25.2 188.626 13.03 215.646 0.88C216.376 0.55 217.156 0.3 217.906 0.02C218.336 0 218.736 0 219.146 0ZM120.716 131.2C151.616 143.57 182.316 155.86 212.996 168.15C213.106 167.98 213.166 167.93 213.176 167.87C213.196 167.6 213.206 167.33 213.206 167.06C213.196 118.14 213.186 69.21 213.176 20.29C213.176 20.27 213.146 20.24 213.116 20.22C213.096 20.2 213.066 20.18 212.956 20.11C182.256 57.08 151.546 94.07 120.716 131.2ZM184.706 26.71C184.656 26.66 184.606 26.61 184.556 26.56C129.986 51.14 75.416 75.72 20.616 100.41C21.186 100.6 21.496 100.71 21.806 100.8C39.956 106.25 58.106 111.71 76.256 117.16C77.796 117.62 77.796 117.62 79.076 116.53C113.986 86.86 148.896 57.18 183.806 27.51C184.106 27.24 184.406 26.97 184.706 26.71ZM135.096 148.49C134.706 148.31 134.416 148.17 134.116 148.05C131.206 146.88 128.296 145.72 125.376 144.55C120.336 142.53 115.296 140.5 110.246 138.49C109.216 138.08 108.336 137.5 107.666 136.61C106.306 134.79 106.136 132.01 108.126 129.63C119.116 116.46 130.056 103.24 141.016 90.04C151.976 76.84 162.936 63.64 173.896 50.44C174.076 50.23 174.226 49.99 174.386 49.76C174.336 49.71 174.276 49.67 174.226 49.62C144.836 74.61 115.456 99.59 86.096 124.55C86.446 126.6 103.346 185.45 103.786 186.08C114.216 173.57 124.626 161.06 135.096 148.49Z" fill="#2EC7D5" />
            </svg>
        </div>

        <legend class="form__legend">CONTÁCTANOS</legend>
        <div class="form__grid">
            <div class="form__field">
                <label for="product-name" class="form__label">Equipo de mi interés</label>
                <?= isset($errors['product-name']) ? '<p class="form__error--small product-name">' . $errors['product-name'] . '</p>' : '' ?>
                <select id="product-name" name="product-name" class="required">
                    <option value="">Seleccionar...</option>
                    <option value="Equipos X">Equipos X</option>
                    <option value="Necesito Asesoria">Necesito Asesoria</option>
                </select>
            </div>

            <div class="form__field">
                <label for="inquirer-name" class="form__label">Nombre </label>
                <?= isset($errors['inquirer-name']) ? '<p class="form__error--small inquirer-name">' . $errors['inquirer-name'] . '</p>' : '' ?>
                <input id="inquirer-name" name="inquirer-name" pattern="^[A-Za-zÁáÉéÍíÓóÚúÜüÑñ\s'0-9]+$" title="'El campo nombre solo debe contener carácteres alfanuméricos y espacios'" type="text" class="form__input required" value="<?= old('inquirer-name') ?>">
            </div>

            <div class="form__field">
                <label for="inquirer-email" class="form__label">E-Mail</label>
                <?= isset($errors['inquirer-email']) ? '<p class="form__error inquirer-email">' . $errors['inquirer-email'] . '</p>' : '' ?>
                <input id="inquirer-email" name="inquirer-email" type="email" class="form__input required email" value="<?= old('inquirer-email') ?>">
            </div>

            <div class="form__field">
                <label for="message" class="form__label">Mensaje</label>
                <?= isset($errors['message']) ? '<p class="form__error message">' . $errors['message'] . '</p>' : '' ?>
                <textarea id="message" name="message" rows="5" class="form__textarea required" required><?= old('message') ?></textarea>
            </div>
        </div>
        <input class="form__submit" type="submit" value="Enviar">

    </form>
</section>
<?php $this->endSection('content'); ?>