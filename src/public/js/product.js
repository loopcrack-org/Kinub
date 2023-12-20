import Glide from '@glidejs/glide';
import Drift from 'drift-zoom';
import Plyr from 'plyr';
import ScrollMagic from 'scrollmagic';
import Tingle from 'tingle.js';
import '../libs/vanilla-js-accordions/AccordionElement.min.js';
import { initLightGallery } from './light.js';

new Plyr('#product-video');

const scrollmagicController = new ScrollMagic.Controller();
const sections = document.querySelectorAll('.product-info');
const navLinks = document.querySelectorAll('.product-nav__link-container');

const updateActiveLink = (sectionId) => {
  navLinks.forEach((link) => {
    link.classList.remove('product-nav__link-container--active');
    const href = link.getAttribute('href');
    if (href === `#${sectionId}`) {
      link.classList.add('product-nav__link-container--active');
    }
  });
};

sections.forEach((section, index) => {
  const mediaQuery = window.matchMedia('(min-width: 1920px)');
  let triggerHookValue = 0.5;

  if (mediaQuery.matches) {
    triggerHookValue = 0.3;
  }

  if (index === sections.length - 1) {
    triggerHookValue = 0.72;
  }

  new ScrollMagic.Scene({
    triggerElement: section,
    duration: section.offsetHeight,
    triggerHook: triggerHookValue,
  })
    .on('enter', () => {
      updateActiveLink(section.id);
    })
    .on('leave', (event) => {
      if (event.scrollDirection === 'REVERSE' && index > 0) {
        const previousSectionId = sections[index - 1].id;
        updateActiveLink(previousSectionId);
      }
    })
    .addTo(scrollmagicController);
});

new Glide('.glide', {
  type: 'carousel',
  startAt: 0,
  perView: 6,
  keyboard: true,
  focusAt: 0,
  peek: -13,

  breakpoints: {
    1023: {
      startAt: 0,
      perView: 1,
      dragThreshold: 5,
    },

    1200: {
      startAt: 0,
      perView: 4,
    },
  },
}).mount();

const mainImage = document.querySelector('#main-image');

const drift = new Drift(mainImage, {
  sourceAttribute: 'src',
  paneContainer: document.querySelector('.details__grid'),
  inlinePane: false,
  zoomFactor: 2,
});

const mainVideo = document.querySelector('#main-video');
const videoContainer = document.querySelector('#video-container');
const imageContainer = document.querySelector('#main-image-container');

function updateContainersDisplay(videoDisplay, imageDisplay) {
  videoContainer.style.display = videoDisplay;
  imageContainer.style.display = imageDisplay;
}

handleCarouselResize();

window.addEventListener('resize', () => {
  handleCarouselResize();
});

function handleCarouselResize() {
  if (isMobile()) {
    updateContainersDisplay('none', 'none');
    drift.disable();
  } else {
    const firstSlide = document.querySelector('.glide__slide');
    const dataVideoAttributeFirstSlide = firstSlide.getAttribute('data-video');
    const videoFirstSlide = dataVideoAttributeFirstSlide !== null;
    drift.enable();

    if (videoFirstSlide) {
      updateContainersDisplay('flex', 'none');
      const dataVideoAttribute = firstSlide.getAttribute('data-video');
      let videoData = JSON.parse(dataVideoAttribute);
      let videoSource = videoData.source[0].src;
      mainVideo.src = videoSource;
    } else {
      updateContainersDisplay('none', 'flex');
      let imageFirstSlide = firstSlide.querySelector('img');
      mainImage.src = imageFirstSlide.src;
      mainImage.alt = imageFirstSlide.alt;
    }

    document.querySelectorAll('.glide__slide').forEach((slide) => {
      const sliderImage = slide.querySelector('img');
      const dataVideoAttribute = slide.getAttribute('data-video');

      slide.addEventListener('click', () => {
        if (dataVideoAttribute === null) {
          if (mainImage.src !== sliderImage.src) {
            mainImage.src = sliderImage.src;
            mainImage.alt = sliderImage.alt;
            if (imageContainer.style.display == 'none' && !isMobile()) {
              updateContainersDisplay('none', 'flex');
            }
          }
        } else {
          let videoData = JSON.parse(dataVideoAttribute);
          let videoSource = videoData.source[0].src;
          if (mainVideo.src !== videoSource) {
            mainVideo.src = videoSource;
            if (videoContainer.style.display == 'none' && !isMobile()) {
              updateContainersDisplay('flex', 'none');
            }
          }
        }
      });
    });
  }
}

initLightGallery();

const modal = new Tingle.modal({
  footer: false,
  stickyFooter: false,
  closeMethods: ['overlay', 'button', 'escape'],
  closeLabel: 'Cerrar',
  beforeClose: function () {
    return true;
  },
});

const modalForm = document.querySelector('#modal-form');
const clonedForm = modalForm.cloneNode(true);
const modalOpen = document.querySelector('#modal-form-btn');
const modalClose = clonedForm.querySelector('#modal-form-close');

modal.setContent(clonedForm);

modalOpen.addEventListener('click', function () {
  modal.open();
});

modalClose.addEventListener('click', function () {
  modal.close();
});

clonedForm.addEventListener('submit', function () {
  modal.close();
});

function isMobile() {
  return window.innerWidth < 1024;
}
