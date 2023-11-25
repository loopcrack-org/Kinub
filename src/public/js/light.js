import lightGallery from 'lightgallery';
import lgFullscreen from 'lightgallery/plugins/fullscreen/lg-fullscreen.min.js';
import lgThumbnail from 'lightgallery/plugins/thumbnail/lg-thumbnail.min.js';
import lgVideo from 'lightgallery/plugins/video/lg-video.min.js';
import lgZoom from 'lightgallery/plugins/zoom/lg-zoom.min.js';

export function initLightGallery() {
  const lightgalleryProductContainer = document.getElementById('lightgallery-product');
  let lightInstance = initLightGalleryInstance(lightgalleryProductContainer);

  function handleResize() {
    const isDesktopView = isDesktop();
    if (isDesktopView && lightInstance) {
      lightInstance.destroy();
      lightInstance = null;
    } else if (!isDesktopView && !lightInstance) {
      lightInstance = initLightGalleryInstance(lightgalleryProductContainer);
    }
  }

  window.addEventListener('resize', handleResize);

  function initLightGalleryInstance(container) {
    const light = lightGallery(container, {
      licenseKey: '927D6AF3-9D4E-4315-A976-33AFB1C334EF',
      plugins: [lgThumbnail, lgZoom, lgFullscreen, lgVideo],
      thumbnail: true,
      download: false,
      selector: '.glide__slide',
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
