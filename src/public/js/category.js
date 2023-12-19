const sidebar = document.querySelector('.sidebar');
const sidebarClose = document.querySelector('#sidebar-close');
const sidebarSections = document.querySelectorAll('.menu-section');
const sidebarOverlay = document.querySelector('.sidebar__overlay');

sidebarClose.addEventListener('click', () => {
  closeSidebar();
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

document.addEventListener('click', (event) => {
  if (!sidebar.contains(event.target) && sidebar.classList.contains('sidebar--active')) {
    closeSidebar();
  }
});

sidebarOverlay.addEventListener('click', () => {
  closeSidebar();
});

function closeSidebar() {
  sidebar.classList.remove('sidebar--active');
}
