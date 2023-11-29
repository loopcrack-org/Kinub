import autoComplete from '@tarekraafat/autocomplete.js';
import Choices from 'choices.js';

let filter = {
  productName: '',
  categoryId: '',
  categoryTagsId: [],
};

const search = new autoComplete({
  selector: '#autoComplete',
  placeHolder: 'Escriba el nombre del producto',
  data: {
    src: async (query) => {
      try {
        filter = { ...filter, productName: query };
        const source = await fetch(`/filtro/productos`, {
          method: 'GET',
          body: JSON.stringify(filter),
          headers: {
            'Content-Type': 'application/json',
          },
        });
        console.log(filter);

        const data = await source.json();
        console.log(data);
        return data;
      } catch (error) {
        return error;
      }
    },
    keys: ['productName'],
  },
  resultsList: {
    element: (list, data) => {
      if (!data.results.length) {
        const message = document.createElement('div');
        message.setAttribute('class', 'no_result');
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

const categoryChoice = new Choices('#categories', {
  searchEnabled: true,
  itemSelectText: 'Selecciona',
});

const tagChoice = new Choices('#tags', {
  searchEnabled: false,
  placeholder: true,
  removeItemButton: true,
  noResultsText: 'No se han encontrado resultados',
  noChoicesText: 'No hay opciones disponibles',
  itemSelectText: 'Selecciona',
  callbackOnInit: function () {
    this.disable();
  },
});

categoryChoice.passedElement.element.addEventListener('change', async function (e) {
  tagChoice.clearChoices();
  tagChoice.clearStore();
  if (e.target.value) {
    filter = { ...filter, categoryId: e.target.value };
    const choices = await getTagsByCategory(e.target.value);
    tagChoice.setChoices(choices);
    tagChoice.enable();
  } else {
    filter = { ...filter, categoryId: e.target.value, categoryTagsId: [] };
    tagChoice.disable();
  }
});

tagChoice.passedElement.element.addEventListener('change', () => {
  filter = { ...filter, categoryTagsId: [...filter.categoryTagsId, tagChoice.getValue(true)] };
});

async function getTagsByCategory(categoryId) {
  const source = await fetch(`/filtro/productos/tags`, {
    method: 'GET',
    body: JSON.stringify({
      categoryId,
    }),
    headers: {
      'Content-Type': 'application/json',
    },
  });

  return await source.json();
}
