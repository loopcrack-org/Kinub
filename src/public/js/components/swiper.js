import Swiper from 'swiper/bundle';

const SWIPER_SELECTOR = '.swiper';

const SWIPER_CONFIG = {
  speed: 1000,
  loopFillGroupWithBlank: false,
  direction: 'horizontal',
  loop: true,
  slidesPerView: 1,
  slidesPerGroup: 1,
  loopFillGroupBlank: false,
  spaceBetween: 7,
  breakpoints: {
    1200: {
      loop: false,
      slidesPerView: 6,
      slidesPerGroup: 6,
    },
    1024: {
      loop: false,
      slidesPerView: 5,
      slidesPerGroup: 5,
    },
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
};

export function initializeSwiper() {
  const swiper = new Swiper(SWIPER_SELECTOR, SWIPER_CONFIG);
  return swiper;
}
