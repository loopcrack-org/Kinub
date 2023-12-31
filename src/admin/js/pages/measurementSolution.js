document.addEventListener('DOMContentLoaded', function () {
    $('#measurementSolutions-table').DataTable({
        "language": {
            "info": "Mostrando _START_ a _END_ de _TOTAL_ soluciones",
            "infoEmpty": "Mostrando 0 a 0 de 0 soluciones",
            "infoFiltered": "(filtrado de _MAX_ soluciones totales)",
            "lengthMenu": "Mostrar _MENU_ soluciones",
        },
        columnDefs: [
            { orderable: false, responsivePriority: 1, targets: -1 }
        ]
    });
});