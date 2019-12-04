eventListener();

function eventListener() {
    // Document Ready
    document.addEventListener("DOMContentLoaded", function () { });

    // Buscar un Usuario
    document.getElementById("btnBuscar").addEventListener("click", buscarUsuario);
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
