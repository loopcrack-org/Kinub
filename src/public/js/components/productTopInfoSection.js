import Drift from 'drift-zoom';
import lightGallery from 'lightgallery';
import lgFullscreen from 'lightgallery/plugins/fullscreen/lg-fullscreen.min.js';
import lgThumbnail from 'lightgallery/plugins/thumbnail/lg-thumbnail.min.js';
import lgVideo from 'lightgallery/plugins/video/lg-video.min.js';
import lgZoom from 'lightgallery/plugins/zoom/lg-zoom.min.js';
import { updateCounters, updateMainContent } from './contentUpdate';
import { initializeSwiper } from './swiper';

const SWIPER_SLIDE_SELECTOR = '.swiper-slide';
const SWIPER_SELECTED_SLIDE_SELECTOR = '.swiper-slide--selected';
const MOBILE_MEDIA_QUERY = '(min-width: 64rem)';

let preventSlideClick = false;
let currentIndex = 0;
const slides = document.querySelectorAll(SWIPER_SLIDE_SELECTOR);
const swiperInstance = initializeSwiper();
const lightGalleryInstance = initializeLightGallery();

initializeSlideClickListeners(slides);
initializeMediaQueryListener();
setActiveSlide(document.querySelector(SWIPER_SELECTED_SLIDE_SELECTOR));

new Drift(document.querySelector('.carousel__main-img'), {
  sourceAttribute: 'src',
  paneContainer: document.querySelector('.details__info'),
  inlinePane: false,
  zoomFactor: 3,
  hoverBoundingBox: true,
});

document.querySelector('.carousel__active-element').addEventListener('click', () => {
  lightGalleryInstance.openGallery(currentIndex);
});

function initializeSlideClickListeners(slides) {
  slides.forEach((slide) => {
    slide.addEventListener(
      'click',
      function (event) {
        if (preventSlideClick) {
          event.preventDefault();
          event.stopPropagation();
        }
        setActiveSlide(this);
      },
      true
    );
  });
  swiperInstance.on('slideChange', function () {
    const selectedSlide = document.querySelector(
      `${SWIPER_SLIDE_SELECTOR}[data-index="${swiperInstance.realIndex}"]`
    );
    setActiveSlide(selectedSlide);
  });
}

function initializeLightGallery() {
  const container = document.getElementById('lightgallery-product');

  const lightG = lightGallery(container, {
    licenseKey: '927D6AF3-9D4E-4315-A976-33AFB1C334EF',
    plugins: [lgThumbnail, lgZoom, lgFullscreen, lgVideo],
    thumbnail: true,
    download: false,
    hideScrollbar: true,
    zoomFromOrigin: false,
    mobileSettings: {
      showCloseIcon: true,
    },
  });

  container.addEventListener('lgBeforeClose', () => {
    swiperInstance.slideTo(lightG.index);
    const selectedSlide = document.querySelector(
      `${SWIPER_SLIDE_SELECTOR}[data-index="${lightG.index}"]`
    );
    setActiveSlide(selectedSlide);
  });
  return lightG;
}

function initializeMediaQueryListener() {
  const mediaQuery = window.matchMedia(MOBILE_MEDIA_QUERY);
  mediaQuery.addEventListener('change', () => setUIBasedOnMediaQuery(mediaQuery));
  setUIBasedOnMediaQuery(mediaQuery);
}

function setUIBasedOnMediaQuery(mediaQuery) {
  preventSlideClick = mediaQuery.matches;
}

function setActiveSlide(selectedSlide) {
  slides.forEach((element) => element.classList.remove('swiper-slide--selected'));
  selectedSlide.classList.add('swiper-slide--selected');
  updateCarouselUI(selectedSlide);
}

function updateCarouselUI(selectedSlide) {
  const srcProps = {
    src: selectedSlide.getAttribute('data-src'),
    video: JSON.parse(selectedSlide.getAttribute('data-video')),
    index: selectedSlide.getAttribute('data-index'),
  };
  currentIndex = srcProps.index;
  updateCounters(srcProps.index, slides);
  updateMainContent(srcProps);
}
