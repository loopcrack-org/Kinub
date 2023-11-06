import Plyr from 'plyr';
import ScrollMagic from 'scrollmagic';
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
  let triggerHookValue = 0.5;
  if (index === sections.length - 1) {
    triggerHookValue = 0.7;
  }
  new ScrollMagic.Scene({
    triggerElement: section,
    duration: section.offsetHeight,
    triggerHook: triggerHookValue,
  })
    .on('enter', () => {
      section.classList.add('product-info--active');
      updateActiveLink(section.id);
    })
    .on('leave', (event) => {
      if (event.scrollDirection === 'REVERSE' && index > 0) {
        const previousSectionId = sections[index - 1].id;
        updateActiveLink(previousSectionId);
        section.classList.remove('product-info--active');
      }
    })
    .addTo(scrollmagicController);
});
