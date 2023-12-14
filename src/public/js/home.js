import customSelect from 'custom-select';
import Plyr from 'plyr';
import Swal from 'sweetalert2';

import Swiper from 'swiper/bundle';

// import styles bundle

// init Swiper:
new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  slidesPerView: 4,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
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
