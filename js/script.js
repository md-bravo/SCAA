
eventListener();

function eventListener() {

    // Document Ready
    document.addEventListener('DOMContentLoaded', function(){
        // Inicializar la variable en el session storage para medir el tiempo de inactividad
        var timeStamp = new Date();
        sessionStorage.setItem("lastTimeStamp",timeStamp);

        verificarRol();
        verificarNav();
    });


}

// Carga el menú lateral según el rol del usuario logueado
function verificarRol() {
    const rol = document.getElementById('rolRegistrador').value;
        if(rol === 'Vista' || rol === 'Tecnico'){
            const menu = document.querySelectorAll('.sidebar-nav li');
            menu[1].remove();
            menu[2].remove();
        }
}


// Esta función determina en que página se encuentra y agrega la clase active al menú que corresponde.
function verificarNav() {
    const url = window.location.pathname;

    if(url.indexOf('index') != -1){
        document.querySelector('.sidebar-nav').children[0].classList.add('active');
    } else if(url.indexOf('registro') != -1){
        document.querySelector('.sidebar-nav').children[1].classList.add('active');
    } else if(url.indexOf('reporte') != -1) {
        document.querySelector('.sidebar-nav').children[2].classList.add('active');
    }
}

// Colapsar el sidebar
$("#sidebar-toggle").click(function(e) {
     e.preventDefault();
     $("#wrapper").toggleClass("toggled");
 });


// Función para medir el tiempo de inactividad y cerrar sesión.
$(function()
{

    // Cada vez que se mueve el mouse se almacena el tiempo actual en el session storage
    if(typeof(Storage) !== "undefined") 
    {
        $(document).mousemove(function()
        {
            var timeStamp = new Date();
            sessionStorage.setItem("lastTimeStamp",timeStamp);
        });

        timeChecker();
    }  

    // Cada 3 segundos lee el último tiempo almacenado en session storage
    function timeChecker()
    {
        setInterval(function()
        {
            var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");  
            timeCompare(storedTimeStamp);
        },3000);
    }

    /** Calcula el tiempo transcurrido desde la última vez que se movió el mouse
       se convierte ese resultado a minutos. Si la cantidad optenida es mayor o
       igual a la cantidad de minutos máxima establecida, se elimina la sessión. */
    function timeCompare(timeString)
    {
        var maxMinutes  = 30;  // Minutos de espera
        var currentTime = new Date();
        var pastTime    = new Date(timeString);
        var timeDiff    = currentTime - pastTime;
        var minPast     = Math.floor( (timeDiff/60000) ); 

        if( minPast >= maxMinutes)
        {
            sessionStorage.removeItem("lastTimeStamp");
            window.location = "./inc/funciones/session_killer.php";
            return false;
        } 
    }

});

// Muestra la fecha y la hora (solo se está utilizando la fecha)
function fechaHora() {
    // For todays date;
    Date.prototype.today = function () { 
        return ((this.getDate() < 10)?"0":"") + this.getDate() +"-"+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) +"-"+ this.getFullYear();
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

// Restricts input for the given textbox to the given inputFilter.
function setInputFilter(textbox, inputFilter) {
    if(textbox != null) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
            });
        });
    }
  }

// Restringir la entrada de solo números con dos decimales
setInputFilter(document.getElementById("cantidad"), function(value) {
    return /^\d*[.]?\d{0,2}$/.test(value);
});