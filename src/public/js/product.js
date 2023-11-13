import Plyr from 'plyr';
import ScrollMagic from 'scrollmagic';
import Tingle from 'tingle.js';
import '../../libs/vanilla-js-accordions/AccordionElement.min.js';

new Plyr('#product-video');

const scrollmagicController = new ScrollMagic.Controller();
const sections = document.querySelectorAll('.product-info');
const navLinks = document.querySelectorAll('.product-navigation__link-container');

const updateActiveLink = (sectionId) => {
  navLinks.forEach((link) => {
    link.classList.remove('product-navigation__link-container--active');
    const href = link.getAttribute('href');
    if (href === `#${sectionId}`) {
      link.classList.add('product-navigation__link-container--active');
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

const modal = new Tingle.modal({
  footer: true,
  stickyFooter: false,
  closeMethods: ['overlay', 'button', 'escape'],
  closeLabel: 'Close',
  cssClass: ['custom-modal-box-size'],
  onOpen: function () {
    console.log('modal open');
  },
  onClose: function () {
    console.log('modal closed');
  },
  beforeClose: function () {
    return true;
  },
});

const modalFormContent = document.querySelector('#modal-form');
modal.setContent(modalFormContent.innerHTML);

const modalBtn = document.querySelector('#modal-form-btn');

modalBtn.addEventListener('click', function () {
  modal.open();
});

modal.addFooterBtn('Enviar', 'modal-form__submit', function () {
  modalFormContent.submit();
  modal.close();
});
