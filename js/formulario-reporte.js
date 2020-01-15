eventListener();

function eventListener() {

     // Document Ready
     document.addEventListener('DOMContentLoaded', function () {
    
     });

     document.querySelector('#formulario-reporte').addEventListener('submit', generarReporte);
}

function generarReporte(e) {
    e.preventDefault();

    const fechaInicio = document.getElementById('fechaInicio').value;
    const fechaFinIngresada = document.getElementById('fechaFin').value;

    // A la fecha fin, se le suma un día más para realizar el filtrado en la base de datos, en ese rango
    let nuevaFecha = new Date(fechaFinIngresada);
    nuevaFecha.setDate(nuevaFecha.getDate()+2);

    let dd = nuevaFecha.getDate();
    let mm = nuevaFecha.getMonth()+1; 
    let yyyy = nuevaFecha.getFullYear();
    if(dd<10) 
    {
        dd='0'+dd;
    } 
    if(mm<10) 
    {
        mm='0'+mm;
    } 
    const fechaFin = yyyy+'-'+mm+'-'+dd;


    if(fechaInicio === '' || fechaFinIngresada === '' ){
        mostrarMensaje('error', 'Debe indicar ambas fechas');
    } else {

        var table = $('#tablaReporte').DataTable({
            "ajax": {
                 type: "POST",
                 url: "inc/modelos/modelo-reporte.php", 
                 data: {
                      'fechaInicio' : fechaInicio,
                      'fechaFin' : fechaFin
                 }
            }, 
            "autoWidth": false,
            "columns": [
                 { "data": "id_reg_act" },
                 { "data": "consecutivo" },
                 { "data": "ost" },
                 { "data": "siga" },
                 { "data": "numero_servicio" },
                 { "data": "cantidad_eventos" },
                 { "data": "peso_total" },
                 { "data": "tiempo_total" },
                 { "data": "id_Act" },
                 { "data": "fecha_hora_apertura" },
                 { "data": "fecha_hora_cierre" },
                 { "data": "detalle" },
                 { "data": "usuario_asignado" },
                 { "data": "usuario_asignador" },
                 { "data": "usuario_cierra" }
            ],
            // "columnDefs": [
            //      {
            //           "targets": [4],
            //           "visible": false,
            //           "searchable": false
            //      },
            //      {
            //           "targets": [6],
            //           "visible": false,
            //      },
            //      {
            //           "targets": [7],
            //           "visible": false,
            //      },
            //      {
            //           "targets": [8],
            //           "visible": false,
            //      },
            //      {
            //           "targets": [11],
            //           "visible": false,
            //           "searchable": false
            //      },
            //      {
            //           "targets": [14],
            //           "visible": false,
            //      },
            //      {
            //           "targets": [15],
            //           "visible": false,
            //           "searchable": false
            //      }
            // ],
            "order": [[4, "desc"]],
            "language": {
                 "sProcessing": "Procesando...",
                 "sLengthMenu": "Mostrar _MENU_ registros",
                 "sZeroRecords": "No se encontraron resultados",
                 "sEmptyTable": "Ningún dato disponible en esta tabla",
                 "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                 "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                 "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                 "sInfoPostFix": "",
                 "sSearch": "Buscar:",
                 "sUrl": "",
                 "sInfoThousands": ",",
                 "sLoadingRecords": "Cargando...",
                 "oPaginate": {
                      "sFirst": "Primero",
                      "sLast": "Último",
                      "sNext": "Siguiente",
                      "sPrevious": "Anterior"
                 },
                 "oAria": {
                      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                 },
                 "buttons": {
                      "copy": "Copiar",
                      "colvis": "Visibilidad"
                 },
                 "select": {
                      "rows": {
                           _: "You have selected %d rows",
                           0: "",
                           1: "1 fila seleccionada"
                      }
                 }
            },
             "select": 'single'
       });

    }
}