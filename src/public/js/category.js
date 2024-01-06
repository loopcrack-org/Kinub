import autoComplete from '@tarekraafat/autocomplete.js';
import './components/categoryComponents/displaySelect.js';

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
