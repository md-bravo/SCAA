eventListener();

function eventListener() {

    // Document Ready
    document.addEventListener('DOMContentLoaded', function(){

    });


}

// Tabla de registros
$(document).ready(function() {
     $('#tablaRegistros').DataTable({
          "ajax": "inc/modelos/modelo-lista-registros.php",
          "columns": [
               { "data": "id_reg_act"},
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
               { "data": "grupo"}
          ],
          "order": [[ 1, "desc" ]],
          "language":{
               "sProcessing": "Procesando...",
               "sLengthMenu":     "Mostrar _MENU_ registros",
               "sZeroRecords":    "No se encontraron resultados",
               "sEmptyTable":     "Ningún dato disponible en esta tabla",
               "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
               "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
               "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
               "sInfoPostFix":    "",
               "sSearch":         "Buscar:",
               "sUrl":            "",
               "sInfoThousands":  ",",
               "sLoadingRecords": "Cargando...",
               "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
               },
               "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
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
 
 } );
