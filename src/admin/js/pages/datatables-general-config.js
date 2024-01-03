document.addEventListener('DOMContentLoaded', function () {
  // eslint-disable-next-line no-undef
  $.extend($.fn.dataTable.defaults, {
    language: {
      emptyTable: 'No hay datos disponibles en la tabla',
      info: 'Mostrando _START_ a _END_ de _TOTAL_ entradas',
      infoEmpty: 'Mostrando 0 a 0 de 0 entradas',
      infoFiltered: '(filtrado de _MAX_ entradas totales)',
      lengthMenu: 'Mostrar _MENU_ entradas',
      search: 'Buscar:',
      zeroRecords: 'No se encontraron registros coincidentes',
      paginate: {
        next: '&raquo',
        previous: '&laquo',
      },
    },
  });
});
