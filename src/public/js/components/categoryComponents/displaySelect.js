const products = document.querySelectorAll('.product');
const productsSection = document.querySelector('.category__grid');
const productListContent = document.querySelectorAll('.list-content');
const productContent = document.querySelectorAll('.product__content');

const GRID = 0;
const LIST = 1;

export function updateDisplay(display) {
  if (display === LIST) {
    productsSection.classList.add('category__grid--list');
    productListContent.forEach((listContent) => {
      listContent.classList.remove('list-content--disabled');
    });
    productContent.forEach((content) => {
      content.classList.add('product__content--list');
    });
    products.forEach((product) => {
      product.classList.add('product--list');
    });
  }

  if (display === GRID) {
    productsSection.classList.remove('category__grid--list');
    productListContent.forEach((listContent) => {
      listContent.classList.add('list-content--disabled');
    });
    productContent.forEach((content) => {
      content.classList.remove('product__content--list');
    });
    products.forEach((product) => {
      product.classList.remove('product--list');
    });
  }
}
