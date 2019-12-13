eventListener();

function eventListener() {
    // Document Ready
    document.addEventListener("DOMContentLoaded", function () {
        fechaHora();
        mueveReloj();
        valoresDefaultSelectpicker();
    });

    // Hacer cuandrilla
    document.getElementById('checkCuadrilla').addEventListener('change', hacerCuadrilla);

    // Limpiar todos los seleccionados en cuadrilla
    document.getElementById('btnLimpiar').addEventListener('click', deseleccionarTodos);

    // Buscar por nombre
    document.getElementById('checkBuscarNombre').addEventListener('change', habilitarBusqueda);

    // Buscar un Usuario
    document.getElementById('btnBuscar').addEventListener('click', buscarUsuario);

    // Filtro por Zona y Area
    document.getElementById('ddlZonas').addEventListener('change', filtrarUsuarios);
    document.getElementById('ddlAreas').addEventListener('change', filtrarUsuarios);

    // Filtrar Actividades por Área
    document.getElementById('ddlAreasAct').addEventListener('change', filtrarActividades);

    // Calcular peso actividades
    document.getElementById('ddlActividades').addEventListener('change', pesoActividades);
    
    // calcular total cuando se ingresa la cantidad
    document.getElementById('cantidad').addEventListener('keyup', calcularTotal);
    document.getElementById('cantidad').addEventListener('click', calcularTotal);

    // Guardar el registro de actividad en la base de datos
    document.getElementById('btnGuardar').addEventListener('click', guardarRegistro);

}

// Valores inciales para selectPicker
function valoresDefaultSelectpicker(){
    $('#ddlUsuarios').selectpicker('setStyle', 'btn-light', 'remove');
    $('#ddlUsuarios').selectpicker('setStyle', 'border', 'add');
    $('#ddlCuadrilla').selectpicker('setStyle', 'btn-light', 'remove');
    $('#ddlCuadrilla').selectpicker('setStyle', 'border', 'add');
    $('#ddlCuadrilla').selectpicker({
        noneResultsText:'No hay resultados para {0}',
        countSelectedText:'{0} Usuarios Seleccionados'
    });
    $('#ddlUsuarios').selectpicker({
        noneResultsText:'No hay resultados para {0}'
    });
    $('#ddlActividades').selectpicker('setStyle', 'border', 'add');
    $('#ddlActividades').selectpicker('setStyle', 'btn-light', 'remove');

    $('#ddlActividades').selectpicker({
        noneResultsText:'No hay resultados para {0}'
    });
}

// Buscar un Usuario por su cédula o código
function buscarUsuario(e) {
    e.preventDefault();

    const codigo = document.getElementById("codigo").value;
    const cedula = document.getElementById("cedula").value;
    const tipo = document.getElementById('tipoBuscar').value;

    if (codigo === "" && cedula === "") {
        mostrarMensaje('error', 'Debe ingresar código o cédula')  
    } else {
        // Se definen los datos que se van a enviar al fetch
        const data = new FormData();
        data.append('codigo', codigo);
        data.append('cedula', cedula);
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
                mostrarMensaje('success', 'Usuario Encontrado')        

                document.getElementById('id').value = respuesta.usuario;
                document.getElementById('nombre').value = respuesta.nombre;
                document.getElementById('area').value = respuesta.area;
                document.getElementById('zona').value = respuesta.zona;
                
            } else  if(respuesta.estado === 'no-existe') {
                mostrarMensaje('error', 'Usuario no existe'); 
            }else {
                // Hubo un error
                if(respuesta.error) {
                    mostrarMensaje('error', 'Algo falló al buscar el usuario');    
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
}

// Habilita o deshabilita la obción de hacer cuadrilla
function hacerCuadrilla() {
        const estado = document.getElementById('checkCuadrilla').checked;
        const busquedaIndividual = document.getElementById('busquedaIndividual');
        const muestraIndividual =  document.getElementById('muestraIndividual');
        const buscaNombre = document.getElementById('buscaNombre');
        const muestraCuadrilla = document.getElementById('muestraCuadrilla');
    
        if(estado === true) {
            busquedaIndividual.style.display = 'none';
            muestraIndividual.style.display = 'none';
            buscaNombre.style.display = 'none';
            muestraCuadrilla.classList.remove('d-none');
            muestraCuadrilla.style.display = 'flex';
            document.getElementById('codigo').value = '';
            document.getElementById('cedula').value = '';
            document.getElementById('id').value = '';
            document.getElementById('nombre').value = '';
            document.getElementById('zona').value = '';
            document.getElementById('area').value = '';
            document.getElementById('ddlZonas').value = 0;
            document.getElementById('ddlAreas').value = 0;
            document.getElementById('checkBuscar').style.display = 'none';
            filtrarUsuarios();
        } else {
            busquedaIndividual.style.display = 'flex';
            muestraIndividual.style.display = 'flex';
            buscaNombre.style.display = 'flex';
            muestraCuadrilla.style.display = 'none';
            document.getElementById('checkBuscar').style.display = 'flex';
            $('.selectpicker').selectpicker('deselectAll');
        }
}

// Limpiar todos los seleccionados en cuadrilla
function deseleccionarTodos() {
    $('#ddlCuadrilla').selectpicker('val', '');
}

// Habilita o deshabilita la obción de busqueda por nombre
function habilitarBusqueda() {
    const estado = document.getElementById('checkBuscarNombre').checked;
    
    if(estado === true) {
        document.getElementById('ddlZonas').disabled = false;
        document.getElementById('ddlAreas').disabled = false;
        document.getElementById('ddlUsuarios').disabled = false;
        refrescarListaUsuarios();
        document.getElementById('codigo').disabled = true;
        document.getElementById('cedula').disabled = true;
        document.getElementById('btnBuscar').disabled = true;
        document.getElementById('codigo').value = '';
        document.getElementById('cedula').value = '';
        document.getElementById('id').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('zona').value = '';
        document.getElementById('area').value = '';
    } else {
        document.getElementById('ddlZonas').disabled = true;
        document.getElementById('ddlAreas').disabled = true;
        document.getElementById('ddlUsuarios').disabled = true;
        document.getElementById('codigo').disabled = false;
        document.getElementById('cedula').disabled = false;
        document.getElementById('btnBuscar').disabled = false;
        refrescarListaUsuarios();
        document.getElementById('ddlZonas').value = 0;
        document.getElementById('ddlAreas').value = 0;
        filtrarUsuarios();
    }
}

// Filtrar los usuarios por Zona y Area
function filtrarUsuarios() {

    const idZona = Number(document.getElementById('ddlZonas').value);
    const idArea = Number(document.getElementById('ddlAreas').value);
    const tablaUsuarios = document.querySelector('#tablaUsuarios tbody');
    const cantidadUsuarios = Number(tablaUsuarios.rows.length);
    let ddlUsuarios = document.getElementById('ddlUsuarios');

    // Limpiamos la lista de usuarios
    while (ddlUsuarios.firstChild) {
        ddlUsuarios.removeChild(ddlUsuarios.firstChild);
    }

    // Llenamos la lista según los filtros
    if(idZona != 0 && idArea != 0){
        for (let x = 0; x < cantidadUsuarios; x++) {
            let tableIdZona = Number(tablaUsuarios.children[x].children[2].textContent);
            let tableIdArea = Number(tablaUsuarios.children[x].children[3].textContent);
            if(idZona === tableIdZona && idArea === tableIdArea){                
                let cedula = tablaUsuarios.children[x].children[0].textContent;
                let nombre = tablaUsuarios.children[x].children[1].textContent;
                let nuevoElemento = document.createElement('option');
                nuevoElemento.setAttribute("data-icon", "far fa-user");
                nuevoElemento.value = cedula; 
                nuevoElemento.innerHTML = ` - ${nombre}`;
                ddlUsuarios.appendChild(nuevoElemento);
            }
        }
        refrescarListaUsuarios();
    } else if (idZona != 0) {
        for (let x = 0; x < cantidadUsuarios; x++) {
            let tableIdZona = Number(tablaUsuarios.children[x].children[2].textContent);
            if(idZona === tableIdZona){                
                let cedula = tablaUsuarios.children[x].children[0].textContent;
                let nombre = tablaUsuarios.children[x].children[1].textContent;
                let nuevoElemento = document.createElement('option');
                nuevoElemento.setAttribute("data-icon", "far fa-user");
                nuevoElemento.value = cedula; 
                nuevoElemento.innerHTML = ` - ${nombre}`;
                ddlUsuarios.appendChild(nuevoElemento);
            }
        }
        refrescarListaUsuarios();
    } else if (idArea != 0) {
        for (let x = 0; x < cantidadUsuarios; x++) {
            let tableIdArea = Number(tablaUsuarios.children[x].children[3].textContent);
            if(idArea === tableIdArea){                
                let cedula = tablaUsuarios.children[x].children[0].textContent;
                let nombre = tablaUsuarios.children[x].children[1].textContent;
                let nuevoElemento = document.createElement('option');
                nuevoElemento.setAttribute("data-icon", "far fa-user");
                nuevoElemento.value = cedula; 
                nuevoElemento.innerHTML = ` - ${nombre}`;
                ddlUsuarios.appendChild(nuevoElemento);
            }
        }
        refrescarListaUsuarios();
    } else {
        for (let x = 0; x < cantidadUsuarios; x++) {   
            let cedula = tablaUsuarios.children[x].children[0].textContent;
            let nombre = tablaUsuarios.children[x].children[1].textContent;
            let nuevoElemento = document.createElement('option');
            nuevoElemento.setAttribute("data-icon", "far fa-user");
            nuevoElemento.value = cedula; 
            nuevoElemento.innerHTML = ` - ${nombre}`;
            ddlUsuarios.appendChild(nuevoElemento);
        }
        refrescarListaUsuarios();
    }
}

// Actualizar la lista de usuarios según los filtros
function refrescarListaUsuarios() {
    $('#ddlUsuarios').selectpicker('refresh');
}

// Filtrar las actividades por Area
function filtrarActividades() {
    const idArea = Number(document.getElementById('ddlAreasAct').value);
    const tablaAct = document.querySelector('#tablaActividades tbody');
    const cantidadAct = Number(tablaAct.rows.length);
    let ddlActividades = document.getElementById('ddlActividades');

    // Limpiamos la lista de usuarios
    while (ddlActividades.firstChild) {
        ddlActividades.removeChild(ddlActividades.firstChild);
    }

    // Llenamos la lista según los filtros
    if(idArea != 0) {
        for (let x = 0; x < cantidadAct; x++) {
            let tableIdArea = Number(tablaAct.children[x].children[3].textContent);
            if(idArea === tableIdArea){                
                let id = tablaAct.children[x].children[0].textContent;
                let actividad = tablaAct.children[x].children[1].textContent;
                let peso = tablaAct.children[x].children[2].textContent;
                let nuevoElemento = document.createElement('option');
                nuevoElemento.id = peso;
                nuevoElemento.value = id; 
                nuevoElemento.setAttribute("data-icon", "far fa-check-square");
                nuevoElemento.innerHTML = ` - ${actividad}`;
                ddlActividades.appendChild(nuevoElemento);


                
            }
        }
        refrescarListaActividades();
    } else {
        for (let x = 0; x < cantidadAct; x++) {   
            let id = tablaAct.children[x].children[0].textContent;
            let actividad = tablaAct.children[x].children[1].textContent;
            let peso = tablaAct.children[x].children[2].textContent;
            let nuevoElemento = document.createElement('option');
            nuevoElemento.value = id; 
            nuevoElemento.id = peso;
            nuevoElemento.setAttribute("data-icon", "far fa-check-square");
                nuevoElemento.innerHTML = ` - ${actividad}`;
            ddlActividades.appendChild(nuevoElemento);
        }
        refrescarListaActividades();
    }
}

// Actualizar la lista de actividades según el filtro
function refrescarListaActividades() {
    $('#ddlActividades').selectpicker('refresh');
    document.getElementById('pesoAct').value = '';
}

// Busca el peso de la actividad seleccionada y lo muestra
function  pesoActividades() {
    const listaActividades = document.getElementById('ddlActividades').children;
    let peso = document.getElementById('pesoAct');

    for (let x = 0; x < listaActividades.length; x++) {
        if(listaActividades[x].selected === true){
            peso.value = listaActividades[x].id;
        }
    }
    calcularTotal();
}

// Calcula el total entre el pesa de la actividad y la cantidad
function calcularTotal() {

    const pesoAct = Number(document.getElementById('pesoAct').value);
    const cantidad = Number(document.getElementById('cantidad').value);

    const total = pesoAct * cantidad;
    
    document.getElementById('total').innerHTML = total.toFixed(2);

}

// Guardar la información en la base de datos, por medio de modelo-registro.php
function guardarRegistro() {

    const cedulaPorCodigo = document.getElementById('id').value;
    const cedulaPorNombre = document.getElementById('ddlUsuarios').value;
    const usuariosCuadrilla = document.querySelectorAll('#ddlCuadrilla option:checked');
    const idActividad = document.getElementById('ddlActividades').value;
    const ost = document.getElementById('OST').value;
    const siga = document.getElementById('SIGA').value;
    const numServicio = document.getElementById('NumServicio').value;
    const cantidad = document.getElementById('cantidad').value;
    const total = document.getElementById('total').innerText;
    const observaciones = document.getElementById('observaciones').value;
    const idRegistrador = document.getElementById('idRegistrador').value;
    const tipo = document.getElementById('tipoRegistrar').value;

    let usuarios = [];
    let cuadrilla = false;

    // Se verifica que un usuario esté seleccionado
    if(cedulaPorCodigo === '' && cedulaPorNombre === '' && usuariosCuadrilla.length === 0){
        mostrarMensaje('error', 'Debe elegir un usuario') 
    } else if(idActividad === ''){
        mostrarMensaje('error', 'Debe seleccionar una actividad');
    } else if(cantidad === ''){
        mostrarMensaje('error', 'Debe indicar una cantidad');
    }
    else {    // Se agrega el usuario(s) al array de usuarios
        if(cedulaPorCodigo != ''){
            usuarios.push(cedulaPorCodigo);
        } else if( cedulaPorNombre != ''){
            usuarios.push(cedulaPorNombre);
        } else {
            for (let x = 0; x < usuariosCuadrilla.length; x++) {
                usuarios.push(usuariosCuadrilla[x].value);   
            }
            if(usuariosCuadrilla.length > 1){   // Si la cuadrilla tiene más de un usuario se establece en true
                cuadrilla = true;
            }
        }

        // Se definen los datos que se van a enviar al fetch
        const data = new FormData();
        data.append('usuarios', usuarios);
        data.append('cuadrilla', cuadrilla);
        data.append('idActividad', idActividad);
        data.append('ost', ost);
        data.append('siga', siga);
        data.append('numServicio', numServicio);
        data.append('cantidad', cantidad);
        data.append('total', total);
        data.append('observaciones', observaciones);
        data.append('idRegistrador', idRegistrador);
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
                mostrarMensaje('success', 'Registro Exitoso') ;      
                limpiarFormulario();
            }else  if(respuesta.estado === 'error') {
                mostrarMensaje('error', 'No se realizó el registro'); 
            } else {
                // Hubo un error
                if(respuesta.error) {
                    mostrarMensaje('error', 'Algo falló al registrar actividad');    
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
}

// Mostrar mensaje en pantalla, según el tipo y el mensaje ingresado
function mostrarMensaje(tipo,mensaje) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        })
        
        Toast.fire({
        icon: tipo,
        title: mensaje
        })    
}

// Muestra la fecha y la hora (solo se está utilizando la fecha)
function fechaHora() {
    // For todays date;
    Date.prototype.today = function () { 
        return ((this.getDate() < 10)?"0":"") + this.getDate() +"/"+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) +"/"+ this.getFullYear();
    }

    // For the time now
    Date.prototype.timeNow = function () {
        return ((this.getHours() < 10)?"0":"") + this.getHours() +":"+ ((this.getMinutes() < 10)?"0":"") + this.getMinutes() +":"+ ((this.getSeconds() < 10)?"0":"") + this.getSeconds();
    }

    var newDate = new Date();
    var datetime = newDate.today();
    document.getElementById('fecha').value = datetime;
}

// Muestra el reloj en el formulario
function mueveReloj(){
    momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()

    str_segundo = new String (segundo)
    if (str_segundo.length == 1)
       segundo = "0" + segundo

    str_minuto = new String (minuto)
    if (str_minuto.length == 1)
       minuto = "0" + minuto

    str_hora = new String (hora)
    if (str_hora.length == 1)
       hora = "0" + hora

    horaImprimible = hora + " : " + minuto + " : " + segundo

    document.getElementById('hora').value = horaImprimible;

    setTimeout("mueveReloj()",1000)
}

// Limpiar todos los campos del formulario luego de guardar el registro
function limpiarFormulario() {
    document.getElementById('codigo').value = '';
    document.getElementById('cedula').value = '';
    document.getElementById('id').value = '';
    document.getElementById('nombre').value = '';
    document.getElementById('zona').value = '';
    document.getElementById('area').value = '';
    document.getElementById('ddlZonas').value = 0;
    document.getElementById('ddlAreas').value = 0;
    filtrarUsuarios();
    refrescarListaUsuarios();
    deseleccionarTodos();
    document.getElementById('ddlAreasAct').value = 0;
    filtrarActividades();
    refrescarListaActividades();
    document.getElementById('OST').value = '';
    document.getElementById('SIGA').value = '';
    document.getElementById('NumServicio').value = '';
    document.getElementById('cantidad').value = '';
    document.getElementById('observaciones').value = '';
    calcularTotal();
}