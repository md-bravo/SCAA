
eventListener();

function eventListener() {

    // Document Ready
    document.addEventListener('DOMContentLoaded', function(){
        // Inicializar la variable en el session storage para medir el tiempo de inactividad
        var timeStamp = new Date();
        sessionStorage.setItem("lastTimeStamp",timeStamp);
    });



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
        var maxMinutes  = 5;  // Minutos de espera
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