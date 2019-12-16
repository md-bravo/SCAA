eventListener();

function eventListener() {

     // Document Ready
     document.addEventListener('DOMContentLoaded', function () {
          llenarTabla();
     });


}


// Tabla de registros, se carga tabla mediante AJAX
function llenarTabla() {
     const usuario = document.getElementById('idRegistrador').value;
     const rol = document.getElementById('rolRegistrador').value;

     var table = $('#tablaRegistros').DataTable({
          "ajax": {
               type: "POST",
               url: "inc/modelos/modelo-lista-registros.php", 
               data: {
                    'usuario' : usuario,
                    'rol' : rol
               }
          }, 
          "columns": [
               {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
               },
               { "data": "id_reg_act" },
               { "data": "consecutivo" },
               { "data": "ost" },
               { "data": "siga" },
               { "data": "numero_servicio" },
               { "data": "actividad" },
               { "data": "cantidad_eventos" },
               { "data": "peso_total" },
               { "data": "fecha_hora_apertura" },
               { "data": "nombre" },
               { "data": "detalle" },
               { "data": "grupo" }
          ],
          "columnDefs": [
               {
                    "targets": [1],
                    "visible": false,
                    "searchable": false
               },
               {
                    "targets": [3],
                    "visible": false,
               },
               {
                    "targets": [4],
                    "visible": false,
               },
               {
                    "targets": [5],
                    "visible": false,
               },
               {
                    "targets": [8],
                    "visible": false,
                    "searchable": false
               },
               {
                    "targets": [11],
                    "visible": false,
               },
               {
                    "targets": [12],
                    "visible": false,
                    "searchable": false
               }
          ],
          "order": [[1, "desc"]],
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

     // Se agrega el evento para mostrar u ocultar los detalles
     $('#tablaRegistros tbody').on('click', 'td.details-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row(tr);

          if (row.child.isShown()) {
               // Si la fila se está mostrando, se oculta
               row.child.hide();
               tr.removeClass('shown');
          }
          else {
               // Muestra ésta fila
               row.child(format(row.data())).show();
               tr.addClass('shown');
          }
     });
}
     
// Formato para la presentación de los detalles
function format(d) {
     // `d` es el objeto original para la fila
     return '<table class="table table-bordered">' +
          '<tr>' +
               '<th scope="row">OST</th>' +
               '<td>' + d.ost + '</td>' +
               '<th scope="row">SIGA</th>' +
               '<td>' + d.siga + '</td>' +
               '<th scope="row"># Servicio</th>' +
               '<td>' + d.numero_servicio + '</td>' +
               '<th scope="row">Peso Total</th>' +
               '<td>' + d.peso_total + '</td>' +
               '<th scope="row"># Grupo</th>' +
               '<td>' + d.grupo + '</td>' +
          '</tr>' +
          '<tr>' +
               '<th scope="row">Observaciones</th>' +
               '<td colspan="9">' + d.detalle + '</td>' +
          '</tr>' +
          '</table>';
}



