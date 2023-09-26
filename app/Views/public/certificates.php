<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/css/public.min.css" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<?php $this->endSection(); ?>

<?php $this->section('fonts'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700;900&family=Nunito+Sans:opsz,wght@6..12,200;6..12,400;6..12,500;6..12,700;6..12,900&display=swap" rel="stylesheet">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<main class="certificates">

    <h1 class="certificates__heading">Certificados</h1>
    
    <section class="certificates__grid">
        <div href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="https://wallpapercave.com/wp/wp8112249.jpg" alt="" class="certificate__image">
            </div>
            <div class="certificate__information">
                <a href="#" class="certificate__name">Certificado con algún nombre no tan largo</a>
            </div>
        </div>

        <div href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="" class="certificate__image">
            </div>
            
            <div class="certificate__information">
                <a href="#" class="certificate__name">Certificado con nombre un poco más largo que el otro</a>
            </div>
        </div>

        <div href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="" class="certificate__image">
            </div>
            <div class="certificate__information">
                <a href="#" class="certificate__name">Certificado con algún nombre no tan largo</a>
            </div>
        </div>

        <div href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="" class="certificate__image">
            </div>
            <div class="certificate__information">
                <a href="#" class="certificate__name">Certificado con algún nombre no tan largo</a>
            </div>
        </div>

        <div href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="" class="certificate__image">
            </div>
            <div class="certificate__information">
                <a href="#" class="certificate__name">Certificado con algún nombre no tan largo</a>
            </div>
        </div>

        <div href="#" target="_blank" class="certificate">
            <div class="certificate__image">
                <img src="assets/images/auth-one-bg.jpg" alt="" class="certificate__image">
            </div>
            <div class="certificate__information">
                <a href="#" class="certificate__name">Certificado con algún nombre no tan largo</a>
            </div>
        </div>

    </section>
</main>

<nav aria-label="Page navigation" class="pagination-container">
  <ul class="pagination">
    <li class="link-container page-item">
      <a class="pagination__link page-link d-flex justify-content-center align-items-center rounded-circle  border border-0" href="#" aria-label="Previous">
        <span aria-hidden="true">
            <svg class="arrow" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
            </svg>
        </span>
      </a>
    </li>
    <li class="link-container page-item"><a class="pagination__link page-link d-flex justify-content-center align-items-center text-body-tertiary fs-2 border border-0" href="#">1</a></li>
    <li class="link-container page-item"><a class="pagination__link page-link d-flex justify-content-center align-items-center text-body-tertiary fs-2 border border-0" href="#">2</a></li>
    <li class="link-container page-item"><a class="pagination__link page-link d-flex justify-content-center align-items-center text-body-tertiary fs-2 border border-0" href="#">3</a></li>
    <li class="link-container page-item">
      <a class="pagination__link page-link d-flex justify-content-center align-items-center rounded-circle border border-0" href="#" aria-label="Next">
        <span aria-hidden="true">
            <svg class="arrow" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
            </svg>
        </span>
      </a>
    </li>
  </ul>
</nav>

<?php $this->endSection('content');?>