import Choices from 'choices.js';

const categorySelectChoice = new Choices('#categories', {
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

categorySelectChoice.passedElement.element.addEventListener('change', async function (e) {
  tagChoice.clearChoices();
  tagChoice.clearStore();
  if (e.target.value) {
    const categoryTags = await getCategoryTagsByCategory(e.target.value);
    const choices = categoryTags.map((e) => {
      console.log(e);
    });
    tagChoice.setChoices(choices);
    tagChoice.enable();
  } else {
    tagChoice.disable();
  }
});

async function getCategoryTagsByCategory(categoryId) {
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
