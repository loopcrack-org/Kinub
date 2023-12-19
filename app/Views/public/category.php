<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/category.min.css" type="text/css">
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script src="assets/public/js/category.min.js"></script>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<header class="jumbotron" style="background-image: url(/assets/images/Telemetria.jpeg);">
    <h1 class="jumbotron__title">Telemetría</h1>
</header>

<main class="category">
    <nav class="sidebar sidebar--active">
        <div class="sidebar__overlay"></div>

        <header class="sidebar__header">
            <span class="sidebar__title">Filtros</span>

            <div class="sidebar__close" id="sidebar-close">
                <svg xmlns="http://www.w3.org000/svg" width="35" height="35" viewBox="0 0 24 24" style="fill: #0150aa;"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
            </div>
        </header>

        <div class="sidebar__menu-bar">
            <div class="menu-section">
                <span class="menu-section__button">
                    Categorías

                    <svg class="menu-section__icon menu-section__icon--active" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </span>

                <div class="menu-section__dropdown  menu-section__dropdown--active">
                    <div class="menu-section__list">
                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="c1" type="checkbox">
                            <label class="menu-section__label" for="c1">Categoría 1</label>
                        </div>

                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="c2" type="checkbox">
                            <label class="menu-section__label" for="c2">Categoría 2</label>
                        </div>

                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="c4" type="checkbox">
                            <label class="menu-section__label" for="c4">Categoría 4</label>
                        </div>

                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="c5" type="checkbox">
                            <label class="menu-section__label" for="c5">Categoría 5</label>
                        </div>

                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="c8" type="checkbox">
                            <label class="menu-section__label" for="c8">Categoría 8</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-section">
                <span class="menu-section__button">
                    Tags de la Categoría

                    <svg class="menu-section__icon menu-section__icon--active" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </span>

                <div class="menu-section__dropdown menu-section__dropdown--active">
                    <div class="menu-section__list">
                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="pc2" type="checkbox">
                            <label class="menu-section__label" for="pc2">Tag de Categoría 2</label>
                        </div>

                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="pc4" type="checkbox">
                            <label class="menu-section__label" for="pc4">Tag de Categoría 4</label>
                        </div>

                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="pc5" type="checkbox">
                            <label class="menu-section__label" for="pc5">Tag de Categoría 5</label>
                        </div>

                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="pc8" type="checkbox">
                            <label class="menu-section__label" for="pc8">Tag de Categoría 8</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-section">
                <span class="menu-section__button">
                    Tags del Producto

                    <svg class="menu-section__icon menu-section__icon--active" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </span>

                <div class="menu-section__dropdown  menu-section__dropdown--active">
                    <div class="menu-section__list">
                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="pt1" type="checkbox">
                            <label class="menu-section__label" for="pt1">Tag de Producto 1</label>
                        </div>

                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="pt2" type="checkbox">
                            <label class="menu-section__label" for="pt2">Tag de Producto 2</label>
                        </div>

                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="pt4" type="checkbox">
                            <label class="menu-section__label" for="pt4">Tag de Producto 4</label>
                        </div>

                        <div class="menu-section__item">
                            <input class="menu-section__checkbox" id="pt5" type="checkbox">
                            <label class="menu-section__label" for="pt5">Tag de Producto 5</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="category__grid">

        <div class="product">
            <div class="product__image-container">
                <img src="assets/images/imagen-catalogo.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->

        <div class="product">
            <div class="product__image-container">
                <img src="https://tse3.mm.bing.net/th?id=OIP.ZTQLS9hW-oRg1SxK6at9TQHaFj&pid=Api&P=0&h=180" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->

        <div class="product">
            <div class="product__image-container">
                <img src="https://cdn-icons-png.flaticon.com/512/6152/6152273.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->

        <div class="product">
            <div class="product__image-container">
                <img src="assets/images/imagen-catalogo.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->

        <div class="product">
            <div class="product__image-container">
                <img src="https://tse4.mm.bing.net/th?id=OIP.1rHJUkntpmgWWtdbuK79TAHaDd&pid=Api&P=0&h=180" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->

        <div class="product">
            <div class="product__image-container">
                <img src="http://www.guiaspracticas.com/wp-content/uploads/image/2d-systems.jpg" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->
        <div class="product">
            <div class="product__image-container">
                <img src="https://mail.monitoreointeligente.com/wp-content/uploads/2021/08/v1-3.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->
        <div class="product">
            <div class="product__image-container">
                <img src="assets/images/imagen-catalogo.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->
        <div class="product">
            <div class="product__image-container">
                <img src="assets/images/imagen-catalogo.png" alt="" class="product__image">
            </div>
            <div class="product__content">
                <p class="product__name">E-101</p>
                <a href="/product.php" class="product__button">Ver más</a>
            </div>
        </div> <!--product-->
    </div>

</main>

<?php $this->endSection('content'); ?>
