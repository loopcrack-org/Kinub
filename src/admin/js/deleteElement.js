(() => {
  const deleteButtons = document.querySelectorAll('[data-id]');
  deleteButtons.forEach((deleteButton) => {
    deleteButton.addEventListener('click', () => {
      const elementId = deleteButton.getAttribute('data-id');
      const modalInput = document.getElementById('elementId');
      modalInput.value = elementId;
    });
  });

  const modalForm = document.querySelector('.modal-delete-form');
  const modalDeleteButton = document.getElementById('delete-record');

  modalForm.addEventListener('submit', function () {
    modalDeleteButton.disabled = true;
  });
})();
