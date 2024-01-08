import Tingle from 'tingle.js';
import { VanillaValidator } from '../../libs/vanilla-validator/vanilla-validator-concat.js';
import createIntTelInput from './telInput.js';

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
const phoneInput = createIntTelInput(phoneInputField);

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
  validationBy: 'onclick',
  selectors: SELECTORS,
  messages: MESSAGES,
  customViewErrors: commonCustomViewErrors,
  onFormSubmit: function (container) {
    container.querySelector('.modal-form__submit').disabled = true;
    container.submit();
  },
};

new VanillaValidator(configValidator);
