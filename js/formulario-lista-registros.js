eventListener();

function eventListener() {

     // Document Ready
     document.addEventListener('DOMContentLoaded', function () {
          llenarTabla();
     });

     // Calcular peso actividades
     document.getElementById('ddlActividades').addEventListener('change', pesoActividades);
     
     // calcular total cuando se ingresa la cantidad
     document.getElementById('cantidad').addEventListener('keyup', calcularTotal);
     document.getElementById('cantidad').addEventListener('click', calcularTotal);
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
          "autoWidth": false,
          "columns": [
               {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
               },
               {
                    "className": 'cerrarReg',
                    "orderable": false,
                    "data":null,
                    "defaultContent": ''
               },
               {
                    "className": 'editarReg',
                    "orderable": false,
                    "data":null,
                    "defaultContent": ''
               },
               {
                    "className": 'borrarReg',
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
                    "targets": [4],
                    "visible": false,
                    "searchable": false
               },
               {
                    "targets": [6],
                    "visible": false,
               },
               {
                    "targets": [7],
                    "visible": false,
               },
               {
                    "targets": [8],
                    "visible": false,
               },
               {
                    "targets": [11],
                    "visible": false,
                    "searchable": false
               },
               {
                    "targets": [14],
                    "visible": false,
               },
               {
                    "targets": [15],
                    "visible": false,
                    "searchable": false
               }
          ],
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

     // Si el rol del usuario es vista o tecnico, se ocultan las siguientes opciones
     if(rol === "Vista" || rol === "Tecnico"){
          // Oculta opcion de cerrar registros
          table.column( 1 ).visible( false );
          table.column( 2 ).visible( false );
          table.column( 3 ).visible( false );
     } else if(rol === "Operador"){
          table.column( 3 ).visible( false );
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
          var todos = table.data();
          let tipo = "cerrar";
          modalAccionesRegistro(data, todos, tipo);
      } );

     // Se agrega el evento para editar un registro
     $('#tablaRegistros tbody').on( 'click', 'td.editarReg', function () {
          var data = table.row( $(this).parents('tr') ).data();
          var todos = table.data();
          let tipo = "editar";
          modalAccionesRegistro(data, todos, tipo);
      } );

     // Se agrega el evento para editar un registro
     $('#tablaRegistros tbody').on( 'click', 'td.borrarReg', function () {
          var data = table.row( $(this).parents('tr') ).data();
          var todos = table.data();
          let tipo = "borrar";
          modalAccionesRegistro(data, todos, tipo);
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
function modalAccionesRegistro(data, todos, tipo) {

     let consecutivosRelacionados = '';
     let id_Reg = [];
     id_Reg = [data.id_reg_act];

     // Verifca si el registro es grupal y busca los consecutivos asociados
     if(data.grupo === null){
          document.getElementById('divRelacionados').style.display = "none";
     } else {
          for (let x = 0; x < todos.length; x++) {
               if(todos[x].grupo === data.grupo){
                    if(todos[x].consecutivo != data.consecutivo){
                         id_Reg.push(todos[x].id_reg_act);
                         consecutivosRelacionados += todos[x].consecutivo + '  ';
                         document.getElementById('relacionados').value =  consecutivosRelacionados;
                         document.getElementById('divRelacionados').style.display = "flex";
                    }
               }
          }
     }

     // Muestra el modal
     $('#modalAccionesReg').modal('show')
     // Llama las funciones fechaHora y mueveReloj de Scripts
     valoresDefaultSelectpicker();
     fechaHora();
     mueveReloj();

     let nombre = document.getElementById('nombre');
     let ddlActividad = document.getElementById('ddlActividades');
     let fecha_hora = document.getElementById('fecha-hora');
     let cantidad = document.getElementById('cantidad');
     let ost = document.getElementById('ost');
     let siga = document.getElementById('siga');
     let servicio = document.getElementById('servicio');
     let observaciones = document.getElementById('observaciones');

     nombre.value = data.nombre;
     fecha_hora.value = data.fecha_hora_apertura;
     cantidad.value = data.cantidad_eventos;
     ost.value = data.ost;
     siga.value = data.siga;
     servicio.value = data.numero_servicio;
     observaciones.value = data.detalle;

     ddlActividad.disabled = false;
     cantidad.disabled = false;
     ost.disabled = false;
     siga.disabled = false;
     servicio.disabled = false;
     observaciones.disabled = false;
     document.getElementById('fecha').parentNode.parentNode.style.display = "flex";
     document.getElementById('opcionesBorrar').classList.add("d-none");

     // Se clona el elemento para evitar que se agreguen multiples veces el EventListener
     var el = document.getElementById('btnAccionReg'),
     elClone = el.cloneNode(true);
     el.parentNode.replaceChild(elClone, el);

     let botonModal = document.getElementById('btnAccionReg');
     let titulo = document.getElementById('modalAccionesRegTitle');
     let divModalHeader = document.getElementById('divModalHeader');
     let labelAsociados = document.getElementById('divRelacionados').childNodes[1];

     if(tipo === "cerrar"){
          titulo.textContent = 'Cerrar Registro ' + data.consecutivo;
          divModalHeader.style.backgroundColor = "#acfabb";
          ddlActividad.disabled = true;
          botonModal.innerText = "Cerrar Registro";
          labelAsociados.innerHTML = "Tambien Cerrará";
          // Al hacer click en Cerrar Registro, se llama la función cerrarRegistro y se le pasan los datos del registro seleccionado
          document.getElementById('btnAccionReg').addEventListener('click', function(){cerrarRegistro(data, id_Reg, tipo)});
     } else if(tipo === "editar") {
          titulo.textContent = 'Editar Registro ' + data.consecutivo;
          divModalHeader.style.backgroundColor = "#fffd6e";
          botonModal.innerText = "Guardar Cambios";
          labelAsociados.innerHTML = "Tambien Editará";
          document.getElementById('fecha').parentNode.parentNode.style.display = "none";
          // Al hacer click en Editar Registro, se llama la función editarRegistro y se le pasan los datos del registro seleccionado
          document.getElementById('btnAccionReg').addEventListener('click', function(){editarRegistro(data, id_Reg, tipo)});
     } else {
          titulo.textContent = 'Eliminar Registro ' + data.consecutivo;
          divModalHeader.style.backgroundColor = "#ff7373";
          botonModal.innerText = "Eliminar Registro";
          labelAsociados.innerHTML = "Asociados";
          ddlActividad.disabled = true;
          cantidad.disabled = true;
          ost.disabled = true;
          siga.disabled = true;
          servicio.disabled = true;
          observaciones.disabled = true;

          if(id_Reg.length > 1){
               document.getElementById('opcionesBorrar').classList.remove("d-none");
               document.getElementById('todos').checked = true;
          }
          
          // Al hacer click en Eliminar Registro, se llama la función eliminarRegistro y se le pasan los datos del registro seleccionado
          document.getElementById('btnAccionReg').addEventListener('click', function(){eliminarRegistro(data, id_Reg, tipo)});
     }

     // Establece como seleccionado la actividad según el registro que se eligió
     let listaActividades = document.getElementById('ddlActividades').children;
     for (let x = 0; x < listaActividades.length; x++) {
          if(listaActividades[x].value == data.id_Act){
               listaActividades[x].selected = true;
               $('#ddlActividades').selectpicker('refresh');
               pesoActividades();
          }
     }
     
}
 
// Esta función recopila los datos a enviar y realiza la solicitud al modelo por medio de Fetch
function cerrarRegistro(datos, id_Reg, tipo) {

     const cantidad = Number(document.getElementById('cantidad').value);
     const ost = document.getElementById('ost').value;
     const siga = document.getElementById('siga').value;
     const servicio = document.getElementById('servicio').value;
     const detalle = document.getElementById('observaciones').value;
     const idRegistrador = document.getElementById('idRegistrador').value;
     const fechaApertura = datos.fecha_hora_apertura;
     const idGrupo = datos.grupo;
     const pesoTotal = document.getElementById('total').innerHTML;

     if(cantidad === ''){
          mostrarMensaje('error', 'Debe indicar una cantidad');
          document.getElementById("cantidad").focus();
     } else if(cantidad === 0){
          mostrarMensaje('error', 'La cantidad no puede ser igual a 0');
          document.getElementById("cantidad").focus();
     }else {
          Swal.fire({
               title: '¿Está seguro?',
               text: 'Se cerrará el consecutivo ' + (id_Reg.length === 1 ? datos.consecutivo : datos.consecutivo + ' y sus asociados'),
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Si, cerrarlo'
             }).then((result) => {
               if (result.value) {
                    // Se definen los datos que se van a enviar al fetch
                    const data = new FormData();
                    data.append('id_Reg', id_Reg);
                    data.append('ost', ost);
                    data.append('siga', siga);
                    data.append('numServicio', servicio);
                    data.append('cantidad', cantidad);
                    data.append('pesoTotal', pesoTotal);
                    data.append('observaciones', detalle);
                    data.append('fecha_hora_apertura', fechaApertura);
                    data.append('idRegistrador', idRegistrador);
                    data.append('idGrupo', idGrupo);
                    data.append('tipo', tipo);

                    // Conexión del fetch al archivo php
                    fetch('inc/modelos/modelo-registro.php', {
                         method: 'POST',
                         body: data
                    })
                    .then(respuestaExitosa) // Respuesta exitosa llama la función
                    .catch(mostrarError); // Respuesta negativa llama la función

                    // Si la ejecución del AJAX es correcta se verifica la respuesta
                    function respuestaExitosa(response){
                         if(response.ok) {   // Si la respuesta en ok se llama la función para mostrar los resultados
                              response.json().then(mostrarResultado);
                         } else {    // Si la respuesta no es ok se muestra el error
                              mostrarError('status code: ' + response.status);
                         }
                    }

                    // Se muestran los resultados devueltos en el JSON
                    function mostrarResultado(respuesta){

                         // Si la respuesta es correcta
                         if(respuesta.estado === 'correcto') {      
                              mostrarMensaje('success', 'Cierre de Registro Exitoso') ;   
                              
                              // Se oculta el modal de cierre de registro
                              $('#modalAccionesReg').modal('hide');
                              
                              // Se actualiza la tabla
                              var table = $('#tablaRegistros').DataTable();
                              table.ajax.reload();

                         }else  if(respuesta.estado === 'incorrecto') {
                              mostrarMensaje('error', 'No se realizó el cierre del registro'); 
                         } else {
                              // Hubo un error
                              if(respuesta.error) {
                                   mostrarMensaje('error', 'Algo falló al cerrar el registro de actividad');    
                              }
                              if (respuesta.conexion) {
                                   mostrarMensaje('error', 'Falla en la conexión a la base de datos');
                              }
                         }
                    }

                    // Muestra el error si el AJAX no se ejecuta o la respuesta no es ok
                    function mostrarError(err){
                         console.log('Error', err);
                    }
               }
             })
      
     }
}

// Editar el o los registros seleccionados
function editarRegistro(datos, id_Reg, tipo) {
     const cantidad = Number(document.getElementById('cantidad').value);
     const ost = document.getElementById('ost').value;
     const siga = document.getElementById('siga').value;
     const servicio = document.getElementById('servicio').value;
     const detalle = document.getElementById('observaciones').value;
     const idRegistrador = document.getElementById('idRegistrador').value;
     const pesoTotal = document.getElementById('total').innerHTML;
     const nuevoIdAct = document.getElementById('ddlActividades').value;

     if(cantidad === ''){
          mostrarMensaje('error', 'Debe indicar una cantidad');
          document.getElementById("cantidad").focus();
     } else if(cantidad === 0){
          mostrarMensaje('error', 'La cantidad no puede ser igual a 0');
          document.getElementById("cantidad").focus();
     }else {
          Swal.fire({
               title: '¿Está seguro?',
               text: 'Se editará el consecutivo ' + (id_Reg.length === 1 ? datos.consecutivo : datos.consecutivo + ' y sus asociados'),
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Si, editarlo'
             }).then((result) => {
               if (result.value) {
                    // Se definen los datos que se van a enviar al fetch
                    const data = new FormData();
                    data.append('id_Reg', id_Reg);
                    data.append('ost', ost);
                    data.append('siga', siga);
                    data.append('numServicio', servicio);
                    data.append('cantidad', cantidad);
                    data.append('pesoTotal', pesoTotal);
                    data.append('observaciones', detalle);
                    data.append('idRegistrador', idRegistrador);
                    data.append('nuevoIdAct', nuevoIdAct);
                    data.append('tipo', tipo);

                    // Conexión del fetch al archivo php
                    fetch('inc/modelos/modelo-registro.php', {
                         method: 'POST',
                         body: data
                    })
                    .then(respuestaExitosa) // Respuesta exitosa llama la función
                    .catch(mostrarError); // Respuesta negativa llama la función

                    // Si la ejecución del AJAX es correcta se verifica la respuesta
                    function respuestaExitosa(response){
                         if(response.ok) {   // Si la respuesta en ok se llama la función para mostrar los resultados
                              response.json().then(mostrarResultado);
                         } else {    // Si la respuesta no es ok se muestra el error
                              mostrarError('status code: ' + response.status);
                         }
                    }

                    // Se muestran los resultados devueltos en el JSON
                    function mostrarResultado(respuesta){
                    
                         // Si la respuesta es correcta
                         if(respuesta.estado === 'correcto') {      
                              mostrarMensaje('success', 'Modificación de Registro Exitoso') ;   
                              
                              // Se oculta el modal de cierre de registro
                              $('#modalAccionesReg').modal('hide');
                              
                              // Se actualiza la tabla
                              var table = $('#tablaRegistros').DataTable();
                              table.ajax.reload();

                         }else  if(respuesta.estado === 'incorrecto') {
                              mostrarMensaje('error', 'No se realizó la modificación del registro'); 
                         } else {
                              // Hubo un error
                              if(respuesta.error) {
                                   mostrarMensaje('error', 'Algo falló al modificar el registro de actividad');    
                              }
                              if (respuesta.conexion) {
                                   mostrarMensaje('error', 'Falla en la conexión a la base de datos');
                              }
                         }
                    }

                    // Muestra el error si el AJAX no se ejecuta o la respuesta no es ok
                    function mostrarError(err){
                         console.log('Error', err);
                    }
               }
             })
      
     }
}

// Elimina el o los registros seleccionados
function eliminarRegistro(datos, id_Reg, tipo) {

     // Se verifica si se van a eliminar todos o solo uno
     const todos = document.getElementById('todos').checked;
     let regEliminar = [];

     if(todos === true){
          regEliminar = id_Reg;
     } else {
          regEliminar = [datos.id_reg_act];
     }

     const idRegistrador = document.getElementById('idRegistrador').value;
     const fechaApertura = datos.fecha_hora_apertura;
     const idGrupo = datos.grupo;

     Swal.fire({
          title: '¿Está seguro?',
          text: 'Se eliminará el consecutivo ' + (regEliminar.length === 1 ? datos.consecutivo : datos.consecutivo + ' y sus asociados'),
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminarlo'
          }).then((result) => {
          if (result.value) {
               // Se definen los datos que se van a enviar al fetch
               const data = new FormData();
               data.append('id_Reg', regEliminar);
               data.append('fecha_hora_apertura', fechaApertura);
               data.append('idRegistrador', idRegistrador);
               data.append('idGrupo', idGrupo);
               data.append('tipo', tipo);

               // Conexión del fetch al archivo php
               fetch('inc/modelos/modelo-registro.php', {
                    method: 'POST',
                    body: data
               })
               .then(respuestaExitosa) // Respuesta exitosa llama la función
               .catch(mostrarError); // Respuesta negativa llama la función

               // Si la ejecución del AJAX es correcta se verifica la respuesta
               function respuestaExitosa(response){
                    if(response.ok) {   // Si la respuesta en ok se llama la función para mostrar los resultados
                         response.json().then(mostrarResultado);
                    } else {    // Si la respuesta no es ok se muestra el error
                         mostrarError('status code: ' + response.status);
                    }
               }

               // Se muestran los resultados devueltos en el JSON
               function mostrarResultado(respuesta){
                    // Si la respuesta es correcta
                    if(respuesta.estado === 'correcto') {      
                         mostrarMensaje('success', 'Eliminación de Registro Exitoso') ;   
                         
                         // Se oculta el modal de cierre de registro
                         $('#modalAccionesReg').modal('hide');
                         
                         // Se actualiza la tabla
                         var table = $('#tablaRegistros').DataTable();
                         table.ajax.reload();

                    }else  if(respuesta.estado === 'incorrecto') {
                         mostrarMensaje('error', 'No se realizó la eliminación del registro'); 
                    } else {
                         // Hubo un error
                         if(respuesta.error) {
                              mostrarMensaje('error', 'Algo falló al eliminar el registro de actividad');    
                         }
                         if (respuesta.conexion) {
                              mostrarMensaje('error', 'Falla en la conexión a la base de datos');
                         }
                    }
               }

               // Muestra el error si el AJAX no se ejecuta o la respuesta no es ok
               function mostrarError(err){
                    console.log('Error', err);
               }
          }
     })
}

// Busca el peso de la actividad seleccionada y lo muestra
function  pesoActividades() {
     const listaActividades = document.getElementById('ddlActividades').children;
     let peso = document.getElementById('pesoAct');
 
     for (let x = 0; x < listaActividades.length; x++) {
         if(listaActividades[x].selected === true){
             peso.innerHTML = listaActividades[x].id;
         }
     }
     calcularTotal();
 }
 
 // Calcula el total entre el pesa de la actividad y la cantidad
 function calcularTotal() {
 
     const pesoAct = Number(document.getElementById('pesoAct').innerHTML);
     const cantidad = Number(document.getElementById('cantidad').value);
 
     const total = pesoAct * cantidad;
     
     document.getElementById('total').innerHTML = total.toFixed(2);
 
 }

 // Valores inciales para selectPicker
function valoresDefaultSelectpicker(){
     $('#ddlActividades').selectpicker('setStyle', 'border', 'add');
     $('#ddlActividades').selectpicker('setStyle', 'btn-light', 'remove');
 
     $('#ddlActividades').selectpicker({
         noneResultsText:'No hay resultados para {0}'
     });
 }