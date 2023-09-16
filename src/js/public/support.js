document.addEventListener('DOMContentLoaded', function() {
    const supportForm = document.querySelector('#support-form');
    const progressName = document.querySelectorAll('.support-progress__name');
    const progressBullet = document.querySelectorAll('.support-progress__bullet');

    const fieldsets = [
        {
            fields: [
                { element: document.querySelector('#support-customer') },
                { element: document.querySelector('#support-phone') },
                { element: document.querySelector('#support-email') }
            ]
        },
        {
            fields: [
                { element: document.querySelector('#support-model') },
                { element: document.querySelector('#support-serial') }
            ]
        },
        {
            fields: [
                { element: document.querySelector('#support-problem-type') },
                { element: document.querySelector('#support-problem') }
            ]
        }
    ];

    let currentStep = 1;

    const configSteps = {
        container: '.support-form__step',
        button: '.next-step',
        validationBy: 'onclick',
        selectors: {
            error: 'is-invalid',
            messageError: 'invalid-feedback'
        },
        messages: {
            required: 'campo obligatorio',
            email: 'correo inválido',
            phone: 'teléfono inválido'
        },
        customViewErrors: {
            add: function(field, message, cls) {
                updateErrorContainer(field, message, cls);
            },
            remove: function(field, cls) {
                updateErrorContainer(field, '', cls);
            }
        },
        onContainerSuccess: function(container) {
            currentStep++;
            supportForm.style.transform = `translateX(-${(currentStep - 1) * 100}%)`;
            progressName[currentStep - 2].classList.add('support-progress__name--active');
            progressBullet[currentStep - 2].classList.add('support-progress__bullet--active');
        }
    };

    const validatorSteps = new VanillaValidator(configSteps);

    const configForm = {
        container: '#support-form',
        button: '#btn-submit',
        validationBy: 'onclick',
        messages: {
            required: 'campo obligatorio'
        },
        customViewErrors: {
            add: function(field, message, cls) {
                updateErrorContainer(field, message, cls);
            },
            remove: function(field, cls) {
                updateErrorContainer(field, '', cls);
            }
        },
        onFormSubmit: function(container) {
            progressName[currentStep - 1].classList.add('support-progress__name--active');
            progressBullet[currentStep - 1].classList.add('support-progress__bullet--active');
            document.querySelector('#support-form').submit();
        }
    };

    const validatorForm = new VanillaValidator(configForm);

    function updateErrorContainer(field, message, cls) {
        const containerErrorsID = field.getAttribute('data-errors-id');
    
        if (containerErrorsID) {
            const containerErrors = document.getElementById(containerErrorsID);
    
            if (containerErrors) {
                if (message) {
                    containerErrors.classList.add('support-form__error--active');
                    containerErrors.classList.add(cls);
                    containerErrors.innerHTML = message;
                } else {
                    containerErrors.classList.remove('support-form__error--active');
                    containerErrors.classList.remove(cls);
                    containerErrors.innerHTML = ''; 
                }
            }
        }
    }

    const prevButtons = document.querySelectorAll('.prev-step');
    prevButtons.forEach((button) => {
        button.addEventListener('click', function() {
            if (currentStep > 1) {
                currentStep--;
                supportForm.style.transform = `translateX(-${(currentStep - 1) * 100}%)`;
                progressName[currentStep - 1].classList.remove('support-progress__name--active');
                progressBullet[currentStep - 1].classList.remove('support-progress__bullet--active');
            }
        });
    });

    initializeFieldsets();

    function initializeFieldsets() {
        fieldsets.forEach((fieldset) => {
            fieldset.fields.forEach((field) => {
                field.element.addEventListener('keydown', (e) => handleFieldKeydown(e));
            });
        });
    }

    function handleFieldKeydown(e) {
        if (e.key === 'Tab') {
            e.preventDefault();
        }
    }

    displayAlert();

    function displayAlert() {
        const alertResponse = document.querySelector('#alert-response');

        if (alertResponse) {
            const title = alertResponse.getAttribute('data-title');
            const message = alertResponse.getAttribute('data-message');
            const icon = alertResponse.getAttribute('data-type');

            Swal.fire({
                icon: icon,
                title: title,
                text: message,
                confirmButtonColor: '#0174F6'
            });
        }
    }
});