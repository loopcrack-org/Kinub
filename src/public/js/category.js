import autoComplete from '@tarekraafat/autocomplete.js';
import { updateDisplay } from './components/categoryComponents/displaySelect';

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
