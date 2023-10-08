<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/app.min.css" type="text/css">
<link rel="stylesheet" href="assets/public/css/filter.min.css" type="text/css">
<link rel="stylesheet" href="assets/public/css/category.min.css" type="text/css">
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script src="assets/public/js/multiple-options-select.min.js"></script>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="filter">
    <input 
        class="filter__attribute"
        type="text" 
        placeholder="Escriba el nombre del producto"
    >

    <div class="multiple-options-select" data-placeholder="Seleccionar Categorías">
        <div class="select-btn">
            <span class="select-btn__btn-text"></span>
            <span class="select-btn__icon">
                <img class="select-btn__icon-img" src="assets/images/arrow-down.svg" alt="select icon">
            </span>
        </div>

        <ul class="select-list">
            <li class="select-list__option">
                <input 
                    class="select-list__checkbox"
                    type="checkbox" 
                    name=""
                    value=""
                >
                <span class="select-list__text">Ejemplo de opción</span>
            </li>
            <li class="select-list__option">
                <input 
                    class="select-list__checkbox"
                    type="checkbox" 
                    name=""
                    value=""
                >
                <span class="select-list__text">Ejemplo de opción</span>
            </li>
            <li class="select-list__option">
                <input 
                    class="select-list__checkbox"
                    type="checkbox" 
                    name=""
                    value=""
                >
                <span class="select-list__text">Ejemplo de opción</span>
            </li>
        </ul>
    </div>

    <div class="multiple-options-select" data-placeholder="Seleccionar Tags">
        <div class="select-btn">
            <span class="select-btn__btn-text"></span>
            <span class="select-btn__icon">
                <img class="select-btn__icon-img" src="assets/images/arrow-down.svg" alt="select icon">
            </span>
        </div>

        <ul class="select-list">
            <li class="select-list__option">
                <input 
                    class="select-list__checkbox"
                    type="checkbox" 
                    name=""
                    value=""
                >
                <span class="select-list__text">Ejemplo de opción</span>
            </li>
            <li class="select-list__option">
                <input 
                    class="select-list__checkbox"
                    type="checkbox" 
                    name=""
                    value=""
                >
                <span class="select-list__text">Ejemplo de opción</span>
            </li>
            <li class="select-list__option">
                <input 
                    class="select-list__checkbox"
                    type="checkbox" 
                    name=""
                    value=""
                >
                <span class="select-list__text">Ejemplo de opción</span>
            </li>
        </ul>
    </div>

    <input type="submit" class="filter__submit" value="Buscar">
</div>

<main class="category">
    <div class="category__grid">

        <div class="product">
            <div class="product__image">
                <img src="assets/images/auth-one-bg.jpg" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>                
            </div>
        </div> <!--product-->

        <div class="product">
            <div class="product__image">
                <img src="https://wallpapercave.com/wp/wp8112249.jpg" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>                
            </div>
        </div> <!--product-->

        <div class="product">
            <div class="product__image">
                <img src="https://cdn-icons-png.flaticon.com/512/6152/6152273.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>                
            </div>
        </div> <!--product-->

        <div class="product">
            <div class="product__image">
                <img src="assets/images/auth-one-bg.jpg" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>                
            </div>
        </div> <!--product-->

        <div class="product">
            <div class="product__image">
                <img src="assets/images/auth-one-bg.jpg" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>                
            </div>
        </div> <!--product-->

        <div class="product">
            <div class="product__image">
                <img src="assets/images/auth-one-bg.jpg" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>                
            </div>
        </div> <!--product-->
    </div>

</main>

<?= $this->include("public/templates/pagination");?>

<?php $this->endSection('content');?>
