import { Tooltip } from 'bootstrap';

const buttonAdd = document.querySelector('#keyValueButtonAdd');
const keyValueContainer = document.querySelector('.keyValue');
const keyValueRows = keyValueContainer.querySelectorAll('.keyValueRow');
const minRows = 1;

function readInitialRows() {
  if (keyValueContainer.childElementCount === minRows) {
    toggleDeleteBtns(true);
  }
}

function createRow() {
  const keyValueRow = document.createElement('DIV');
  keyValueRow.classList.add('keyValueRow', 'row', 'gap-3', 'align-items-center', 'px-0', 'py-1');
  keyValueRow.append(createDeleteBtn(), createKeyInput(), createValueInput());
  setEventsFromElement(keyValueRow);

  return keyValueRow;
}

function renderRow() {
  keyValueContainer.append(createRow());
  toggleDeleteBtns(false);
}

function deleteRow(element) {
  element.remove();
  if (keyValueContainer.children.length === minRows) {
    toggleDeleteBtns(true);
  }
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

function toggleDeleteBtns(disable = true) {
  Array.from(keyValueContainer.children)
    .slice(0, minRows)
    .forEach((row) => {
      const deleteBtn = row.querySelector('.btn');
      const deleteBtnContainer = deleteBtn.parentElement;
      const tooltip = new Tooltip(row, {
        title: `Completa este campo`,
      });
      if (disable) {
        deleteBtn.disabled = true;
        deleteBtn.classList.remove('btn-danger');
        deleteBtn.classList.add('btn-secondary');
        deleteBtnContainer.style.cursor = 'not-allowed';
        tooltip.enable();
      } else {
        deleteBtn.disabled = false;
        deleteBtn.classList.remove('btn-secondary');
        deleteBtn.classList.add('btn-danger');
        deleteBtnContainer.style.cursor = 'pointer';
        tooltip.disable();
      }
    });
}

function createDeleteBtn() {
  const keyValueDeleteButtonContainer = document.createElement('DIV');
  keyValueDeleteButtonContainer.classList.add('col-auto', 'p-0', 'mt-0');
  const keyValueDeleteButton = document.createElement('BUTTON');
  keyValueDeleteButton.classList.add(
    'btn',
    'btn-danger',
    'col',
    'col-sm-auto',
    'keyValueButtonDelete'
  );
  keyValueDeleteButton.type = 'button';
  keyValueDeleteButton.innerHTML = '<i class="ri-delete-bin-2-line"></i>';
  keyValueDeleteButtonContainer.appendChild(keyValueDeleteButton);
  return keyValueDeleteButtonContainer;
}
function createKeyInput() {
  const keyValueKeyContainer = document.createElement('DIV');
  keyValueKeyContainer.classList.add('col-12', 'col-sm', 'input-group', 'p-0', 'my-auto');
  const keyValueKeyLabel = document.createElement('DIV');
  keyValueKeyLabel.classList.add('input-group-text');
  keyValueKeyLabel.textContent = 'Clave:';
  const keyValueKey = document.createElement('INPUT');
  keyValueKey.classList.add('keyValueKey', 'form-control');
  keyValueKey.type = 'text';
  keyValueKey.placeholder = 'ej: Peso...';
  keyValueKey.required = true;
  keyValueKeyContainer.append(keyValueKeyLabel, keyValueKey);
  return keyValueKeyContainer;
}
function createValueInput() {
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
  return keyValueValueContainer;
}

document.addEventListener('DOMContentLoaded', () => {
  readInitialRows();
  keyValueRows.forEach((row) => {
    setEventsFromElement(row);
  });
  buttonAdd.addEventListener('click', renderRow);
});
