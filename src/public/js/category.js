import autoComplete from '@tarekraafat/autocomplete.js';
import { updateDisplay } from './components/categoryComponents/displaySelect';

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

document.addEventListener('DOMContentLoaded', function () {
  const sections = document.querySelectorAll('.menu-section');
  const globalSelectedFiltersContainer = document.querySelector('.selected-filters__summary');

  sections.forEach((section) => {
    const list = section.querySelector('.menu-section__list');
    const moreButton = section.querySelector('.menu-section__more-btn');
    const lessButton = section.querySelector('.menu-section__less-btn');
    const clearFiltersBtn = document.querySelector('#clear-filters-btn');

    clearFiltersBtn.addEventListener('click', function () {
      list.querySelectorAll('.menu-section__checkbox').forEach((checkbox) => {
        checkbox.checked = false;
        selectedFiltersList.innerHTML = '';
      });
    });

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

    const selectedFiltersList = document.createElement('ul');
    const selectedFiltersLabel = document.createElement('label');
    selectedFiltersLabel.classList.add('selected-filters__name-container');
    selectedFiltersLabel.textContent = section.dataset.title;
    selectedFiltersList.classList.add('selected-filters__container');

    list.addEventListener('change', function (event) {
      const checkbox = event.target;
      const atLeastOneCheckboxChecked = Array.from(list.children).some((item) => {
        const checkbox = item.querySelector('.menu-section__checkbox');
        return checkbox && checkbox.checked;
      });

      if (atLeastOneCheckboxChecked) {
        clearFiltersBtn.style.display = 'block';
        globalSelectedFiltersContainer.appendChild(selectedFiltersLabel);
        globalSelectedFiltersContainer.appendChild(selectedFiltersList);
      } else {
        clearFiltersBtn.style.display = 'none';
        globalSelectedFiltersContainer.removeChild(selectedFiltersLabel);
        globalSelectedFiltersContainer.removeChild(selectedFiltersList);
      }

      if (checkbox.type === 'checkbox') {
        const categoryName = checkbox.nextElementSibling.textContent;

        if (checkbox.checked) {
          const card = document.createElement('li');
          card.classList.add('selected-filters__card');
          card.textContent = categoryName;

          const deleteButton = document.createElement('button');
          deleteButton.classList.add('selected-filters__delete-card-btn');
          deleteButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#e5e5e5" class="bi bi-x" viewBox="0 0 16 16">
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
            </svg>
          `;
          deleteButton.addEventListener('click', function () {
            card.remove();
            checkbox.checked = false;
          });

          card.appendChild(deleteButton);

          selectedFiltersList.appendChild(card);
        } else {
          const cardToRemove = Array.from(selectedFiltersList.children).find((card) =>
            card.textContent.includes(categoryName)
          );

          if (cardToRemove) {
            cardToRemove.remove();
          }
        }
      }
    });
  });
});

const displaySelectors = document.querySelectorAll('.search__display');
const [gridSelector, listSelector] = displaySelectors;

gridSelector.addEventListener('click', () => {
  if (!gridSelector.classList.contains('search__display--active')) {
    toggleActiveSelector();
    updateDisplay(0);
  }
});

listSelector.addEventListener('click', () => {
  if (!listSelector.classList.contains('search__display--active')) {
    toggleActiveSelector();
    updateDisplay(1);
  }
});

function toggleActiveSelector() {
  gridSelector.classList.toggle('search__display--active');
  listSelector.classList.toggle('search__display--active');
}

let filter = {
  productName: '',
};

console.log(filter);

const search = new autoComplete({
  selector: '#autoComplete',
  placeHolder: 'Buscar',
  data: {
    src: async (query) => {
      try {
        filter = { ...filter, productName: query };
        const source = await fetch(`/api/productos`, {
          method: 'GET',
        });
        console.log(filter);

        const data = await source.json();
        console.log(data);
        return data;
      } catch (error) {
        console.log(error);
      }
    },
    keys: ['productName'],
  },
  resultsList: {
    element: (list, data) => {
      if (!data.results.length) {
        const message = document.createElement('div');
        message.setAttribute('class', 'search__bar--no-result');
        message.innerHTML = `<span>No se han encontrado resultados para "${data.query}"</span>`;
        list.prepend(message);
      }
    },
    noResults: true,
  },
  resultItem: {
    highlight: true,
  },
  events: {
    input: {
      selection: ({ detail }) => {
        const selection = detail.selection.value.productName;
        search.input.value = selection;
      },
    },
  },
});
