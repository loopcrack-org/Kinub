const products = document.querySelectorAll('.product');
const productsSection = document.querySelector('.category__grid');
const productListContent = document.querySelectorAll('.list-content');
const productContent = document.querySelectorAll('.product__content');
const productImageContainer = document.querySelectorAll('.product__image-container');

const GRID = 0;
const LIST = 1;

function updateDisplay(display) {
  if (display === GRID) {
    localStorage.setItem('display', GRID);
    productsSection.classList.remove('category__grid--list');
    productListContent.forEach((listContent) => {
      listContent.classList.add('list-content--disabled');
    });
    productImageContainer.forEach((imageContainer) => {
      imageContainer.classList.remove('product__image-container--list');
    });
    productContent.forEach((content) => {
      content.classList.remove('product__content--list');
    });
    products.forEach((product) => {
      product.classList.remove('product--list');
    });
  }

  if (display === LIST) {
    localStorage.setItem('display', LIST);
    productsSection.classList.add('category__grid--list');
    productListContent.forEach((listContent) => {
      listContent.classList.remove('list-content--disabled');
    });
    productImageContainer.forEach((imageContainer) => {
      imageContainer.classList.add('product__image-container--list');
    });
    productContent.forEach((content) => {
      content.classList.add('product__content--list');
    });
    products.forEach((product) => {
      product.classList.add('product--list');
    });
  }
}

const displaySelectors = document.querySelectorAll('.search__display');
const [gridSelector, listSelector] = displaySelectors;

function updateCurrentDisplay() {
  const display = localStorage.getItem('display') ?? GRID;

  if (display == GRID) {
    updateDisplay(GRID);
    if (!gridSelector.classList.contains('search__display--active')) {
      toggleActiveSelector();
    }
  }

  if (display == LIST) {
    updateDisplay(LIST);
    if (!listSelector.classList.contains('search__display--active')) {
      toggleActiveSelector();
    }
  }
}

window.onload = updateCurrentDisplay();

gridSelector.addEventListener('click', () => {
  if (!gridSelector.classList.contains('search__display--active')) {
    toggleActiveSelector();
    updateDisplay(GRID);
  }
});

listSelector.addEventListener('click', () => {
  if (!listSelector.classList.contains('search__display--active')) {
    toggleActiveSelector();
    updateDisplay(LIST);
  }
});

function toggleActiveSelector() {
  gridSelector.classList.toggle('search__display--active');
  listSelector.classList.toggle('search__display--active');
}
