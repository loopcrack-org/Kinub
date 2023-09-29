<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('content'); ?>
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

<?= $this->include("public/templates/pagination-nav");?>

<?php $this->endSection('content');?>
