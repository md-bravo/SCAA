eventListener();

function eventListener() {
    // Document Ready
    document.addEventListener("DOMContentLoaded", function () {
        fechaHora();
        mueveReloj();
        refrescarListaUsuarios();
        refrescarListaActividades();
    });

    // Buscar un Usuario
    document.getElementById('btnBuscar').addEventListener('click', buscarUsuario);

    // Filtro por Zona y Area
    document.getElementById('ddlZonas').addEventListener('change', filtrarUsuarios);
    document.getElementById('ddlAreas').addEventListener('change', filtrarUsuarios);

    // Hacer cuandrilla
    document.getElementById('checkCuadrilla').addEventListener('change', hacerCuadrilla);

    // Limpiar todos los seleccionados en cuadrilla
    document.getElementById('btnLimpiar').addEventListener('click', deseleccionarTodos);

    // Buscar por nombre
    document.getElementById('checkBuscarNombre').addEventListener('change', habilitarBusqueda);

    // Filtrar Actividades por Área
    document.getElementById('ddlAreasAct').addEventListener('change', filtrarActividades);

    // Calcular peso actividades
    document.getElementById('ddlActividades').addEventListener('change', pesoActividades);
    

    document.getElementById('cantidad').addEventListener('keyup', calcularTotal);

    // PENDIENTE (Ver todos los usuarios seleccionados en cuadrilla).
    // document.querySelectorAll('#ddlCuadrilla option:checked')[2].value

}

// Limpiar todos los seleccionados en cuadrilla
function deseleccionarTodos(e) {
    e.preventDefault();
    $('#ddlCuadrilla').selectpicker('val', '');
}
// Calcula el total entre el pesa de la actividad y la cantidad
function calcularTotal(e) {

    const pesoAct = Number(document.getElementById('pesoAct').value);
    const cantidad = Number(document.getElementById('cantidad').value);

    const total = pesoAct * cantidad;
    
    document.getElementById('total').innerHTML = total.toFixed(2);

}

// Busca el peso de la actividad seleccionada y lo muestra
function  pesoActividades(e) {
    const listaActividades = document.getElementById('ddlActividades').children;
    let peso = document.getElementById('pesoAct');

    for (let x = 0; x < listaActividades.length; x++) {
        if(listaActividades[x].selected === true){
            peso.value = listaActividades[x].id;
        }
    }
    
}

// Filtrar las actividades por Area
function filtrarActividades(e) {
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
function refrescarListaActividades(e) {
    $('#ddlActividades').selectpicker('refresh');
    $('#ddlActividades').selectpicker('setStyle', 'border', 'add');
    $('#ddlActividades').selectpicker('setStyle', 'btn-light', 'remove');
    document.getElementById('pesoAct').value = '';
}

// Habilita o deshabilita la obción de hacer cuadrilla
function hacerCuadrilla(e) {
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

// Habilita o deshabilita la obción de busqueda por nombre
function habilitarBusqueda(e) {
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
function filtrarUsuarios(e) {

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
    $('#ddlUsuarios').selectpicker('setStyle', 'btn-light', 'remove');
    $('#ddlUsuarios').selectpicker('setStyle', 'border', 'add');
    $('#ddlCuadrilla').selectpicker('setStyle', 'btn-light', 'remove');
    $('#ddlCuadrilla').selectpicker('setStyle', 'border', 'add');
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

// Buscar un Usuario por su cédula o código
function buscarUsuario(e) {
    e.preventDefault();

    const codigo = document.getElementById("codigo").value;
    const cedula = document.getElementById("cedula").value;

    if (codigo === "" && cedula === "") {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Debe de ingresar el código o la cédula"
        });
    } else {
        // Se definen los datos que se van a enviar al fetch
        const data = new FormData();
        data.append('codigo', codigo);
        data.append('cedula', cedula);

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
            if(respuesta.respuesta === 'correcto') {      
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
                })
                
                Toast.fire({
                icon: 'success',
                title: 'Usuario Encontrado'
                })         

            document.getElementById('id').value = respuesta.usuario;
            document.getElementById('nombre').value = respuesta.nombre;
            document.getElementById('area').value = respuesta.area;
            document.getElementById('zona').value = respuesta.zona;
                
            } else  if(respuesta.respuesta === 'no-existe') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
                })
                
                Toast.fire({
                icon: 'error',
                title: 'Usuario no existe'
                })    
            }else {
                // Hubo un error
                if(respuesta.error) {
                    swal({
                        title: 'Error',
                        text: 'Algo falló al buscar el usuario',
                        icon: 'error'
                    });    
                }
            }
        }

        // Muestra el error si el AJAX no se ejecuta o la respuesta no es ok
        function mostrarError(err){
            console.log('Error', err);
        }
    }
}
