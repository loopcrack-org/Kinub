const QUERY_PARAMS = new URLSearchParams(window.location.search);

export const SEARCH_PARAMS_OPTIONS = {
  category: '0',
  categoryTag: '1',
  productTag: '2',
  perPage: '3',
  order: '4',
  search: '5',
};

export function getURL() {
  return new URL(window.location.href);
}

export function updateURL(param, value) {
  switch (param) {
    case SEARCH_PARAMS_OPTIONS.category:
      QUERY_PARAMS.set('categorias', value);
      break;
    case SEARCH_PARAMS_OPTIONS.categoryTag:
      QUERY_PARAMS.set('categoria-tags', value);
      break;
    case SEARCH_PARAMS_OPTIONS.productTag:
      QUERY_PARAMS.set('producto-tags', value);
      break;
    case SEARCH_PARAMS_OPTIONS.perPage:
      QUERY_PARAMS.set('por-pagina', value);
      break;
    case SEARCH_PARAMS_OPTIONS.order:
      QUERY_PARAMS.set('orden', value);
      break;
    case SEARCH_PARAMS_OPTIONS.search:
      QUERY_PARAMS.set('busqueda', value);
      break;

    default:
      break;
  }

  let searchParam = QUERY_PARAMS.get('busqueda');
  if (searchParam && value != SEARCH_PARAMS_OPTIONS.search) {
    let appendedSearch = searchParam;
    QUERY_PARAMS.delete('busqueda');
    QUERY_PARAMS.set('busqueda', appendedSearch);
  }

  let currentUrl = getURL();
  currentUrl.search = QUERY_PARAMS.toString();

  let newURL = currentUrl.href;
  window.location.href = newURL;
}

export function cleanURL() {
  let currentURL = getURL();
  currentURL.search = '';
  window.location.href = currentURL.href;
}

function getOrder() {
  const orderSelector = document.querySelector('#sorting');
  const order = orderSelector.value;
  const ASCENDING = 'asc';
  const DESCENDING = 'desc';

  switch (order) {
    case '1':
      return ASCENDING;
    case '2':
      return DESCENDING;
    default:
      return ASCENDING;
  }
}

export function addCategory(value) {
  let categoriesString = QUERY_PARAMS.get('categorias') ?? '';
  let categories = categoriesString === '' ? [] : categoriesString.split(',');
  if (!categories.includes(value)) {
    categories.push(value);
  }
  categories = categories.filter(Boolean).join(',');
  updateURL(SEARCH_PARAMS_OPTIONS.category, categories);
}

export function deleteCategory(value) {
  let categoriesString = QUERY_PARAMS.get('categorias') ?? '';
  let categories = categoriesString === '' ? [] : categoriesString.split(',');

  if (categories.includes(value)) {
    categories = categories.filter(function (index) {
      return index !== value;
    });
    categories = categories.filter(Boolean).join(',');
    updateURL(SEARCH_PARAMS_OPTIONS.category, categories);
  }
}

export function addCategoryTag(value) {
  let categoryTagsString = QUERY_PARAMS.get('categoria-tags') ?? '';
  let categoryTags = categoryTagsString.split(',') ?? [];
  if (!categoryTags.includes(value)) {
    categoryTags.push(value);
  }
  categoryTags = categoryTags.filter(Boolean).join(',');
  updateURL(SEARCH_PARAMS_OPTIONS.categoryTag, categoryTags);
}

export function addProductTag(value) {
  let productTagsString = QUERY_PARAMS.get('categoria-tags') ?? '';
  let productTags = productTagsString.split(',') ?? [];
  if (!productTags.includes(value)) {
    productTags.push(value);
  }
  productTags = productTags.filter(Boolean).join(',');
  updateURL(SEARCH_PARAMS_OPTIONS.productTag, productTags);
}

const order = document.querySelector('#sorting');
order.addEventListener('change', () => {
  updateURL(SEARCH_PARAMS_OPTIONS.order, getOrder());

  //cleanURL();
  addCategory('6');
  addCategory('4');
  addCategory('1');
  updateURL(SEARCH_PARAMS_OPTIONS.search, 'Medidor');
  addCategoryTag('9');
  addCategoryTag('15');
  addCategoryTag('1');
  updateURL(SEARCH_PARAMS_OPTIONS.search, 'Nuevo');

  // addCategoryTag(2);
  // addProductTag(4);
});
