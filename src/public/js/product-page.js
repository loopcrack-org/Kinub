import Plyr from 'plyr';
import ScrollMagic from 'scrollmagic';
import '../../libs/vanilla-js-accordions/AccordionElement.min.js';

new Plyr('#product-video');

const controller = new ScrollMagic.Controller();

function createScrollMagicScene(triggerElement, sectionId, triggerHook, duration) {
  new ScrollMagic.Scene({
    triggerElement,
    triggerHook,
    duration,
  })
    .setClassToggle(`#${sectionId}`, 'product-info--active')
    .addTo(controller)
    .on('enter', function () {
      const links = document.querySelectorAll('.product-navigation__link-container');
      links.forEach((link) => {
        if (link) {
          link.classList.remove('product-navigation__link-container--active');
        }
      });
      document
        .querySelector(`.product-navigation__link-container[href="#${sectionId}"]`)
        .classList.add('product-navigation__link-container--active');
    })
    .on('leave', function (e) {
      const sectionId = e.target.triggerElement().id;
      document
        .querySelector(`.product-navigation__link-container[href="#${sectionId}"]`)
        .classList.remove('product-navigation__link-container--active');
    });
}

createScrollMagicScene('#description', 'description', 'onCenter', '100%');
createScrollMagicScene('#tech-info', 'tech-info', 'onCenter', '100%');
createScrollMagicScene('#download-area', 'download-area', 'onCenter', '50%');
