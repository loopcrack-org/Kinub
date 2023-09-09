const supportForm = document.querySelector('#support-form');
const progressName = document.querySelectorAll('.support-progress__name');
const progressBullet = document.querySelectorAll('.support-progress__bullet');

const fieldsets = [
    {
        nextButton: document.querySelector('#btn-next-1'),
        fields: [
            { element: document.querySelector('#support-customer'), errorElement: null },
            { element: document.querySelector('#support-phone'), errorElement: null },
            { element: document.querySelector('#support-email'), errorElement: null }
        ]
    },
    {
        nextButton: document.querySelector('#btn-next-2'),
        prevButton: document.querySelector('#btn-prev-1'),
        fields: [
            { element: document.querySelector('#support-model'), errorElement: null },
            { element: document.querySelector('#support-serial'), errorElement: null }
        ]
    },
    {
        prevButton: document.querySelector('#btn-prev-2'),
        submitButton: supportForm.querySelector('[type="submit"]'),
        fields: [
            { element: document.querySelector('#support-problem-type'), errorElement: null },
            { element: document.querySelector('#support-problem'), errorElement: null }
        ]
    }
];

initializeFieldsets();

function initializeFieldsets() {
    fieldsets.forEach((fieldset, index) => {
        if (fieldset.nextButton) {
            fieldset.nextButton.addEventListener('click', () => handleNextButtonClick(index));
        }
        if (fieldset.prevButton) {
            fieldset.prevButton.addEventListener('click', () => handlePrevButtonClick(index));
        }
        if (fieldset.submitButton) {
            supportForm.addEventListener('submit', (e) => handleFormSubmit(e, index));
        }

        fieldset.fields.forEach((field) => {
            field.errorElement = field.element.closest('.support-form__field').querySelector('.support-form__error');
            field.element.addEventListener('keydown', (e) => handleFieldKeydown(e));
        });
    });
}

function handleNextButtonClick(index) {
    const currentFieldset = fieldsets[index];
    const nextFieldset = fieldsets[index + 1];

    if (!validateFields(currentFieldset.fields)) {
        return;
    }

    if (nextFieldset) {
        supportForm.style.transform = `translateX(-${(index + 1) * 100}%)`;
        progressName[index].classList.add('support-progress__name--active');
        progressBullet[index].classList.add('support-progress__bullet--active');
    }
}

function handlePrevButtonClick(index) {
    const prevFieldset = fieldsets[index - 1];

    if (prevFieldset) {
        supportForm.style.transform = `translateX(-${(index - 1) * 100}%)`;
        progressName[index - 1].classList.remove('support-progress__name--active');
        progressBullet[index - 1].classList.remove('support-progress__bullet--active');
    }
}

function handleFormSubmit(e, index) {
    const currentFieldset = fieldsets[index];

    if (!validateFields(currentFieldset.fields)) {
        e.preventDefault();
    } else {
        progressName[index].classList.add('support-progress__name--active');
        progressBullet[index].classList.add('support-progress__bullet--active');
        index += 1;
    }
}

function handleFieldKeydown(e) {
    if (e.key === 'Tab') {
        e.preventDefault();
    }
}

function validateFields(fields) {
    let isValid = true;

    fields.forEach((field) => {
        const { element, errorElement } = field;
        const trimmedValue = element.value.trim();

        errorElement.classList.remove('support-form__error--active');
        errorElement.textContent = '';

        if (trimmedValue === '') {
            errorElement.classList.add('support-form__error--active');
            errorElement.textContent = 'Campo Obligatorio';
            isValid = false;
        }
    });

    return isValid;
}