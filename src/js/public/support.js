let currentFieldset = 1;
const supportForm = document.querySelector('#support-form');
const progressName = document.querySelectorAll('.support-progress__name');
const progressCheck = document.querySelectorAll('.support-progress__check');
const progressBullet = document.querySelectorAll('.support-progress__bullet');

const firstNextBtn = document.querySelector('#btn-next-1');

firstNextBtn.addEventListener('click', function() {
    supportForm.style.transform = 'translateX(-100%)';
    progressName[currentFieldset - 1].classList.add("support-progress__name--active");
    progressBullet[currentFieldset - 1].classList.add("support-progress__bullet--active");
    currentFieldset += 1;
});

// FIELDSET 2
const secondNextBtn = document.querySelector('#btn-next-2');
const firstPrevBtn = document.querySelector('#btn-prev-1');
const productModel = document.querySelector('#support-model');
const serialNumber = document.querySelector('#support-serial');

secondNextBtn.addEventListener('click', function() {
    const productModelError = productModel.closest('.support-form__field').querySelector('.support-form__error');
    const serialNumberError = serialNumber.closest('.support-form__field').querySelector('.support-form__error');
    productModelError.classList.remove('support-form__error--active');
    serialNumberError.classList.remove('support-form__error--active');
    productModelError.textContent = '';
    serialNumberError.textContent = '';

    if(!validateProductDetails()) {  
        if (productModel.value.trim() === '') {
            productModelError.classList.add('support-form__error--active');
            productModelError.textContent = 'Campo Obligatorio';
          }
          if (serialNumber.value.trim() === '') {
            serialNumberError.classList.add('support-form__error--active');
            serialNumberError.textContent = 'Campo Obligatorio';
          }
    } else {
        supportForm.style.transform = 'translateX(-200%)';
        progressName[currentFieldset - 1].classList.add('support-progress__name--active');
        progressBullet[currentFieldset - 1].classList.add('support-progress__bullet--active');
        currentFieldset += 1;
    }
});
firstPrevBtn.addEventListener('click', function() {
    supportForm.style.transform = 'translateX(0%)';
    progressName[currentFieldset - 2].classList.remove('support-progress__name--active');
    progressBullet[currentFieldset - 2].classList.remove('support-progress__bullet--active');
    currentFieldset -= 1;
});

// FIELDSET 3
const secondPrevBtn = document.querySelector('#btn-prev-2');
const selectCategories = document.querySelector('#support-problem-type');
const problemMessage = document.querySelector('#support-problem');

secondPrevBtn.addEventListener('click', function() {
    supportForm.style.transform = 'translateX(-100%)';
    progressName[currentFieldset - 2].classList.remove('support-progress__name--active');
    progressBullet[currentFieldset - 2].classList.remove('support-progress__bullet--active');
    currentFieldset -= 1;
});
supportForm.addEventListener('submit', function(e) {
    const selectCategoriesError = selectCategories.closest('.support-form__field').querySelector('.support-form__error');
    const problemMessageError = problemMessage.closest('.support-form__field').querySelector('.support-form__error');
    selectCategoriesError.classList.remove('support-form__error--active');
    problemMessageError.classList.remove('support-form__error--active');
    selectCategoriesError.textContent = '';
    problemMessageError.textContent = '';

    if(!validateProblemDetails()) {
        e.preventDefault();
        
        if (selectCategories.value.trim() === '') {
            selectCategoriesError.classList.add('support-form__error--active');
            selectCategoriesError.textContent = 'Campo Obligatorio';
        }
        if (problemMessage.value.trim() === '') {
            problemMessageError.classList.add('support-form__error--active');
            problemMessageError.textContent = 'Campo Obligatorio';
        }
    }
});

function validateProblemDetails() {
    return !(selectCategories.value.trim() === '' || problemMessage.value.trim() === '');
}
function validateProductDetails() {
    return !(productModel.value.trim() === '' || serialNumber.value.trim() === '');
}