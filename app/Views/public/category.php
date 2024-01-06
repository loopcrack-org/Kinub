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

                    <div class="selected-filters__summary">

                    </div>

                    <button class="selected-filters__clear-btn" id="clear-filters-btn" hidden>Limpiar Filtros

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                    </button>
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

                                <div class="menu-section__item">
                                    <input class="menu-section__checkbox" id="pt6" type="checkbox">
                                    <label class="menu-section__label" for="pt6">Tag de Producto 6</label>
                                </div>

                                <div class="menu-section__item">
                                    <input class="menu-section__checkbox" id="pt7" type="checkbox">
                                    <label class="menu-section__label" for="pt7">Tag de Producto 7</label>
                                </div>

                                <div class="menu-section__item">
                                    <input class="menu-section__checkbox" id="pt8" type="checkbox">
                                    <label class="menu-section__label" for="pt8">Tag de Producto 8</label>
                                </div>
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
