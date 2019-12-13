
eventListener();

function eventListener() {

    // Document Ready
    document.addEventListener('DOMContentLoaded', function(){
        // Inicializar la variable en el session storage para medir el tiempo de inactividad
        var timeStamp = new Date();
        sessionStorage.setItem("lastTimeStamp",timeStamp);

        verificarNav();
    });


}

// Esta función determina en que página se encuentra y agrega la clase active al menú que corresponde.
function verificarNav(e) {
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

// Tabla de registros
$(document).ready(function() {
    $('#example').DataTable({
        "order": [[ 1, "desc" ]],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No hay registros",
            "info": "Página _PAGE_ de _PAGES_  G = Grupo",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "first":      "Primera",
                "last":       "Última",
                "next":       "Siguiente",
                "previous":   "Previa"
            },
            select: {
                rows: {
                    _: "You have selected %d rows",
                    0: "",
                    1: "1 fila seleccionada"
                }
            }
        },
        "select": 'single'
    });

} );