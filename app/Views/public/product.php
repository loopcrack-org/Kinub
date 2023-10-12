<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/app.min.css" type="text/css">
<link rel="stylesheet" href="assets/public/css/product.min.css" type="text/css">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

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
                <div class="tag">
                    <p class="tag__content">Dialog 3Gtm 9xx Mhz</p>
                </div>
                <div class="tag">
                    <p class="tag__content">LoRaWAN OMS</p>
                </div>
            </div>

            <div class="details__data-container">
            <p class="details__data"><span>Frecuencia:</span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos amet</p>
            <p class="details__data"><span>Rango de medición:</span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos amet</p>
            <p class="details__data"><span>Precisión de medición:</span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos amet</p>
            <p class="details__data"><span>Potencia:</span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos amet</p>
            <p class="details__data"><span>Comunicación:</span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos amet</p>       
            </div>
            <a href="#" class="details__button">Más información acerca de este equipo</a>
        </div>
    </div>
</main>

<nav class="product-navigation">
    <a href="#" class="product-navigation__link">Descripción</a>
    <a href="#" class="product-navigation__link">Especificaciones técnicas</a>
    <a href="#" class="product-navigation__link">Área de descarga</a>
</nav>

<section class="description">
    <h2 class="description__heading">Descripción</h2>
    <div class="description__text-container">
        <p class="description__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus magni pariatur vero doloremque, id ipsa praesentium a nesciunt! Ullam, porro laudantium. Voluptas fugit possimus vero explicabo rerum id omnis nesciunt. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum alias praesentium explicabo, nesciunt expedita ducimus dolor a, id maxime quasi, cum culpa tempora quibusdam et. Rerum itaque soluta quo suscipit.</p>
    </div>
</section>

<section class="specifications">
    <h2 class="specifications__heading">Especificaciones Técnicas</h2>
    <div class="specifications__text-container">
        <p class="specifications__text"><span>Titulo:</span>Datos</p>
        <p class="specifications__text"><span>Titulo:</span>Datos</p>
        <p class="specifications__text"><span>Titulo:</span>Datos</p>
    </div>
</section>

<?php $this->endSection('content');?>