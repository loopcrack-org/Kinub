import Choices from 'choices.js';

export function createChoice(input, searchEnabled = true, moreOptions = {}) {
  return new Choices(input, {
    searchEnabled: searchEnabled,
    placeholder: true,
    removeItemButton: true,
    noResultsText: 'No se han encontrado resultados',
    noChoicesText: 'No hay opciones disponibles',
    itemSelectText: 'Selecciona',
    allowHTML: true,
    ...moreOptions,
  });
}
