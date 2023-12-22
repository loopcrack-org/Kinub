const sidebar = document.querySelector('.sidebar');
const sidebarClose = document.querySelector('#sidebar-close');
const sidebarOpenButton = document.querySelector('#sidebar-open');
const sidebarSections = document.querySelectorAll('.menu-section');
/* const sidebarOverlay = document.querySelector('.sidebar__overlay');
 */

sidebarClose.addEventListener('click', () => {
  closeSidebar();
});

sidebarOpenButton.addEventListener('click', () => {
  openSidebar();
});

sidebarSections.forEach((section) => {
  const sectionBtn = section.querySelector('.menu-section__button');
  const sectionDropdown = section.querySelector('.menu-section__dropdown');
  const sectionIcon = section.querySelector('.menu-section__icon');

  sectionBtn.addEventListener('click', () => {
    sectionDropdown.classList.toggle('menu-section__dropdown--active');
    sectionIcon.classList.toggle('menu-section__icon--active');
  });
});

function closeSidebar() {
  sidebar.classList.remove('sidebar--active');
}

function openSidebar() {
  sidebar.classList.add('sidebar--active');
}
