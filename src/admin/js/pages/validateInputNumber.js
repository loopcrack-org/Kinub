const inputsNumber = document.querySelectorAll('input[type="number"]');

inputsNumber.forEach((inputNumber) => {
  inputNumber.addEventListener('keypress', (e) => {
    if (isNaN(e.key) || !isBetweenMinAndMaxValue(e.target, e.key)) {
      e.preventDefault();
    }
  });
});

function isBetweenMinAndMaxValue(input, lastCaracter) {
  const { min: minValue, max: maxValue } = input;
  const value = `${input.value}${lastCaracter}`;

  if (maxValue && parseInt(value) > parseInt(maxValue)) {
    createErrorMessage(input, `El valor máximo permitido es de ${maxValue}`);
    return false;
  }

  if (minValue && parseInt(value) < parseInt(minValue)) {
    createErrorMessage(input, `El valor mínimo permitido es de ${minValue}`);
    return false;
  }

  return true;
}

function createErrorMessage(input, message) {
  let errorMessage = document.querySelector(`${input.name}`);

  if (!errorMessage) {
    errorMessage = document.createElement('div');
    errorMessage.classList.add('invalid-feedback', 'd-block', input.name);
    errorMessage.textContent = message;
    input.classList.add('is-invalid');
    input.after(errorMessage);
  }

  setTimeout(() => {
    errorMessage?.remove();
    input.classList.remove('is-invalid');
  }, 1500);
}
