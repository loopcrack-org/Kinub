// Get the textarea element and other required elements
const textArea = document.getElementById('aboutUsText');
const characterCount = document.getElementById('characterCount');
const errorAboutUsText = document.querySelector('.invalid-feedback');

function updateVisibility(isError) {
  if (isError) {
    characterCount.classList.remove('d-block');
    characterCount.classList.add('d-none');
    errorAboutUsText.classList.add('d-block');
    errorAboutUsText.classList.remove('d-none');
  } else {
    characterCount.classList.remove('d-none');
    characterCount.classList.add('d-block');
    errorAboutUsText.classList.add('d-none');
    errorAboutUsText.classList.remove('d-block');
  }
}

function handleCharacterLimit() {
  const textLength = textArea.value.length;

  characterCount.textContent = `${textLength}/${450}`;

  if (errorAboutUsText) {
    let isError = textLength > 450;
    updateVisibility(isError);
  }
}

textArea.addEventListener('input', handleCharacterLimit);

handleCharacterLimit();
