document.addEventListener('DOMContentLoaded', function () {
    $('#categories-table').DataTable({
        "language": {
            "info": "Mostrando _START_ a _END_ de _TOTAL_ categorías",
            "infoEmpty": "Mostrando 0 a 0 de 0 categorías",
            "infoFiltered": "(filtrado de _MAX_ categorías totales)",
            "lengthMenu": "Mostrar _MENU_ categorías",
        },
        columnDefs: [
            { orderable: false, responsivePriority: 1, targets: -1 }
        ]
    });
});