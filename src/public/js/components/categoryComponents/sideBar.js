import { cleanParams, updateURL } from './queryParams';

const sidebar = document.querySelector('.sidebar__nav');
const sidebarOverlay = document.querySelector('.sidebar__background');
const sidebarClose = document.querySelector('#sidebar-close');
const sidebarOpen = document.querySelector('#sidebar-open');
const sidebarSections = document.querySelectorAll('.menu-section');
const clearFiltersBtn = document.querySelector('#clear-filters-btn');
const globalSelectedFiltersContainer = document.querySelector('.selected-filters__summary');
let countFiltersApplied = 0;
const tags = {};

function addTag(param, value) {
  tags[`${param}`] = [...(tags[`${param}`] ?? []), value];
}

function deleteTag(param, value) {
  tags[`${param}`] = (tags[`${param}`] ?? []).filter((element) => element !== value);
}

function getTagsByParam(param) {
  console.log(param);
  return (tags[`${param}`] ?? []).join(',');
}

function closeSidebarIfOutside(event) {
  if (!sidebar.contains(event.target) && sidebar.classList.contains('sidebar__nav--active')) {
    closeSidebar();
  }
}

function openSidebar() {
  sidebar.classList.add('sidebar__nav--active');
  sidebarOverlay.classList.add('sidebar__background--active');
  setTimeout(() => {
    document.addEventListener('click', closeSidebarIfOutside);
  }, 10);
}

function closeSidebar() {
  sidebar.classList.remove('sidebar__nav--active');
  sidebarOverlay.classList.remove('sidebar__background--active');
  document.removeEventListener('click', closeSidebarIfOutside);
}

function toggleSection(sectionDropdown, sectionIcon) {
  sectionDropdown.classList.toggle('menu-section__dropdown--active');
  sectionIcon.classList.toggle('menu-section__icon--active');
}

function createSelectedFiltersCard({ content, container, param, value, onremove }) {
  const card = document.createElement('li');
  card.classList.add('selected-filters__card');
  card.dataset.name = content;
  card.innerHTML = `
            <p class="selected-filters__label-card-btn">${content}</p>
            <div class="selected-filters__delete-card-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="selected-filters__delete-card-btn-icon bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </div>
          `;
  card.addEventListener('click', () => {
    onremove();
    card.remove();
    countFiltersApplied--;
    deleteTag(param, value);
    toggleClearFiltersBtn();
    updateURL(param, getTagsByParam(param));
  });
  container.appendChild(card);
  countFiltersApplied++;
  addTag(param, value);
  toggleClearFiltersBtn();
}

function deleteSelectedFilterCard({ content, container, param, value }) {
  container.querySelector(`.selected-filters__card[data-name="${content}"]`).remove();
  countFiltersApplied--;
  deleteTag(param, value);
  toggleClearFiltersBtn();
}

function toggleClearFiltersBtn() {
  if (countFiltersApplied === 0) {
    clearFiltersBtn.classList.add('selected-filters__clear-btn--disabled');
  } else {
    clearFiltersBtn.classList.remove('selected-filters__clear-btn--disabled');
  }
}

toggleClearFiltersBtn();

document.addEventListener('DOMContentLoaded', function () {
  sidebarOpen.addEventListener('click', openSidebar);
  sidebarClose.addEventListener('click', closeSidebar);

  sidebarSections.forEach((section) => {
    const sectionBtn = section.querySelector('.menu-section__button');
    const sectionDropdown = section.querySelector('.menu-section__dropdown');
    const sectionIcon = section.querySelector('.menu-section__icon');
    const list = section.querySelector('.menu-section__list');
    const moreButton = section.querySelector('.menu-section__more-btn');
    const lessButton = section.querySelector('.menu-section__less-btn');
    const selectedFiltersList = globalSelectedFiltersContainer.querySelector(
      `.selected-filters__container[data-title="${section.dataset.title}"] .selected-filters__list`
    );

    let itemsToShow = 3;
    let totalItems = list.children.length;
    let showAllItems = false;

    if (totalItems <= itemsToShow) {
      moreButton.style.display = 'none';
      lessButton.style.display = 'none';
    }

    function toggleItemsVisibility() {
      for (let i = 0; i < totalItems; i++) {
        if (showAllItems || i < itemsToShow) {
          list.children[i].style.display = 'block';
        } else {
          list.children[i].style.display = 'none';
        }
      }
    }

    toggleItemsVisibility();

    sectionBtn.addEventListener('click', () => {
      toggleSection(sectionDropdown, sectionIcon);
    });

    moreButton.addEventListener('click', function () {
      showAllItems = true;
      toggleItemsVisibility();
      moreButton.style.display = 'none';
      lessButton.style.display = 'inline-block';
    });

    lessButton.addEventListener('click', function () {
      showAllItems = false;
      toggleItemsVisibility();
      lessButton.style.display = 'none';
      moreButton.style.display = 'inline-block';
    });

    list.querySelectorAll('.menu-section__item').forEach((item) => {
      const checkbox = item.querySelector('.menu-section__checkbox');
      const itemName = item.querySelector('.menu-section__label').textContent;

      const cardOptions = {
        content: itemName,
        container: selectedFiltersList,
        param: section.dataset.param,
        value: checkbox.value,
        onremove: () => (checkbox.checked = false),
      };

      if (checkbox.checked) {
        createSelectedFiltersCard(cardOptions);
      }

      item.addEventListener('click', function () {
        checkbox.checked = !checkbox.checked;
        if (checkbox.checked) {
          createSelectedFiltersCard(cardOptions);
        } else {
          deleteSelectedFilterCard(cardOptions);
        }
        updateURL(section.dataset.param, getTagsByParam(section.dataset.param));
      });
    });
  });

  clearFiltersBtn.addEventListener('click', function () {
    sidebarSections.forEach((section) => {
      const list = section.querySelector('.menu-section__list');
      const selectedFiltersList = globalSelectedFiltersContainer.querySelector(
        `.selected-filters__container[data-title="${section.dataset.title}"] .selected-filters__list`
      );

      list.querySelectorAll('.menu-section__checkbox').forEach((checkbox) => {
        checkbox.checked = false;
        selectedFiltersList.innerHTML = '';
      });
    });

    countFiltersApplied = 0;
    toggleClearFiltersBtn();
    cleanParams(Array.from(sidebarSections).map((sidebar) => sidebar.dataset.param));
  });
});
