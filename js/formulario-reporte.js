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
    const idZona = Number(document.getElementById('ddlZonas').value);
    const idArea = Number(document.getElementById('ddlAreas').value);
    const cedula = document.getElementById("cedula").value;

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
     // Si el rango de fechas es correcto se hace la consulta y se llena la tabla
          document.getElementById('tablaReporte').hidden = false;
          var table = $('#tablaReporte').DataTable({
               destroy: true,
               dom: 'Bfrtip',
               buttons: [
                    {
                         extend: 'copyHtml5',
                         exportOptions: {
                              columns: ':visible'
                          }
                    },
                    {
                         extend: 'excelHtml5',
                         exportOptions: {
                              columns: ':visible'
                          }
                    },
                    {
                         extend: 'pdfHtml5',
                         orientation: 'landscape',
                         pageSize: 'A4',
                         exportOptions: {
                              columns: ':visible'
                          }
                    },
                    {
                         extend: 'print',
                         text: 'Imprimir',
                         customize: function(win)
                         {
                    
                                   var last = null;
                                   var current = null;
                                   var bod = [];
                    
                                   var css = '@page { size: landscape; }',
                                        head = win.document.head || win.document.getElementsByTagName('head')[0],
                                        style = win.document.createElement('style');
                    
                                   style.type = 'text/css';
                                   style.media = 'print';
                    
                                   if (style.styleSheet)
                                   {
                                   style.styleSheet.cssText = css;
                                   }
                                   else
                                   {
                                   style.appendChild(win.document.createTextNode(css));
                                   }
                    
                                   head.appendChild(style);
                         },
                         exportOptions: {
                              columns: ':visible'
                          }
                    },
                    {
                         extend: 'colvis',
                         collectionLayout: 'fixed two-column'
                    },
               ],
               columnDefs: [
                    {
                        targets: 12,
                        visible: false
                    },
                    {
                         targets: 13,
                         visible: false
                     }
               ],
               "ajax": {
                    type: "POST",
                    url: "inc/modelos/modelo-reporte.php", 
                    data: {
                         'fechaInicio' : fechaInicio,
                         'fechaFin' : fechaFin,
                         'idZona' : idZona,
                         'idArea' : idArea,
                         'cedula' : cedula
                    }
               }, 
               "autoWidth": true,
               "columns": [
                    { "data": "consecutivo" },
                    { "data": "ost" },
                    { "data": "siga" },
                    { "data": "numero_servicio" },
                    { "data": "cantidad_eventos" },
                    { "data": "peso_total" },
                    { "data": "actividad" },
                    { "data": "detalle" },
                    { "data": "fecha_hora_apertura" },
                    { "data": "fecha_hora_cierre" },
                    { "data": "tiempo_total" },
                    { "data": "usuario_asignado" },
                    { "data": "usuario_asignador" },
                    { "data": "usuario_cierra" }
               ],
               "order": [[0, "asc"]],
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
                    },
                    buttons: {
                         copyTitle: 'Copiado al portapapeles',
                         copySuccess: {
                             _: '%d lineas copiadas',
                             1: '1 linea copiada'
                         },
                         colvis: 'Columnas'
                    }
               }
          });

    }
}