<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/app.min.css" type="text/css">
<link rel="stylesheet" href="assets/public/css/category.min.css" type="text/css">
<?php $this->endSection(); ?>

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
