const textArea = document.getElementById('aboutUsText');
const characterCount = document.getElementById('characterCount');

function handleCharacterLimit() {
  const textLength = textArea.value.length;

  characterCount.textContent = `${textLength}/450`;
}

textArea.addEventListener('input', handleCharacterLimit);

handleCharacterLimit();
