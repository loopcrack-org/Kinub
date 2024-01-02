import { createChoice } from './plugins/choices/choices-general-config';

const categorySelect = document.querySelector('#productCategoryId');
const categoryTagInput = document.querySelector('#categoryTags');
const productTagInput = document.querySelector('#productTags');
const tagSpinner = document.querySelector('#tagSpinner');

const categorySelectChoice = createChoice(categorySelect, true, {
  removeItemButton: false,
});

const categoryTagChoice = createChoice(categoryTagInput, false, {
  callbackOnInit: initCategoryTags,
});

createChoice(productTagInput, false, {
  placeholderValue: 'Ingresa los tags del producto',
});

categorySelectChoice.passedElement.element.addEventListener('change', async function (e) {
  categoryTagChoice.clearChoices();
  categoryTagChoice.clearStore();

  if (e.target.value) {
    categoryTagChoice.disable();
    const categoryTags = await getCategoryTags(e.target.value);
    categoryTagChoice.setChoices(categoryTags);
    categoryTagChoice.enable();
  } else {
    categoryTagChoice.disable();
  }
});

async function initCategoryTags() {
  const preSelectedCategoryTagsIds = this._presetChoices.filter((element) => element.value !== '');

  if (preSelectedCategoryTagsIds.length === 0) {
    this.disable();
  } else {
    const categoryTags = await getCategoryTags(categorySelect.value);
    if (categoryTags.length === 0) {
      this.disable();
    } else {
      const categoryTagsToShow = categoryTags.map((el) => {
        if (preSelectedCategoryTagsIds.some((e) => e.value == el.value)) {
          return { ...el, selected: true };
        }
        return el;
      });
      this.setChoices(categoryTagsToShow, 'value', 'label', true);
    }
  }
}

async function getCategoryTags(categoryId) {
  const apiBaseUrl = `/api/categorytags?category=${categoryId}`;
  tagSpinner.innerHTML =
    '<div class="clearfix"><div class="spinner-border spinner-border-sm float-end" role="status"></div></div>';
  const source = await fetch(apiBaseUrl);
  const result = await source.json();
  const categoryTags = result.map((categoryTag) => ({
    label: categoryTag.categoryTagName,
    value: categoryTag.categoryTagId,
  }));
  tagSpinner.innerHTML = '';
  return categoryTags;
}
