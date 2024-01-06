import autoComplete from '@tarekraafat/autocomplete.js';
const inputSearch = document.querySelector('#autoComplete');
const btnSearch = document.querySelector('#searchBtn');

const search = new autoComplete({
  selector: '#autoComplete',
  placeHolder: 'Buscar un producto',
  data: {
    src: async (query) => {
      try {
        const source = await fetch(`/api/productos?busqueda=${query}`);
        const data = await source.json();
        return data;
      } catch (error) {
        console.error(error);
      }
    },
    keys: ['productModel', 'productName'],
  },
  debounce: 300,
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
    tag: 'li',
    class: 'autoComplete_result',
    element: (item, data) => {
      console.log(data);
      const itemHtml = `
        <div class="product-search-card">
            <div class="product-search-card__picture-container">
                <img class="product-search-card__picture-container--image" src="${
                  data.value.imageRoute
                }">
            </div>
            <div class="product-search-card__info">
                <p class="product-search-card__info--name">${
                  data.key === 'productName' ? data.match : data.value.productName
                }</p>
                <div class="product-search-card__details">
                    <p class="product-search-card__details--model">${
                      data.key === 'productModel' ? data.match : data.value.productModel
                    }</p>
                    <p class="product-search-card__details--category">${data.value.categoryName}</p>
                </div>
            </div>
        </div>      
      `;
      console.log(itemHtml.replace(data.key));
      item.innerHTML = itemHtml;
      item.addEventListener('click', () => {
        console.log('hizo click, redireccionando a: ', data.value.productUrl);
      });
    },
    highlight: 'product-search-card__details--mark',
    selected: 'autoComplete_selected',
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

inputSearch.addEventListener('keydown', (event) => {
  if (event.key === 'Enter') {
    event.preventDefault();
    searchAndReload();
  }
});

btnSearch.addEventListener('click', () => {
  searchAndReload();
});

function searchAndReload() {
  console.log('recargando para buscar', inputSearch.value);
}
