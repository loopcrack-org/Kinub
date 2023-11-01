import Plyr from 'plyr';
import ScrollMagic from 'scrollmagic';
import '../../libs/vanilla-js-accordions/AccordionElement.min.js';

new Plyr('#product-video');

const controller = new ScrollMagic.Controller();

const sections = document.querySelectorAll('.product-info');

function createScrollScene(section, triggerHookValue) {
  const id = section.getAttribute('id');
  const menuLink = document.querySelector(`.product-navigation__link-container[href="#${id}"]`);

  return new ScrollMagic.Scene({
    triggerElement: section,
    triggerHook: triggerHookValue,
  })
    .on('enter', () => {
      const menuLinkSelected = document.querySelector(
        '.product-navigation__link-container.product-navigation__link-container--active'
      );
      if (menuLinkSelected) {
        menuLinkSelected.classList.remove('product-navigation__link-container--active');
      }

      const sectionSelected = document.querySelector('.product-info.product-info--active');
      if (sectionSelected) {
        sectionSelected.classList.remove('product-info--active');
      }

      menuLink.classList.add('product-navigation__link-container--active');
      section.classList.add('product-info--active');
    })
    .on('leave', () => {
      menuLink.classList.remove('product-navigation__link-container--active');
      section.classList.remove('product-info--active');
    })
    .addTo(controller);
}

sections.forEach((section, index) => {
  let triggerHookValue = 0.5;

  if (index === sections.length - 1) {
    triggerHookValue = 0.8;
  }

  createScrollScene(section, triggerHookValue);
});
