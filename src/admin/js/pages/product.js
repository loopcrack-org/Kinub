document.addEventListener('DOMContentLoaded', function () {
  // eslint-disable-next-line no-undef
  $('#products-table').DataTable({
    language: {
      info: 'Mostrando _START_ a _END_ de _TOTAL_ productos',
      infoEmpty: 'Mostrando 0 a 0 de 0 productos',
      infoFiltered: '(filtrado de _MAX_ productos totales)',
      lengthMenu: 'Mostrar _MENU_ productos',
    },
    columnDefs: [{ orderable: false, responsivePriority: 1, targets: -1 }],
  });
});
