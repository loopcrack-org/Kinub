const hamburgerBtn = document.querySelector("#menu-mobile");
const header = document.querySelector("#header-nav");
const navigation = document.querySelector("#navigation");
const MOBILE_MEDIA_QUERY = "(min-width: 768px)";
const mediaQuery = window.matchMedia(MOBILE_MEDIA_QUERY);

// UI-Related Functions
function setUIBasedOnMediaQuery() {
  if (mediaQuery.matches) {
    hideNavBar();
  }
}

function toggleActiveMobileMenu() {
  header.classList.toggle("header--active");
  navigation.classList.toggle("navigation--active");
}

// Event-related functions
function watchMenuClicks() {
  hamburgerBtn.addEventListener("click", toggleActiveMobileMenu);
}

function watchLinkClicks() {
  const links = document.querySelectorAll(".navigation__link");
  links.forEach((link) => {
    link.addEventListener("click", () => {
      if (!mediaQuery.matches) {
        hideNavBar();
      }
    });
  });
}

export function initializeUI() {
  watchMenuClicks();
  watchLinkClicks();
  mediaQuery.addEventListener("change", setUIBasedOnMediaQuery);
}

function hideNavBar() {
  navigation.classList.remove("navigation--active");
  header.classList.remove("header--active");
}

initializeUI();
