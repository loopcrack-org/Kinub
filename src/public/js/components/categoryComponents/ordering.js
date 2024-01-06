// import { SEARCH_PARAMS_OPTIONS, updateURL } from './categoryQueries';

import { updateURL } from './queryParams';

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
  updateURL('orden', getOrder());
});
