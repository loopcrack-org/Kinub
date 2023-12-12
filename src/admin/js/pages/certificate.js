document.addEventListener('DOMContentLoaded', function () {
  // eslint-disable-next-line no-undef
  $('#certificates-table').DataTable({
    language: {
      info: 'Mostrando _START_ a _END_ de _TOTAL_ certificados',
      infoEmpty: 'Mostrando 0 a 0 de 0 certificados',
      infoFiltered: '(filtrado de _MAX_ certificados totales)',
      lengthMenu: 'Mostrar _MENU_ certificados',
    },
    columnDefs: [{ orderable: false, responsivePriority: 1, targets: -1 }],
  });
});
