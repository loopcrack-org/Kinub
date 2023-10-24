function setIdInModal() {
  const deleteButtons = document.querySelectorAll('[data-id]');
  deleteButtons.forEach(function (deleteButton) {
    deleteButton.addEventListener('click', function () {
      const elementId = this.getAttribute('data-id');
      const deleteButtonModal = document.querySelector('input[name="elementId"]');
      deleteButtonModal.value = elementId;
    });
  });
}
setIdInModal();
