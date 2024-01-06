<?php
$categories    = [];
$categorieTags = [];
$productTags   = [];

for ($i = 1; $i <= 8; $i++) {
    $categories[] = [
        'name'     => "{$i}",
        'selected' => (bool) random_int(0, 1),
    ];
    $categorieTags[] = [
        'name'     => "{$i}",
        'selected' => (bool) random_int(0, 1),
    ];
    $productTags[] = [
        'name'     => "{$i}",
        'selected' => (bool) random_int(0, 1),
    ];
}
?>

<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/category.min.css" type="text/css">
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script src="assets/public/js/category.min.js"></script>
<script src="assets/public/js/sideBar.min.js"></script>
<script src="assets/public/js/categoryQueries.min.js"></script>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<header class="jumbotron" style="background-image: url(/assets/images/Telemetria.jpeg);">
    <h1 class="jumbotron__title">Telemetría</h1>
</header>

<main class="category">
    <div class="sidebar">
        <nav class="sidebar__nav sidebar__nav--active">
            <header class="sidebar__header">
                <div class="sidebar__header-info">
                    <span class="sidebar__title">Filtros</span>

                    <div class="sidebar__close" id="sidebar-close">
                        <svg xmlns="http://www.w3.org000/svg" width="35" height="35" viewBox="0 0 24 24" style="fill: #0150aa;"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
                    </div>
                </div>

                <div class="selected-filters">
                    <label class="selected-filters__title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" stroke="currentColor" stroke-width="1" class="bi bi-funnel" viewBox="0 0 16 16">
                            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
                        </svg>
                        Filtros Seleccionados
                    </label>

                    <button class="selected-filters__clear-btn" id="clear-filters-btn">
                        Limpiar Filtros
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                    </button>

                    <div class="selected-filters__summary">
                        <div class="selected-filters__container" data-title="Categorías">
                            <label class="selected-filters__name-container">Categorías</label>
                            <ul class="selected-filters__list"></ul>
                        </div>
                        <div class="selected-filters__container" data-title="Tags de Categorías">
                            <label class="selected-filters__name-container">Tags de Categorías</label>
                            <ul class="selected-filters__list"></ul>
                        </div>
                        <div class="selected-filters__container" data-title="Tags de Producto">
                            <label class="selected-filters__name-container">Tags de Producto</label>
                            <ul class="selected-filters__list"></ul>
                        </div>
                    </div>
                </div>
            </header>

            <div class="sidebar__menu-bar">
                <div class="menu-section" data-title="Categorías">
                    <span class="menu-section__button">
                        Categorías

                        <svg class="menu-section__icon menu-section__icon--active" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0168dd" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" stroke="#0168dd" stroke-width="2"/>
                        </svg>
                    </span>
                    <div class="menu-section__dropdown  menu-section__dropdown--active">
                        <div class="menu-section__list-container">
                            <div class="menu-section__list">
                                <?php foreach($categories as $category): ?>
                                    <div class="menu-section__item">
                                        <input class="menu-section__checkbox" type="checkbox" <?=$category['selected'] ? 'checked' : '' ?> >
                                        <label class="menu-section__label" for="c1">Categoría <?=$category['name']?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <button class="menu-section__more-btn">Ver más</button>
                            <button class="menu-section__less-btn" hidden>Ver menos</button>
                        </div>
                    </div>
                </div>

                <div class="menu-section" data-title="Tags de Categorías">
                    <span class="menu-section__button">
                        Tags de la Categoría

                        <svg class="menu-section__icon menu-section__icon--active" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0168dd" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" stroke="#0168dd" stroke-width="2"/>
                        </svg>
                    </span>

                    <div class="menu-section__dropdown menu-section__dropdown--active">
                        <div class="menu-section__list-container">
                           <div class="menu-section__list">
                                <?php foreach($categorieTags as $categoryTag): ?>
                                    <div class="menu-section__item">
                                        <input class="menu-section__checkbox" type="checkbox" <?=$categoryTag['selected'] ? 'checked' : '' ?> >
                                        <label class="menu-section__label" for="pc2">Tag de Categoría <?=$categoryTag['name']?></label>
                                    </div>
                                <?php endforeach; ?>
                           </div>

                            <button class="menu-section__more-btn">Ver más</button>
                            <button class="menu-section__less-btn" hidden>Ver menos</button>
                        </div>
                    </div>
                </div>

                <div class="menu-section" data-title="Tags de Producto">
                    <span class="menu-section__button">
                        Tags del Producto

                        <svg class="menu-section__icon menu-section__icon--active" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0168dd" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" stroke="#0168dd" stroke-width="2"/>
                        </svg>
                    </span>

                    <div class="menu-section__dropdown  menu-section__dropdown--active">
                        <div class="menu-section__list-container">
                            <div class="menu-section__list">
                                <?php foreach($productTags as $productTag): ?>
                                    <div class="menu-section__item">
                                        <input class="menu-section__checkbox" type="checkbox" <?=$productTag['selected'] ? 'checked' : '' ?> >
                                        <label class="menu-section__label" for="pt1">Tag de Producto <?=$productTag['name']?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <button class="menu-section__more-btn">Ver más</button>
                            <button class="menu-section__less-btn" hidden>Ver menos</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="sidebar__background sidebar__background--active"></div>
    </div>

    <div class="category__products-container">
        <section class="search">
            <form class="search__form" method="post">

                <input class="search__bar" id="autoComplete" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off" maxlength="2048" tabindex="1" placeholder="Buscar">
            </form>
            <div class="search__choices">
                <div class="search__displays">
                    <div class="search__display search__display--grid search__display--active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="search__display-icon  bi bi-columns-gap" viewBox="0 0 16 16">
                            <path d="M6 1v3H1V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm14 12v3h-5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM6 8v7H1V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm14-6v7h-5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1z"/>
                        </svg>
                    </div>

                    <div class="search__display search__display--list">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="search__display-icon bi bi-list-nested" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h10a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 1 3h10a.5.5 0 0 1 0 1H1a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </div>
                </div>

                <button id="sidebar-open" class="search__filter-button">
                    <span class="search__filter-button-text">Filtros</span>

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="search__display-icon bi bi-filter" viewBox="0 0 16 16">
                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
                    </svg>
                </button>

                <select class="search__sorting" name="sorting" id="sorting">
                    <option value="1">De la A-Z</option>
                    <option value="2">De la Z-A</option>
                </select>
            </div>


        </section>

        <div class="category__grid">

            <div class="product kinub-card">
                <div class="product__image-container">
                    <img src="assets/images/imagen-catalogo.png" alt="" class="product__image">
                </div>
                <div class="list-content list-content--disabled">
                    <p class="product__name">E-101</p>

                    <div class="tags">
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                        </a>
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">LoRaWAN OMS</p>
                        </a>
                    </div>

                    <div class="list-content__details">
                        <p class="list-content__detail"><span class="list-content__detail--title">Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                    </div>

                    <a href="/producto" class="product__button product__button--list">Ver más</a>
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
                <div class="list-content list-content--disabled">
                    <p class="product__name">E-101</p>

                    <div class="tags">
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                        </a>
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">LoRaWAN OMS</p>
                        </a>
                    </div>

                    <div class="list-content__details">
                        <p class="list-content__detail"><span class="list-content__detail--title">Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                    </div>

                    <a href="/producto" class="product__button product__button--list">Ver más</a>
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

                <div class="list-content list-content--disabled">
                    <p class="product__name">E-101</p>

                    <div class="tags">
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                        </a>
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">LoRaWAN OMS</p>
                        </a>
                    </div>

                    <div class="list-content__details">
                        <p class="list-content__detail"><span class="list-content__detail--title">Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                    </div>

                    <a href="/producto" class="product__button product__button--list">Ver más</a>
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
                <div class="list-content list-content--disabled">
                    <p class="product__name">E-101</p>

                    <div class="tags">
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                        </a>
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">LoRaWAN OMS</p>
                        </a>
                    </div>

                    <div class="list-content__details">
                        <p class="list-content__detail"><span class="list-content__detail--title">Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                    </div>

                    <a href="/producto" class="product__button product__button--list">Ver más</a>
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

                <div class="list-content list-content--disabled">
                    <p class="product__name">E-101</p>

                    <div class="tags">
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                        </a>
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">LoRaWAN OMS</p>
                        </a>
                    </div>

                    <div class="list-content__details">
                        <p class="list-content__detail"><span class="list-content__detail--title">Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                    </div>

                    <a href="/producto" class="product__button product__button--list">Ver más</a>
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

                <div class="list-content list-content--disabled">
                    <p class="product__name">E-101</p>

                    <div class="tags">
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                        </a>
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">LoRaWAN OMS</p>
                        </a>
                    </div>

                    <div class="list-content__details">
                        <p class="list-content__detail"><span class="list-content__detail--title">Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                    </div>

                    <a href="/producto" class="product__button product__button--list">Ver más</a>
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

                <div class="list-content list-content--disabled">
                    <p class="product__name">E-101</p>

                    <div class="tags">
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                        </a>
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">LoRaWAN OMS</p>
                        </a>
                    </div>

                    <div class="list-content__details">
                        <p class="list-content__detail"><span class="list-content__detail--title">Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                    </div>

                    <a href="/producto" class="product__button product__button--list">Ver más</a>
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

                <div class="list-content list-content--disabled">
                    <p class="product__name">E-101</p>

                    <div class="tags">
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                        </a>
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">LoRaWAN OMS</p>
                        </a>
                    </div>

                    <div class="list-content__details">
                        <p class="list-content__detail"><span class="list-content__detail--title">Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                    </div>

                    <a href="/producto" class="product__button product__button--list">Ver más</a>
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

                <div class="list-content list-content--disabled">
                    <p class="product__name">E-101</p>

                    <div class="tags">
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">Dialog 3Gtm 9xx Mhz</p>
                        </a>
                        <a href="#" class="tags__tag">
                            <p class="tags__tag-content">LoRaWAN OMS</p>
                        </a>
                    </div>

                    <div class="list-content__details">
                        <p class="list-content__detail"><span class="list-content__detail--title">Frecuencia: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Rango de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                        <p class="list-content__detail"><span class="list-content__detail--title">Precisión de medición: </span>Lorem ipsum dolor sit amet consectetur</p>
                    </div>

                    <a href="/producto" class="product__button product__button--list">Ver más</a>
                </div>

                <div class="product__content">
                    <p class="product__name">E-101</p>
                    <a href="/producto" class="product__button">Ver más</a>
                </div>
            </div> <!--product-->
        </div>
    </div>
</main>

<?php $this->endSection('content'); ?>
