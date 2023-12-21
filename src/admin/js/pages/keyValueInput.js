const buttonAdd = document.querySelector('#keyValueButtonAdd');
const keyValueContainer = document.querySelector('.keyValue');
const keyValueRows = keyValueContainer.querySelectorAll('.keyValueRow');

function addRow() {
  // row container
  const keyValueRow = document.createElement('DIV');
  keyValueRow.classList.add('keyValueRow', 'row', 'gap-3', 'align-items-center', 'p-2');

  // create input check section
  const keyValueDeleteButtonContainer = document.createElement('DIV');
  keyValueDeleteButtonContainer.classList.add('col', 'col-sm-auto', 'p-0', 'mt-0');
  const keyValueDeleteButton = document.createElement('DIV');
  keyValueDeleteButton.classList.add(
    'btn',
    'btn-danger',
    'col',
    'col-sm-auto',
    'keyValueButtonDelete'
  );
  keyValueDeleteButton.type = 'checkbox';
  keyValueDeleteButton.id = 'flexCheckIndeterminate';
  keyValueDeleteButton.innerHTML = '<i class="ri-delete-bin-2-line"></i>';
  keyValueDeleteButtonContainer.appendChild(keyValueDeleteButton);

  // create input key section
  const keyValueKeyContainer = document.createElement('DIV');
  keyValueKeyContainer.classList.add('col-12', 'col-sm', 'input-group', 'p-0', 'my-auto');
  const keyValueKeyLabel = document.createElement('DIV');
  keyValueKeyLabel.classList.add('input-group-text');
  keyValueKeyLabel.textContent = 'Clave:';
  const keyValueKey = document.createElement('INPUT');
  keyValueKey.classList.add('keyValueKey', 'form-control');
  keyValueKey.type = 'text';
  keyValueKey.id = 'inlineFormInputGroupUsername';
  keyValueKey.placeholder = 'ej: Peso...';
  keyValueKey.required = true;
  keyValueKeyContainer.append(keyValueKeyLabel, keyValueKey);

  // create input value section
  const keyValueValueContainer = document.createElement('DIV');
  keyValueValueContainer.classList.add('col-12', 'col-sm', 'input-group', 'p-0', 'my-auto');
  const keyValueValueLabel = document.createElement('DIV');
  keyValueValueLabel.classList.add('input-group-text');
  keyValueValueLabel.textContent = 'Valor:';
  const keyValueValue = document.createElement('INPUT');
  keyValueValue.classList.add('keyValueValue', 'form-control');
  keyValueValue.type = 'text';
  keyValueValue.id = 'inlineFormInputGroupUsername';
  keyValueValue.placeholder = '5 kg';
  keyValueValue.required = true;
  keyValueValueContainer.append(keyValueValueLabel, keyValueValue);

  keyValueRow.append(keyValueDeleteButtonContainer, keyValueKeyContainer, keyValueValueContainer);
  setEventsFromElement(keyValueRow);

  // add all element to keyValueContainer
  keyValueContainer.append(keyValueRow);
}

function deleteRow(element) {
  console.log('hey');
  element.remove();
}

function setEventsFromElement(element) {
  const btnDelete = element.querySelector('.keyValueButtonDelete');
  const keyInput = element.querySelector('.keyValueKey');
  const valueInput = element.querySelector('.keyValueValue');

  valueInput.name = `technicalInfo[${keyInput.value}]`;
  keyInput.addEventListener('input', (e) => {
    valueInput.name = `technicalInfo[${e.target.value}]`;
  });
  btnDelete.addEventListener('click', () => {
    deleteRow(element);
  });
}

keyValueRows.forEach((row) => {
  setEventsFromElement(row);
});

buttonAdd.addEventListener('click', addRow);
