function getURL() {
  return new URL(window.location.href);
}

export function updateURL() {
  let queryParams = new URLSearchParams();

  //Agregar validaciones para no agregar nada si no hay valores seleccionados
  //Categories
  queryParams.append('categories[]', '1');
  queryParams.append('categories[]', '2');
  queryParams.append('categories[]', '3');

  //Category tags
  queryParams.append('categoryTags[]', '1');
  queryParams.append('categoryTags[]', '3');
  queryParams.append('categoryTags[]', '5');

  //ProductTags
  queryParams.append('productTags[]', '1');
  queryParams.append('productTags[]', '3');
  queryParams.append('productTags[]', '4');
  queryParams.append('productTags[]', '5');

  //PerPage
  queryParams.append('perPage', '5');

  //Sorting
  queryParams.append('sort', 'productName');

  //Order / Direction
  queryParams.append('order', getOrder());

  //Search
  queryParams.append('search', 'Medidor');

  let currentUrl = getURL();
  currentUrl.search = queryParams.toString();

  const newURL = currentUrl.href;
  console.log(newURL);
  console.log(decodeURIComponent(newURL));
  window.location.href = newURL;
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

const order = document.querySelector('#sorting');
order.addEventListener('change', () => {
  updateURL();
});

console.log(getURL().searchParams.getAll('categories[]'));
console.log(getURL().searchParams.getAll('categoryTags[]'));
console.log(getURL().searchParams.getAll('productTags[]'));
console.log(getURL().searchParams.get('perPage'));
console.log(getURL().searchParams.get('order'));
console.log(getURL().searchParams.get('search'));
