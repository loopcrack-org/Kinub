import Glide from '@glidejs/glide';
import intlTelInput from 'intl-tel-input';
import Plyr from 'plyr';
import ScrollMagic from 'scrollmagic';
import Swal from 'sweetalert2';
import Tingle from 'tingle.js';
import '../libs/vanilla-js-accordions/AccordionElement.min.js';
import { VanillaValidator } from '../libs/vanilla-validator/vanilla-validator-concat.js';
import { initLightGallery } from './light.js';
import { magnifyImage } from './magnify.js';

new Plyr('#product-video');

const showAlert = (props) => {
  Swal.fire({
    ...props,
  });
};

window.showAlert = showAlert;

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
const mainImage = document.querySelector('#main-image');
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
  } else {
    const firstSlide = document.querySelector('.glide__slide');
    const dataVideoAttributeFirstSlide = firstSlide.getAttribute('data-video');
    const videoFirstSlide = dataVideoAttributeFirstSlide !== null;

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
      magnified.style.backgroundImage = `url('${imageFirstSlide.src}')`;
    }

    if (magnified) magnified.style.backgroundImage = `url('${mainImage.src}')`;

    document.querySelectorAll('.glide__slide').forEach((slide) => {
      const sliderImage = slide.querySelector('img');
      const dataVideoAttribute = slide.getAttribute('data-video');

      slide.addEventListener('click', () => {
        if (dataVideoAttribute === null) {
          if (mainImage.src !== sliderImage.src) {
            mainImage.src = sliderImage.src;
            mainImage.alt = sliderImage.alt;
            magnified.style.backgroundImage = `url('${sliderImage.src}')`;
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

const zoom = document.getElementById('main-image-container');
if (zoom) {
  zoom.addEventListener('mousemove', magnifyImage, false);
}

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
const phoneInputField = clonedForm.querySelector('#phone');
const phoneInput = intlTelInput(phoneInputField, {
  preferredCountries: ['mx'],
  utilsScript: require('intl-tel-input/build/js/utils.js'),
});

modal.setContent(clonedForm);

if (clonedForm.classList.contains('form-error')) {
  modal.open();
}

modalOpen.addEventListener('click', function () {
  modal.open();
});

modalClose.addEventListener('click', function () {
  modal.close();
});

function isMobile() {
  return window.innerWidth < 1024;
}

const errorMap = [
  'El número de teléfono proporcionado no es válido',
  'Código de país no válido',
  'El número de teléfono es demasiado corto.',
  'El número de teléfono es demasiado largo',
  'El número de teléfono proporcionado no es válido',
];

const commonCustomViewErrors = {
  add: function (field, message, cls) {
    let errorElement = document.querySelector(`.${field.id}.${cls}`);

    if (!errorElement) {
      errorElement = document.createElement('p');
      errorElement.classList.add(field.id, cls);
      clonedForm.querySelector(`[for='${field.id}']`).after(errorElement);
    }

    errorElement.textContent = message;
  },
  remove: function (field, cls) {
    clonedForm.querySelector(`.${field.id}.${cls}`)?.remove();
  },
};

const MESSAGES = {
  required: 'campo obligatorio',
  email: 'correo inválido',
};

const SELECTORS = {
  messageError: 'modal-form__error',
};

const configValidator = {
  container: '.modal-form',
  validateOnFieldChanges: true,
  button: '.modal-form__submit',
  customValidates: {
    intlTelInput: {
      message: errorMap[0],
      fn: function (field) {
        let status = false;
        if (field.value.trim().length > 0 && phoneInput.isValidNumber()) {
          status = true;
        } else {
          const errorCode = phoneInput.getValidationError();
          this.config.customValidates.intlTelInput.message = errorMap[errorCode] ?? errorMap[0];
        }
        return status;
      },
    },
  },
  validateBy: 'click',
  selectors: SELECTORS,
  messages: MESSAGES,
  customViewErrors: commonCustomViewErrors,
};

new VanillaValidator(configValidator);
