export function updateURL(param, value, deleteSearch) {
  const url = new URLSearchParams(window.location.search);
  url.set(param, value);

  // set search to end
  let search = '';
  if (url.has('busqueda') && !deleteSearch) {
    search = `&busqueda=${encodeURIComponent(url.get('busqueda'))}`;
  }
  url.delete('busqueda');

  let query = decodeURIComponent(url.toString()) + search;
  reloadPage(query);
}

export function cleanParam(paramArray) {
  const url = new URLSearchParams(window.location.search);
  if (!(paramArray instanceof Array)) {
    paramArray = [paramArray];
  }
  paramArray.forEach((param) => {
    url.delete(param);
  });
  reloadPage(decodeURIComponent(url.toString()));
}

export function reloadPage(queryParams) {
  window.location.href = `/categoria?${queryParams}`;
}
