import Plyr from 'plyr';

let activePlyr = null;

export function updateMainContent(srcProps) {
  const mainImg = document.querySelector('.carousel__main-img');
  const mainVideoContainer = document.querySelector('.carousel__main-video-container');
  const mainVideo = mainVideoContainer.querySelector('.carousel__main-video');

  if (srcProps.video) {
    updateVideoContent(mainVideo, mainVideoContainer, mainImg, srcProps.video);
  } else {
    updateImageContent(mainImg, mainVideoContainer, srcProps.src);
  }
}

function updateVideoContent(mainVideo, mainVideoContainer, mainImg, videoInfo) {
  if (!activePlyr) {
    activePlyr = new Plyr(mainVideo, {
      autoplay: false,
      muted: true,
      hideControls: true,
      controls: ['play-large', 'pip'],
    });
  }
  activePlyr.source = {
    type: 'video',
    sources: videoInfo.source,
  };
  mainVideoContainer.style.display = 'block';
  mainImg.style.display = 'none';
}

function updateImageContent(mainImg, mainVideoContainer, src) {
  if (activePlyr) {
    activePlyr.pause();
  }
  mainImg.src = src;
  mainImg.style.display = 'block';
  mainVideoContainer.style.display = 'none';
}

export function updateCounters(index, slides) {
  const counters = document.querySelectorAll('.carousel__counter');
  counters.forEach((counter) => {
    counter.textContent = `${formatNumber(+index + 1)} / ${formatNumber(slides.length)}`;
  });
}

function formatNumber(number) {
  return number.toString().padStart(2, '0');
}
