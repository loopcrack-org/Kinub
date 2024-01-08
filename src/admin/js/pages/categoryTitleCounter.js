const inputCategoryName = document.getElementById('categoryName');
const inputCategorySubname = document.getElementById('categorySubname');
const categoryNameCharacterCount = document.getElementById('categoryNameCharacterCount');
const categorySubnameCharacterCount = document.getElementById('categorySubnameCharacterCount');

function handleCharacterLimitCategoryName() {
  const textLengthCategoryName = inputCategoryName.value.length;
  categoryNameCharacterCount.textContent = `${textLengthCategoryName}/20`;
}

function handleCharacterLimitCategorySubname() {
  const textLengthCategorySubname = inputCategorySubname.value.length;
  categorySubnameCharacterCount.textContent = `${textLengthCategorySubname}/20`;
}

inputCategoryName.addEventListener('input', handleCharacterLimitCategoryName);
inputCategorySubname.addEventListener('input', handleCharacterLimitCategorySubname);

handleCharacterLimitCategorySubname();
handleCharacterLimitCategoryName();
