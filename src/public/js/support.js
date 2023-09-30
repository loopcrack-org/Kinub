import intlTelInput from 'intl-tel-input';
document.addEventListener('DOMContentLoaded', function () {
    const supportForm = document.querySelector('#support-form');
    const progressName = document.querySelectorAll('.support-progress__name');
    const progressBullet = document.querySelectorAll('.support-progress__bullet');
    const fieldsetsElements = document.querySelectorAll(".support-form__fieldset");
    const phoneInputField = document.querySelector("#support-phone"); 
    const phoneInput = intlTelInput(phoneInputField, {
        preferredCountries: ["mx"],
        utilsScript: require('intl-tel-input/build/js/utils.js'),
    });

    let currentStep = 1;

    const MESSAGES = {
        required: "campo obligatorio",
        email: "correo inválido",
        phone: "teléfono inválido",
    };

    const SELECTORS = {
        error: "is-invalid",
        messageError: "invalid-feedback",
    };

    function handleProgress(step) {
        progressName[step - 1].classList.add("support-progress__name--active");
        progressBullet[step - 1].classList.add("support-progress__bullet--active");
    }

    const commonCustomViewErrors = {
        add: function (field, message, cls) {
            updateErrorContainer(field, message, cls);
        },
        remove: function (field, cls) {
            updateErrorContainer(field, "", cls);
        },
    };

    const configSteps = {
        container: ".support-form__step",
        button: ".next-step",
        validationBy: "onclick",
        selectors: SELECTORS,
        messages: MESSAGES,
        customViewErrors: commonCustomViewErrors,
        onContainerSuccess: function (container) {
            currentStep++;
            supportForm.style.transform = `translateX(-${(currentStep - 1) * 100}%)`;
            displayCurrentFieldset(currentStep);
            handleProgress(currentStep - 1);
        },
    };

    const configForm = {
        container: "#support-form",
        button: "#btn-submit",
        validationBy: "onclick",
        messages: {
            required: MESSAGES.required,
        },
        customViewErrors: commonCustomViewErrors,
        onFormSubmit: function (container) {
            handleProgress(currentStep);  
            const phoneNumber = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
            phoneInputField.value = phoneNumber;
            document.querySelector("#support-form").submit();
        },
    };

    const validatorSteps = new VanillaValidator(configSteps);
    const validatorForm = new VanillaValidator(configForm);

    function setContainerVisibility(container, isVisible, cls, message) {
        if (isVisible) {
            container.classList.add("support-form__error--active", cls);
            container.innerHTML = message;
            console.log("hola");
        } else {
            container.classList.remove("support-form__error--active", cls);
            container.innerHTML = "";
        }
    }

    function updateErrorContainer(field, message, cls) {
        const containerErrorsID = field.getAttribute("data-errors-id");

        if (!containerErrorsID) return;

        const containerErrors = document.getElementById(containerErrorsID);

        if (!containerErrors) return;

        const shouldDisplayError = Boolean(message);

        setContainerVisibility(containerErrors, shouldDisplayError, cls, message);
    }

    const prevButtons = document.querySelectorAll('.prev-step');

    prevButtons.forEach((button) => {
        button.addEventListener('click', function () {
            if (currentStep > 1) {
                currentStep--;
                supportForm.style.transform = `translateX(-${(currentStep - 1) * 100}%)`;
                displayCurrentFieldset(currentStep);
                progressName[currentStep - 1].classList.remove('support-progress__name--active');
                progressBullet[currentStep - 1].classList.remove('support-progress__bullet--active');
            }
        });
    });

    displayAlert();

    function displayCurrentFieldset(step) {
        fieldsetsElements.forEach((fieldset) => {
            fieldset.classList.remove("support-form__fieldset--active");
        });
        fieldsetsElements[step - 1].classList.add("support-form__fieldset--active");
    }

    function displayAlert() {
        const alertResponse = document.querySelector("#alert-response");

        if (alertResponse) {
            const responseData = JSON.parse(
                alertResponse.getAttribute("data-response")
            );

            Swal.fire({
                icon: responseData.type,
                title: responseData.title,
                text: responseData.message,
                confirmButtonColor: "#0174F6",
            });
        }
    }
}); 