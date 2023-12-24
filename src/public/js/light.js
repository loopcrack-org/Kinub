import lightGallery from 'lightgallery';
import lgFullscreen from 'lightgallery/plugins/fullscreen/lg-fullscreen.min.js';
import lgThumbnail from 'lightgallery/plugins/thumbnail/lg-thumbnail.min.js';
import lgVideo from 'lightgallery/plugins/video/lg-video.min.js';
import lgZoom from 'lightgallery/plugins/zoom/lg-zoom.min.js';

export function initLightGallery() {
  const lightgalleryProductContainer = document.getElementById('lightgallery-product');
  const [videoContainer, imageContainer] = document.querySelectorAll('.carousel__img-container');

  let lightMobileInstance;
  let lightDesktopInstance;

  const isDesktopView = isDesktop();

  if (isDesktopView) {
    if (videoContainer.classList.contains('.carousel__img-container--selected')) {
      lightDesktopInstance = initLightGalleryInstance(videoContainer, '#main-video');
    } else if (imageContainer.classList.contains('.carousel__img-container--selected')) {
      lightDesktopInstance = initLightGalleryInstance(imageContainer, '#main-image');
    }
  } else if (!isDesktopView) {
    lightMobileInstance = initLightGalleryInstance(lightgalleryProductContainer, '.glide__slide');
  }

  function handleResize() {
    const isDesktopView = isDesktop();
    if (isDesktopView) {
      if (lightMobileInstance) {
        lightMobileInstance.destroy();
        lightMobileInstance = null;
      }

      if (lightDesktopInstance) {
        lightDesktopInstance.destroy();
        lightDesktopInstance = null;
      }

      if (videoContainer.classList.contains('carousel__img-container--selected')) {
        lightDesktopInstance = initLightGalleryInstance(videoContainer, '#main-video');
      } else if (imageContainer.classList.contains('carousel__img-container--selected')) {
        lightDesktopInstance = initLightGalleryInstance(imageContainer, '#main-image');
      }
    } else if (!isDesktopView) {
      if (lightDesktopInstance) {
        lightDesktopInstance.destroy();
        lightDesktopInstance = null;
      }

      if (lightMobileInstance) {
        lightMobileInstance.destroy();
        lightMobileInstance = null;
      }
      lightMobileInstance = initLightGalleryInstance(lightgalleryProductContainer, '.glide__slide');
    }
  }

  window.addEventListener('resize', handleResize);

  function initLightGalleryInstance(container, selector) {
    const light = lightGallery(container, {
      licenseKey: '927D6AF3-9D4E-4315-A976-33AFB1C334EF',
      plugins: [lgThumbnail, lgZoom, lgFullscreen, lgVideo],
      thumbnail: true,
      download: false,
      selector: selector,
      hideScrollbar: true,
      mobileSettings: {
        howCloseIcon: true,
      },
    });

    return light;
  }

  handleResize();
}

function isDesktop() {
  return window.innerWidth >= 1024;
}
