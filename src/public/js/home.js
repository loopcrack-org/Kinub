import customSelect from 'custom-select';
import Plyr from 'plyr';
import Swal from 'sweetalert2';
import { VanillaValidator } from '../libs/vanilla-validator/vanilla-validator-concat.js';

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

new Plyr('#kinub-video');

const cstSel = customSelect('#product-name')[0];

cstSel.container.addEventListener('custom-select:open', () => {
  cstSel.container.classList.add('turn-arrow');
});

cstSel.container.addEventListener('custom-select:close', () => {
  cstSel.container.classList.remove('turn-arrow');
});

const showAlert = (props) => {
  Swal.fire({
    ...props,
  });
};

window.showAlert = showAlert;

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

new VanillaValidator(configValidator);
