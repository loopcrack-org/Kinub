/* -----------------------------------------------
/* How to use? : Check the GitHub README
/* ----------------------------------------------- */

/* To load a config file (particles.json) you need to host this demo (MAMP/WAMP/local)... */
/*
particlesJS.load('particles-js', 'particles.json', function() {
  console.log('particles.js loaded - callback');
});
*/

/* Otherwise just put the config content (json): */

// eslint-disable-next-line no-undef
particlesJS('auth-particles', {
  particles: {
    number: {
      value: 50,
      density: {
        enable: true,
        value_area: 800,
      },
    },
    color: {
      value: '#ffffff',
    },
    shape: {
      type: 'polygon',
      stroke: {
        width: 0,
        color: '#000',
      },
      polygon: {
        nb_sides: 9,
      },
      image: {
        src: 'img/github.svg',
        width: 100,
        height: 100,
      },
    },
    opacity: {
      value: 0.5,
      random: false,
      anim: {
        enable: true,
        speed: 0.1,
        opacity_min: 0.1,
        sync: false,
      },
    },
    size: {
      value: 10,
      random: false,
      anim: {
        enable: false,
        speed: 10,
        size_min: 40,
        sync: false,
      },
    },
    line_linked: {
      enable: true,
      distance: 200,
      color: '#ffffff',
      opacity: 1,
      width: 2,
    },
    move: {
      enable: true,
      speed: 3,
      direction: 'none',
      random: true,
      straight: false,
      out_mode: 'out',
      bounce: false,
      attract: {
        enable: true,
        rotateX: 3472.256473489519,
        rotateY: 4024.660912453761,
      },
    },
  },
  interactivity: {
    detect_on: 'window',
    events: {
      onhover: {
        enable: false,
        mode: 'repulse',
      },
      onclick: {
        enable: true,
        mode: 'repulse',
      },
      resize: true,
    },
    modes: {
      grab: {
        distance: 400,
        line_linked: {
          opacity: 1,
        },
      },
      bubble: {
        distance: 400,
        size: 40,
        duration: 2,
        opacity: 8,
        speed: 3,
      },
      repulse: {
        distance: 150,
        duration: 0.4,
      },
      push: {
        particles_nb: 4,
      },
      remove: {
        particles_nb: 2,
      },
    },
  },
  retina_detect: true,
});
