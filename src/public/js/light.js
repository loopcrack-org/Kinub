import lightGallery from 'lightgallery';

export function initLightGallery() {
  const light = lightGallery(document.querySelector('.glide__slides'), {
    licenseKey: '',
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
