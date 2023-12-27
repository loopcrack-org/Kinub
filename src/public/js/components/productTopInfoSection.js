import Drift from 'drift-zoom';
import lightGallery from 'lightgallery';
import lgFullscreen from 'lightgallery/plugins/fullscreen/lg-fullscreen.min.js';
import lgThumbnail from 'lightgallery/plugins/thumbnail/lg-thumbnail.min.js';
import lgVideo from 'lightgallery/plugins/video/lg-video.min.js';
import lgZoom from 'lightgallery/plugins/zoom/lg-zoom.min.js';
import Plyr from 'plyr';
import Swiper from 'swiper/bundle';

const SWIPER_SELECTOR = '.swiper';
const SWIPER_SLIDE_SELECTOR = '.swiper-slide';
const SWIPER_SELECTED_SLIDE_SELECTOR = '.swiper-slide--selected';
const MOBILE_MEDIA_QUERY = '(min-width: 64rem)';

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

let preventSlideClick = false;
let activePlyr = null;
let currentIndex = 0;
const slides = document.querySelectorAll(SWIPER_SLIDE_SELECTOR);
const swiperInstance = initializeSwiper();
initializeSlideClickListeners(slides);
const lightGalleryInstance = initializeLightGallery();
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

function initializeSwiper() {
  const swiper = new Swiper(SWIPER_SELECTOR, SWIPER_CONFIG);
  return swiper;
}

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
  updateCounters(srcProps.index);
  updateMainContent(srcProps);
}

function updateCounters(index) {
  const counters = document.querySelectorAll('.carousel__counter');
  counters.forEach((counter) => {
    counter.textContent = `${formatNumber(+index + 1)} / ${formatNumber(slides.length)}`;
  });
}

function updateMainContent(srcProps) {
  const mainImg = document.querySelector('.carousel__main-img');
  const mainVideoContainer = document.querySelector('.carousel__main-video-container');
  const mainVideo = mainVideoContainer.querySelector('.carousel__main-video');

  if (srcProps.video) {
    updateVideoContent(mainVideo, mainVideoContainer, mainImg, srcProps.video);
  } else {
    updateImageContent(mainImg, mainVideoContainer, srcProps.src);
  }
}

function updateVideoContent(mainVideo, mainVideoContainer, mainImg, videoInfo) {
  if (!activePlyr) {
    activePlyr = new Plyr(mainVideo, {
      autoplay: false,
      muted: true,
      hideControls: true,
      controls: ['play-large', 'pip'],
    });
  }
  activePlyr.source = {
    type: 'video',
    sources: videoInfo.source,
  };
  mainVideoContainer.style.display = 'block';
  mainImg.style.display = 'none';
}

function updateImageContent(mainImg, mainVideoContainer, src) {
  if (activePlyr) {
    activePlyr.pause();
  }
  mainImg.src = src;
  mainImg.style.display = 'block';
  mainVideoContainer.style.display = 'none';
}

function formatNumber(number) {
  return number.toString().padStart(2, '0');
}
