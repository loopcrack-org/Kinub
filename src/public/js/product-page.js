import Plyr from "plyr";
const player = new Plyr("#product-video");
const navbar = document.querySelector(".product-navigation");
const stickyOffset = navbar.offsetTop - 40;

window.onscroll = function () {
  initProductNav();
};

function initProductNav() {
  if (window.scrollY >= stickyOffset) {
    navbar.classList.add("product-navigation--sticky");
  } else {
    navbar.classList.remove("product-navigation--sticky");
  }
}
