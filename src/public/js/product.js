import Glide from '@glidejs/glide';
import Plyr from 'plyr';
import ScrollMagic from 'scrollmagic';
import Tingle from 'tingle.js';
import '../../libs/vanilla-js-accordions/AccordionElement.min.js';
import { initLightGallery } from './light.js';
import { magnifyImage } from './magnify.js';
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
    triggerHookValue = 0.7;
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
  perView: 4,
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

const magnified = document.querySelector('#large-img');
const mainImage = document.getElementById('main-image');
magnified.style.backgroundImage = `url('${mainImage.src}')`;

document.querySelectorAll('.glide__slide').forEach((slide) => {
  const sliderImage = slide.querySelector('img');

  slide.addEventListener('click', () => {
    if (mainImage.src !== sliderImage.src) {
      mainImage.src = sliderImage.src;
      mainImage.alt = sliderImage.alt;
      magnified.style.backgroundImage = `url('${sliderImage.src}')`;
    }
  });
});

initLightGallery();

document.getElementById('zoom').addEventListener('mousemove', magnifyImage, false);

const modal = new Tingle.modal({
  footer: false,
  stickyFooter: false,
  closeMethods: ['overlay', 'button', 'escape'],
  closeLabel: 'Cerrar',
  cssClass: ['custom-modal-form'],
  beforeClose: function () {
    return true;
  },
});

const modalForm = document.querySelector('#modal-form');
const clonedForm = modalForm.cloneNode(true);
const modalBtn = document.querySelector('#modal-form-btn');

modal.setContent(clonedForm);

modalBtn.addEventListener('click', function () {
  modal.open();
});

clonedForm.addEventListener('submit', function () {
  modal.close();
});
