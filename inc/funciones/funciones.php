<?php

// Obtiene la página actual que se ejecuta
function obtenerPaginaActual() {
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    return $pagina;
}

function obtenerZonas() {
    include 'conexion.php';
    try {
        return $conn->query('SELECT id_Zona, nombre_Zona FROM zonas ORDER BY nombre_Zona ASC');
    } catch(Exception $e) {
        echo "Error! : " . $e->getMessage();
        return false;
    }
}

function obtenerAreas() {
    include 'conexion.php';
    try {
        return $conn->query('SELECT id_Area, nombre_Area FROM areas ORDER BY nombre_Area ASC');
    } catch(Exception $e) {
        echo "Error! : " . $e->getMessage();
        return false;
    }
}

function obtenerUsuarios() {
    include 'conexion.php';
    try {
        return $conn->query('SELECT cedula, nombre1, nombre2, apellido1, apellido2, id_Zona, id_Area FROM usuarios ORDER BY apellido1 ASC');
    } catch(Exception $e) {
        echo "Error! : " . $e->getMessage();
        return false;
    }
}

function obtenerActividades() {
    include 'conexion.php';
    try {
        return $conn->query('SELECT * FROM actividades ORDER BY id_Area ASC');
    } catch(Exception $e) {
        echo "Error! : " . $e->getMessage();
        return false;
    }
}

// function obtenerListaRegistros() {
//     include 'conexion.php';
//     try {
//         return $conn->query('SELECT id_Reg_Act, consecutivo, OST, SIGA, cantidad_eventos, numero_servicio, detalle, fecha_hora_apertura, peso_total, usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2, actividades.nombre_Act, id_Grupo_Reg FROM reg_act INNER JOIN usuarios ON usuarios.cedula = reg_act.usuario_asignado INNER JOIN actividades ON actividades.id_Act = reg_act.id_Act ORDER BY consecutivo DESC');
//     } catch(Exception $e) {
//         echo "Error! : " . $e->getMessage();
//         return false;
//     }
// }

?>