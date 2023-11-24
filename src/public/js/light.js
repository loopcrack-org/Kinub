import lightGallery from 'lightgallery';
import lgThumb from 'lightgallery/plugins/thumbnail/lg-thumbnail.min.js';

export function initLightGallery() {
  const light = lightGallery(document.querySelector('.glide__slides'), {
    licenseKey: '927D6AF3-9D4E-4315-A976-33AFB1C334EF',
    plugins: [lgThumb],
    thumbnail: true,
    selector: '.glide__slide',
    controls: false,
  });

  const lg = document.querySelector('.glide__slides');

  lg.addEventListener('lgContainerResize', () => {
    if (isDesktop) {
      light.closeGallery();
    }
  });
}

function isDesktop() {
  return window.innerWidth > 1024;
}
