import Glide from '@glidejs/glide';
import mediumZoom from 'medium-zoom';
import Plyr from 'plyr';
import '../../libs/vanilla-js-accordions/AccordionElement.min.js';

// eslint-disable-next-line no-unused-vars
const player = new Plyr('#product-video');

const glide = new Glide('.glide', {
  type: 'carousel',
  startAt: 0,
  perView: 5,
  keyboard: true,
  focusAt: 0,

  breakpoints: {
    400: {
      perView: 3,
    },
    600: {
      perView: 3,
      focusAt: 'center',
    },
    767: {
      perView: 5,
      dragThreshold: 5,
    },

    1024: {
      perView: 3,
    },

    1200: {
      perView: 4,
    },
  },
});
glide.mount();

document.querySelectorAll('.glide__slide').forEach((slide) => {
  const mainImage = document.getElementById('main-image');
  const selectedImage = slide.querySelector('img');

  slide.addEventListener('click', () => {
    if (mainImage.src !== selectedImage.src) {
      mainImage.src = selectedImage.src;
      mainImage.alt = selectedImage.alt;
    }
  });
});

const zoom = mediumZoom();
const mainImage = document.querySelector('#main-image');

if (isMobile()) {
  zoom.attach('#main-image');
  zoom.update({ background: 'rgba(25, 18, 25, .9)' });
}

window.addEventListener('resize', () => {
  if (isMobile()) {
    if (!mainImage.classList.contains('medium-zoom-image')) {
      zoom.attach('#main-image');
      zoom.update({ background: 'rgba(25, 18, 25, .9)' });
    }
  } else {
    zoom.detach();
  }
});

function isMobile() {
  return window.innerWidth < 1024;
}
