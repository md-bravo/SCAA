eventListener();

function eventListener() {
    // Document Ready
    document.addEventListener("DOMContentLoaded", function () {
        // let fechaActual = new Date().toLocaleDateString('es-ES');
        // console.log(fechaActual);
        // document.getElementById('fecha').value = fechaActual;
        fechaHora();
        mueveReloj();
    });

    // Hacer cuandrilla
    document.getElementById('checkCuadrilla').addEventListener('change', hacerCuadrilla);

    // Buscar un Usuario
    document.getElementById("btnBuscar").addEventListener("click", buscarUsuario);
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

function hacerCuadrilla(e) {
    const estado = document.getElementById('checkCuadrilla').checked;
    const busquedaIndividual = document.getElementById('busquedaIndividual');
    const muestraIndividual =  document.getElementById('muestraIndividual');
    const muestraCuadrilla = document.getElementById('muestraCuadrilla');

    if(estado === true) {
        busquedaIndividual.style.display = 'none';
        muestraIndividual.style.display = 'none';
        muestraCuadrilla.classList.remove('d-none');
        muestraCuadrilla.style.display = 'flex';
    } else {
        busquedaIndividual.style.display = 'flex';
        muestraIndividual.style.display = 'flex';
        muestraCuadrilla.style.display = 'none';
    }
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
