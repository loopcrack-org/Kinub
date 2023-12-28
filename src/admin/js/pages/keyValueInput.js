import tippy from 'tippy.js';

const buttonAdd = document.querySelector('#keyValueButtonAdd');
const keyValueContainer = document.querySelector('.keyValue');
const keyValueRows = keyValueContainer.querySelectorAll('.keyValueRow');
const minRows = parseInt(keyValueContainer.getAttribute('data-min') ?? 1);
const inputName = keyValueContainer.getAttribute('data-name') ?? 'keyValue';
const tippyOptions = {
  content: 'Completa este campo',
  duration: [300, 0],
  theme: 'alert',
  animation: 'shift-away',
  arrow: true,
};
const tooltips = {};

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

  valueInput.name = `${inputName}[${keyInput.value}]`;
  keyInput.addEventListener('input', (e) => {
    valueInput.name = `${inputName}[${e.target.value}]`;
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
      if (disable) {
        deleteBtn.disabled = true;
        deleteBtn.classList.remove('btn-danger');
        deleteBtn.classList.add('btn-secondary');
        deleteBtnContainer.style.cursor = 'not-allowed';
        const tooltip = tippy(row, tippyOptions);
        tooltips[`tooltip-${tooltip.id}`] = tooltip;
        row.setAttribute('tooltip-id', tooltip.id);
      } else {
        deleteBtn.disabled = false;
        deleteBtn.classList.remove('btn-secondary');
        deleteBtn.classList.add('btn-danger');
        deleteBtnContainer.style.cursor = 'pointer';
        const tippyId = row.getAttribute('tooltip-id');
        const tippyKey = `tooltip-${tippyId}`;
        if (tooltips[tippyKey]) {
          tooltips[tippyKey].destroy();
          delete tooltips[tippyKey];
        }
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
