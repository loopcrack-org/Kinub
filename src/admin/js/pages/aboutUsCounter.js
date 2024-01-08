const inputAboutUsTitle = document.getElementById('aboutUsTitle');
const textArea = document.getElementById('aboutUsText');
const aboutUsTitleCharacterCount = document.getElementById('aboutUsTitleCharacterCount');
const aboutUsTextCharacterCount = document.getElementById('aboutUsTextCharacterCount');

function handleCharacterLimitAboutUsTitle() {
  const textLengthAboutUsTitle = inputAboutUsTitle.value.length;
  aboutUsTitleCharacterCount.textContent = `${textLengthAboutUsTitle}/20`;
}

function handleCharacterLimitAboutUsText() {
  const textLengthAboutUsText = textArea.value.length;
  aboutUsTextCharacterCount.textContent = `${textLengthAboutUsText}/330`;
}

inputAboutUsTitle.addEventListener('input', handleCharacterLimitAboutUsTitle);
textArea.addEventListener('input', handleCharacterLimitAboutUsText);

handleCharacterLimitAboutUsTitle();
handleCharacterLimitAboutUsText();
