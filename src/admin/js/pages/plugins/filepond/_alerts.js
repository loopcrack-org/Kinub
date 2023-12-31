import Swal from 'sweetalert2';

export async function createAlertToDeleteServerFile(item) {
  const response = await Swal.fire({
    icon: 'warning',
    title: `¿Desea eliminar el archivo ${item.filename}?`,
    text: 'Esta acción no podrá deshacerse una vez que se hayan guardado los cambios',
    confirmButtonText: 'Eliminar',
    cancelButtonText: 'Cancelar',
    showCancelButton: true,
  });

  return response.isConfirmed;
}

export function removeAlert(inputId, origin) {
  document.querySelector(`#alert-${inputId}-${origin}`)?.remove();
}

export function createAlert(
  inputId,
  message,
  type,
  hasCloseBtn,
  allowMultiple = false,
  origin = 'error'
) {
  const auxAlert = document.querySelector(`#alert-${inputId}-${origin}`);
  if (allowMultiple || !auxAlert) {
    const alert = document.createElement('DIV');
    alert.id = `alert-${inputId}-${origin}`;
    alert.classList.add(`alert-${type}`, 'alert', 'alert-dismissible', 'fade', 'show');
    alert.role = 'alert';
    alert.textContent = message;
    hasCloseBtn ? alert.appendChild(createCloseBtn()) : '';
    document.querySelector(`#${inputId}`).before(alert);
  }
}

function createCloseBtn() {
  const closeBtn = document.createElement('BUTTON');
  closeBtn.type = 'button';
  closeBtn.classList.add('btn-close');
  closeBtn.setAttribute('data-bs-dismiss', 'alert');
  closeBtn.setAttribute('aria-label', 'Close');

  return closeBtn;
}
