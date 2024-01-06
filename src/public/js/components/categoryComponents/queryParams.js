export function updateURL(param, value) {
  const url = new URLSearchParams(window.location.search);
  const query = url.get(param);
  console.log(query);
  url.set(param, value);
  reloadPage(decodeURIComponent(url.toString()));
}

export function cleanParam(param) {
  const url = new URLSearchParams(window.location.search);
  url.delete(param);
  return decodeURIComponent(url.toString());
}

export function reloadPage(queyrParams) {
  window.location.href = `/categoria?${queyrParams}`;
}
