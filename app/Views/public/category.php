<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/category.min.css" type="text/css">
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script src="assets/public/js/multiple-options-select.min.js"></script>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<header class="jumbotron" style="background-image: url(/assets/images/Telemetria.jpeg);">
    <h1 class="jumbotron__title">Telemetría</h1>
</header>

<section class="search">
    <form class="search__form" method="post">
        <input class="search__bar" id="autoComplete" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off" maxlength="2048" tabindex="1" placeholder="Buscar">
    </form>

    <div class="search__displays">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="search__display bi bi-columns-gap" viewBox="0 0 16 16">
            <path d="M6 1v3H1V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm14 12v3h-5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM6 8v7H1V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm14-6v7h-5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1z"/>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="search__display bi bi-list-nested" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h10a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 1 3h10a.5.5 0 0 1 0 1H1a.5.5 0 0 1-.5-.5"/>
        </svg>
    </div>

    <div class="search__filters">
        <button class="search__filter-button">Filtros</button>
        <select class="search__sorting" name="sorting" id="sorting">
            <option value="1">De la A-Z</option>
            <option value="2">De la Z-A</option>
        </select>
    </div>
</section>

<main class="category">
    <div class="category__grid">

        <div class="product kinub-card">
            <div class="product__image-container">
                <img src="assets/images/imagen-catalogo.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/producto" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->

        <div class="product kinub-card">
            <div class="product__image-container">
                <img src="https://tse3.mm.bing.net/th?id=OIP.ZTQLS9hW-oRg1SxK6at9TQHaFj&pid=Api&P=0&h=180" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/producto" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->

        <div class="product kinub-card">
            <div class="product__image-container">
                <img src="https://cdn-icons-png.flaticon.com/512/6152/6152273.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/producto" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->

        <div class="product kinub-card">
            <div class="product__image-container">
                <img src="assets/images/imagen-catalogo.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/producto" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->

        <div class="product kinub-card">
            <div class="product__image-container">
                <img src="https://tse4.mm.bing.net/th?id=OIP.1rHJUkntpmgWWtdbuK79TAHaDd&pid=Api&P=0&h=180" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/producto" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->

        <div class="product kinub-card">
            <div class="product__image-container">
                <img src="http://www.guiaspracticas.com/wp-content/uploads/image/2d-systems.jpg" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/producto" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->
        <div class="product kinub-card">
            <div class="product__image-container">
                <img src="https://mail.monitoreointeligente.com/wp-content/uploads/2021/08/v1-3.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/producto" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->
        <div class="product kinub-card">
            <div class="product__image-container">
                <img src="assets/images/imagen-catalogo.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/producto" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->
        <div class="product kinub-card">
            <div class="product__image-container">
                <img src="assets/images/imagen-catalogo.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/producto" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->
    </div>

</main>

<?php $this->endSection('content'); ?>
