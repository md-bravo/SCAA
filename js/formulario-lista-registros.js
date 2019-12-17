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
     const tipo = "llenarTabla";

     var table = $('#tablaRegistros').DataTable({
          "ajax": {
               type: "POST",
               url: "inc/modelos/modelo-lista-registros.php", 
               data: {
                    'usuario' : usuario,
                    'rol' : rol,
                    'tipo': tipo
               }
          }, 
          "columns": [
               {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
               },
               {
                    "className": 'cerrarReg',
                    "targets": -1,
                    "orderable": false,
                    "data":null,
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
                    "targets": [2],
                    "visible": false,
                    "searchable": false
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
                    "targets": [6],
                    "visible": false,
               },
               {
                    "targets": [9],
                    "visible": false,
                    "searchable": false
               },
               {
                    "targets": [12],
                    "visible": false,
               },
               {
                    "targets": [13],
                    "visible": false,
                    "searchable": false
               }
          ],
          "order": [[2, "desc"]],
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

     // Si el rol del usuario es vista o tecnico, se ocultan las siguientes opciones
     if(rol === "Vista" || rol === "Tecnico"){
          // Oculta opcion de cerrar registros
          table.column( 1 ).visible( false );
     }

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

     // Se agrega el evento para cerrar un registro
     $('#tablaRegistros tbody').on( 'click', 'td.cerrarReg', function () {
          var data = table.row( $(this).parents('tr') ).data();
          modalCerrarRegistro(data);
      } );
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

// Esta función muestra el modal para cerrar un registro, se carga con los datos del registro seleccionado
function modalCerrarRegistro(data) {
     // Muestra el modal
     $('#modalCerrarReg').modal('show')
     // Llama las funciones fechaHora y mueveReloj de Scripts
     fechaHora();
     mueveReloj();

     document.getElementById('modalCerrarRegTitle').textContent = 'Cerrar Registro ' + data.consecutivo;
     document.getElementById('nombre').value = data.nombre;
     document.getElementById('actividad').value = data.actividad;
     document.getElementById('fecha-hora').value = data.fecha_hora_apertura;
     document.getElementById('cantidad').value = data.cantidad_eventos;
     document.getElementById('ost').value = data.ost;
     document.getElementById('siga').value = data.siga;
     document.getElementById('servicio').value = data.numero_servicio;
     document.getElementById('observaciones').innerText = data.detalle;
     
      // Al hacer click en guadar, se llama la función cerrarRegistro y se le pasan los datos del registro seleccionado
      document.getElementById('btnGuardarReg').addEventListener('click', function(){cerrarRegistro(data)});
}

// Esta función recopila los datos a enviar y realiza la solicitud al modelo por medio de Fetch
function cerrarRegistro(data) {
     console.log(data);

     const id_Reg = data.id_reg_act;
     const cantidad = document.getElementById('cantidad').value;
     const ost = document.getElementById('ost').value;
     const siga = document.getElementById('siga').value;
     const servicio = document.getElementById('servicio').value;
     const detalle = document.getElementById('observaciones').value;
     const idRegistrador = document.getElementById('idRegistrador').value;
     const pesoAct = data.peso_act;
     const tipo = document.getElementById('tipo').value;
     const fechaApertura = data.fecha_hora_apertura;
     const idGrupo = data.grupo;


     let pesoTotal = (cantidad * pesoAct).toFixed(2);

     console.log(id_Reg, cantidad, ost, siga, servicio, detalle, idRegistrador, pesoAct, tipo, pesoTotal, fechaApertura, idGrupo);

}
