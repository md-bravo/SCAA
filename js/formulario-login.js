
eventListener();

function eventListener() {

    // Document Ready
    document.addEventListener('DOMContentLoaded', function(){
        
    });

    document.querySelector('#formulario-login').addEventListener('submit', validarLogin);
    
}

function validarLogin(e) {
    e.preventDefault();

    const usuario = document.querySelector('#usuario').value;
    const password = document.querySelector('#password').value;

// Se definen los datos que se van a enviar al fetch
const data = new FormData();
data.append('usuario', usuario);
data.append('password', password);

// Conexión del fetch al archivo php
fetch('inc/modelos/modelo-admin.php', {
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
        // Password correcto
        mostrarMensaje('success','Ingreso Exitoso');    

        setTimeout(() => {           
            window.location.href = 'index.php';                
        }, 2000);
        
    } else  if(respuesta.estado === 'inactivo') {
         // Password incorrecto
         mostrarMensaje('error','Usuario Inactivo');
       
    } else  if(respuesta.estado === 'PasswordFail'){
        // Password incorrecto
        mostrarMensaje('error','Password Incorrecto');
        
    } else if(respuesta.estado === 'NoExiste'){
        // Usuario no existe
        mostrarMensaje('error','El usuario no existe');
        
    } else {
        // Hubo un error
        mostrarMensaje('error','Algo falló al intentar loguearse');
       
    }
}

// Muestra el error si el AJAX no se ejecuta o la respuesta no es ok
function mostrarError(err){
    console.log('Error', err);
}
}