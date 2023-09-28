<?php $this->extend('public/templates/layout'); ?>

<!-- CSS -->
<?php $this->section('css'); ?>
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
<link rel="stylesheet" href="assets/css/public.min.css" type="text/css">
<?php $this->endSection(); ?>

<!-- JS -->
<?php $this->section('js'); ?>
<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/public/home.js"></script>
<?php $this->endSection(); ?>

<!-- FONTS -->
<?php $this->section('fonts'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&family=Nunito+Sans:opsz,wght@6..12,200;6..12,400&display=swap" rel="stylesheet">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<?php $errors = session()->get('errors'); ?>

<section class="about-us">
    <div class="about-us__grid">
        <div class="about-us__image-container">
            <picture>
                <source srcset="assets/images/auth-one-bg.avif" type="image/avif">
                <source srcset="assets/images/auth-one-bg.webp" type="image/webp">
                <img class="about-us__image" loading="lazy" width="200" height="300" src="assets/images/auth-one-bg.jpg" alt="About us image">
            </picture>
        </div>

        <div class="about-us__content">
            <h2 class="about-us__heading">Nosotros</h2>
            <p class="about-us__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero dolor itaque sit nesciunt nihil maiores placeat sequi recusandae earum voluptatibus accusantium modi natus dolorem, tenetur, quod reprehenderit nostrum. Error, sit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, illum saepe ab, sit iure dignissimos</p>
        </div>
    </div>
</section>

<section class="kinub-video">
    <div class="kinub-video__container">
        <video
        id="kinub-video"
        class="kinub-video__video"
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

<section class="measurement-solutions">
    <h3 class="measurement-solutions__heading">Soluciones de medición</h3>

    <div class="measurement-solutions__grid">
        <div class="measurement-solution" style="background-image: url('assets/images/auth-one-bg.jpg');">
 
            <div class="measurement-solution__icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="200"
                    height="200"
                    viewBox="0 0 200 200"
                >
                <defs>
                    <mask id="icon-mask" x="0" y="0" width="200" height="200">
                        <image href="assets/images/drop.svg" width="100%" height="100%" />
                    </mask>

                    <linearGradient
                        id="mask-degraded"
                        x1="0%"
                        y1="0%"
                        x2="100%"
                        y2="0%"
                    >
                        <stop offset="0%" style="stop-color: #0032AB" />
                        <stop offset="33%" style="stop-color: #0174F6" />
                        <stop offset="66%" style="stop-color: #1B90C7" />
                        <stop offset="100%" style="stop-color: #00A7DE" />
                    </linearGradient>
                </defs>
                <rect
                    x="0"
                    y="0"
                    width="100%"
                    height="100%"
                    fill="url(#mask-degraded)"
                    mask="url(#icon-mask)"
                />
                </svg>
            </div>
            
            <div class="measurement-solution__content">
                <p class="measurement-solution__title"><span class="measurement-solution__title--strong">Medidores</span> Residenciales</p>
                <p class="measurement-solution__description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, morbi quis tempor odio.
                </p>
            </div>  
            
            <div class="measurement-solution__mask"></div>  
            <div class="measurement-solution__mask--hover"></div>  
        </div>

        <div class="measurement-solution" style="background-image: url('assets/images/auth-one-bg.jpg');">
 
            <div class="measurement-solution__icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="200"
                    height="200"
                    viewBox="0 0 200 200"
                >
                <defs>
                    <mask id="icon-mask" x="0" y="0" width="200" height="200">
                        <image href="assets/images/drop.svg" width="100%" height="100%" />
                    </mask>

                    <linearGradient
                        id="mask-degraded"
                        x1="0%"
                        y1="0%"
                        x2="100%"
                        y2="0%"
                    >
                        <stop offset="0%" style="stop-color: #0032AB" />
                        <stop offset="33%" style="stop-color: #0174F6" />
                        <stop offset="66%" style="stop-color: #1B90C7" />
                        <stop offset="100%" style="stop-color: #00A7DE" />
                    </linearGradient>
                </defs>
                <rect
                    x="0"
                    y="0"
                    width="100%"
                    height="100%"
                    fill="url(#mask-degraded)"
                    mask="url(#icon-mask)"
                />
                </svg>
            </div>
            
            <div class="measurement-solution__content">
                <p class="measurement-solution__title"><span class="measurement-solution__title--strong">Medidores</span> Industriales</p>
                <p class="measurement-solution__description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, morbi quis tempor odio.
                </p>
            </div>  
            
            <div class="measurement-solution__mask"></div>  
            <div class="measurement-solution__mask--hover"></div>  
        </div>

        <div class="measurement-solution" style="background-image: url('assets/images/auth-one-bg.jpg');">
 
            <div class="measurement-solution__icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="200"
                    height="200"
                    viewBox="0 0 200 200"
                >
                <defs>
                    <mask id="icon-mask" x="0" y="0" width="200" height="200">
                        <image href="assets/images/drop.svg" width="100%" height="100%" />
                    </mask>

                    <linearGradient
                        id="mask-degraded"
                        x1="0%"
                        y1="0%"
                        x2="100%"
                        y2="0%"
                    >
                        <stop offset="0%" style="stop-color: #0032AB" />
                        <stop offset="33%" style="stop-color: #0174F6" />
                        <stop offset="66%" style="stop-color: #1B90C7" />
                        <stop offset="100%" style="stop-color: #00A7DE" />
                    </linearGradient>
                </defs>
                <rect
                    x="0"
                    y="0"
                    width="100%"
                    height="100%"
                    fill="url(#mask-degraded)"
                    mask="url(#icon-mask)"
                />
                </svg>
            </div>
            
            <div class="measurement-solution__content">
                <p class="measurement-solution__title"><span class="measurement-solution__title--strong">Medición</span> Remota</p>
                <p class="measurement-solution__description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, morbi quis tempor odio.
                </p>
            </div>  
            
            <div class="measurement-solution__mask"></div>  
            <div class="measurement-solution__mask--hover"></div>  
        </div>

        <div class="measurement-solution" style="background-image: url('assets/images/auth-one-bg.jpg');">
 
            <div class="measurement-solution__icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="200"
                    height="200"
                    viewBox="0 0 200 200"
                >
                <defs>
                    <mask id="icon-mask" x="0" y="0" width="200" height="200">
                        <image href="assets/images/drop.svg" width="100%" height="100%" />
                    </mask>

                    <linearGradient
                        id="mask-degraded"
                        x1="0%"
                        y1="0%"
                        x2="100%"
                        y2="0%"
                    >
                        <stop offset="0%" style="stop-color: #0032AB" />
                        <stop offset="33%" style="stop-color: #0174F6" />
                        <stop offset="66%" style="stop-color: #1B90C7" />
                        <stop offset="100%" style="stop-color: #00A7DE" />
                    </linearGradient>
                </defs>
                <rect
                    x="0"
                    y="0"
                    width="100%"
                    height="100%"
                    fill="url(#mask-degraded)"
                    mask="url(#icon-mask)"
                />
                </svg>
            </div>
            
            <div class="measurement-solution__content">
                <p class="measurement-solution__title"><span class="measurement-solution__title--strong">Calidad</span> del agua</p>
                <p class="measurement-solution__description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, morbi quis tempor odio.
                </p>
            </div>  
            
            <div class="measurement-solution__mask"></div>  
            <div class="measurement-solution__mask--hover"></div>  
        </div>
</section>

<section id="form">
    <?php 
        $response = session()->get('response');
        if(isset($response)):
    ?>
        <script type="module">
            Swal.fire({
                title: "<?= $response['title']; ?>",
                text: "<?= $response['message']; ?>",
                icon: "<?= $response['type']; ?>",
                confirmButtonColor: '#0174F6'
            })
        </script>
    <?php endif;?>

    <form class="container-sm form" action="/email/contacto" method="POST">
        <div class="form__icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="60" fill="#ffffff" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
            </svg>
        </div>

        <legend class="form__legend">Contáctanos</legend>
        
        <div class="form__field">
            <label for="product-name" class="form__label">Nombre del Producto</label>
            <?= isset($errors['product-name']) ? '<p class="form__error">'.$errors['product-name'].'</p>' : '' ?>
            <input id="product-name" name="product-name" type="text" class="form__input" value="<?php echo old("product-name")?>" placeholder="Ingrese el nombre del producto">
        </div>

        <div class="form__field">
            <label for="inquirer-name" class="form__label">Nombre del Solicitante</label>
            <?= isset($errors['inquirer-name']) ? '<p class="form__error">'.$errors['inquirer-name'].'</p>' : '' ?>
            <input id="inquirer-name" name="inquirer-name" type="text" class="form__input" value="<?php echo old("inquirer-name")?>" placeholder="Ingrese su nombre">
        </div>

        <div class="form__field">
            <label for="inquirer-email" class="form__label">E-Mail</label>
            <?= isset($errors['inquirer-email']) ? '<p class="form__error">'.$errors['inquirer-email'].'</p>' : '' ?>
            <input id="inquirer-email" name="inquirer-email" type="email" class="form__input" value="<?php echo old("inquirer-email")?>" placeholder="Ingrese su correo">
        </div>

        <div class="form__field">
            <label for="message" class="form__label">Mensaje</label>
            <?= isset($errors['message']) ? '<p class="form__error">'.$errors['message'].'</p>' : '' ?>
            <textarea id="message" name="message" rows="5" class="form__textarea" placeholder="Ingrese su mensaje"><?php echo old("message")?></textarea>
        </div>

        <input class="form__submit" type="submit" value="Enviar">
    </form>
</section>
<?php $this->endSection('content');?>