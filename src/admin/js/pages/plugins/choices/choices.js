import Choices from 'choices.js';

const categorySelect = document.querySelector('#category');
const categoryTagInput = document.querySelector('#categoryTags');
const productTagInput = document.querySelector('#productTags');

const categorySelectChoice = new Choices(categorySelect, {
  searchEnabled: true,
  noResultsText: 'No se han encontrado resultados',
  noChoicesText: 'No hay opciones disponibles',
  itemSelectText: 'Selecciona',
  allowHTML: true,
});

const categoryTagChoice = new Choices(categoryTagInput, {
  searchEnabled: false,
  placeholder: true,
  removeItemButton: true,
  noResultsText: 'No se han encontrado resultados',
  noChoicesText: 'No hay opciones disponibles',
  itemSelectText: 'Selecciona',
  allowHTML: true,
  callbackOnInit: async function () {
    const preSelectedCategoryTagsIds = this._presetChoices.filter((el) => el.value !== '');

    if (preSelectedCategoryTagsIds.length === 0) {
      this.disable();
    } else {
      const categoryTags = await getCategoryTags(categorySelect.value);
      if (categoryTags.length === 0) {
        this.disable();
      } else {
        // if there preselected tags, then we set object selected to true
        const categoryTagsToShow = categoryTags.map((el) => {
          if (preSelectedCategoryTagsIds.some((e) => e.value == el.value)) {
            return { ...el, selected: true };
          }
          return el;
        });
        this.setChoices(categoryTagsToShow, 'value', 'label', true);
      }
    }
  },
});

/*const productTagChoice = */ new Choices(productTagInput, {
  searchEnabled: false,
  placeholder: true,
  removeItemButton: true,
  allowHTML: true,
  noResultsText: 'No se han encontrado resultados',
  noChoicesText: 'No hay opciones disponibles',
  itemSelectText: 'Selecciona',
});

categorySelectChoice.passedElement.element.addEventListener('change', async function (e) {
  categoryTagChoice.clearChoices();
  categoryTagChoice.clearStore();

  if (e.target.value) {
    const categoryTags = await getCategoryTags(e.target.value);
    categoryTagChoice.setChoices(categoryTags);
    categoryTagChoice.enable();
  } else {
    categoryTagChoice.disable();
  }
});

async function getCategoryTags(categoryId) {
  const apiBaseUrl = '/api/categorytags?';
  let completeURl = apiBaseUrl;
  completeURl += `category=${categoryId}`;
  const source = await fetch(completeURl);
  const result = await source.json();
  const categoryTags = result.map((categoryTag) => ({
    label: categoryTag.categoryTagName,
    value: categoryTag.categoryTagId,
  }));
  return categoryTags;
}
