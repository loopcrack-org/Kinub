<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/common/css/bootstrap.min.css" type="text/css">
<?php $this->endSection(); ?>

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
