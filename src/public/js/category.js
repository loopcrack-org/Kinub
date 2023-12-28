const sidebar = document.querySelector('.sidebar__nav');
const sidebarOverlay = document.querySelector('.sidebar__background');
const sidebarClose = document.querySelector('#sidebar-close');
const sidebarSections = document.querySelectorAll('.menu-section');

sidebarClose.addEventListener('click', closeSidebar);

sidebarSections.forEach((section) => {
  const sectionBtn = section.querySelector('.menu-section__button');
  const sectionDropdown = section.querySelector('.menu-section__dropdown');
  const sectionIcon = section.querySelector('.menu-section__icon');

  sectionBtn.addEventListener('click', () => {
    toggleSection(sectionDropdown, sectionIcon);
  });
});

document.addEventListener('click', closeSidebarIfOutside);

function closeSidebar() {
  sidebar.classList.remove('sidebar__nav--active');
  sidebarOverlay.classList.remove('sidebar__background--active');
}

function toggleSection(sectionDropdown, sectionIcon) {
  sectionDropdown.classList.toggle('menu-section__dropdown--active');
  sectionIcon.classList.toggle('menu-section__icon--active');
}

function closeSidebarIfOutside(event) {
  if (!sidebar.contains(event.target) && sidebar.classList.contains('sidebar__nav--active')) {
    closeSidebar();
  }
}
