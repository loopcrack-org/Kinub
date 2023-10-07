document.addEventListener('DOMContentLoaded', function () {
    $('#users-table').DataTable({
        "language": {
            "info": "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
            "infoEmpty": "Mostrando 0 a 0 de 0 usuarios",
            "infoFiltered": "(filtrado de _MAX_ usuarios totales)",
            "lengthMenu": "Mostrar _MENU_ usuarios",
        },
        columnDefs: [
            { orderable: false, responsivePriority: 1, targets: -1 }
        ]
    });
});