import Tingle from 'tingle.js';

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
