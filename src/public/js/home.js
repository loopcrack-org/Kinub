import customSelect from 'custom-select';
import Plyr from 'plyr';
import { VanillaValidator } from '../libs/vanilla-validator/vanilla-validator-concat.js';
import './components/alertModal.js';

import Swiper from 'swiper/bundle';
// init Swiper:
new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  slidesPerView: 4,
  breakpoints: {
    280: {
      slidesPerView: 2,
    },
    490: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 4,
    },
  },
  pagination: {
    el: '.swiper-pagination',
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

new Plyr('#kinub-video', {
  muted: true,
});

const cstSel = customSelect('#product-name')[0];

cstSel.container.addEventListener('custom-select:open', () => {
  cstSel.container.classList.add('turn-arrow');
});

cstSel.container.addEventListener('custom-select:close', () => {
  cstSel.container.classList.remove('turn-arrow');
});

const commonCustomViewErrors = {
  add: function (field, message, cls) {
    let errorElement = document.querySelector(`.${field.id}.${cls}`);

    if (!errorElement) {
      errorElement = document.createElement('p');
      errorElement.classList.add(field.id, cls);
      document.querySelector(`[for='${field.id}']`).after(errorElement);
    }

    errorElement.textContent = message;
  },
  remove: function (field, cls) {
    document.querySelector(`.${field.id}.${cls}`)?.remove();
  },
};

const MESSAGES = {
  required: 'campo obligatorio',
  email: 'correo inválido',
};

const SELECTORS = {
  messageError: 'form__error--small',
};

const configValidator = {
  container: '.form',
  validateOnFieldChanges: true,
  button: '.form__submit',
  validationBy: 'onclick',
  selectors: SELECTORS,
  messages: MESSAGES,
  customViewErrors: commonCustomViewErrors,
  onFormSubmit: function (container) {
    container.querySelector('.form__submit').disabled = true;
    container.submit();
  },
};

const msBottomHighlight = document.querySelectorAll('.measurement-solution__bottom-highlight');

const colors = ['#1b90c7', '#0174f6', '#186d96', '#0032ab', '#58b5e0'];

msBottomHighlight.forEach((element, index) => {
  const colorIndex = index % colors.length;
  element.style.setProperty('--bottom-highlight-color', colors[colorIndex]);
});

new VanillaValidator(configValidator);
