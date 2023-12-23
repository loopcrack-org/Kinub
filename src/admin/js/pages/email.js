document.addEventListener('DOMContentLoaded', function () {
  // eslint-disable-next-line no-undef
  $('#emails-table').DataTable({
    language: {
      info: 'Mostrando _START_ a _END_ de _TOTAL_ emails',
      infoEmpty: 'Mostrando 0 a 0 de 0 emails',
      infoFiltered: '(filtrado de _MAX_ emails totales)',
      lengthMenu: 'Mostrar _MENU_ emails',
    },
    columnDefs: [{ orderable: false, responsivePriority: 1, targets: -1 }],
  });
});
