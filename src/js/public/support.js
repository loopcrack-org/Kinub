//form elements
const supportForm = document.querySelector('#support-form');
const secondPrevBtn = document.querySelector('#btn-prev-2');
const progressName = document.querySelectorAll('.support-progress__name');
const progressCheck = document.querySelectorAll('.support-progress__check');
const progressBullet = document.querySelectorAll('.support-progress__bullet');
let max = 3;
let current = 1;
// fields
const selectCategories = document.querySelector('#support-categories');
const problemMessage = document.querySelector('#support-message');

secondPrevBtn.addEventListener('click', function() {
    supportForm.style.transform = 'translateX(-100%)';
    progressName[current - 2].classList.remove("soporte-progreso__nombre--active");
    progressBullet[current - 2].classList.remove("soporte-progreso__bullet--active");
    current -= 1;
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
