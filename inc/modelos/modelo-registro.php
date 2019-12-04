<?php

if (isset($_POST['codigo'])) {
    $codigo = filter_var($_POST['codigo'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['cedula'])) {
    $cedula = filter_var($_POST['cedula'], FILTER_SANITIZE_STRING);
}

// importar la conexion
include '../funciones/conexion.php';

try {
    if($codigo != ''){
        $stmt = $conn->prepare("SELECT codigo, nombre1, nombre2, apellido1, apellido2, areas.nombre_Area, zonas.nombre_Zona FROM usuarios INNER JOIN areas ON usuarios.id_Area = areas.id_Area INNER JOIN zonas ON usuarios.id_Zona = zonas.id_Zona WHERE codigo = ?");   
        $stmt->bind_param('s', $codigo);
    } else {
        $stmt = $conn->prepare("SELECT cedula, nombre1, nombre2, apellido1, apellido2, areas.nombre_Area, zonas.nombre_Zona FROM usuarios INNER JOIN areas ON usuarios.id_Area = areas.id_Area INNER JOIN zonas ON usuarios.id_Zona = zonas.id_Zona WHERE cedula = ?");
        $stmt->bind_param('s', $cedula);
    }
    $stmt->execute();
    $stmt->bind_result($id, $nombre1, $nombre2, $apellido1, $apellido2, $area, $zona);
    $stmt->fetch();

    if($id){
        $respuesta = array(
            'respuesta' => 'correcto',
            'usuario' => $id,
            'nombre' => $nombre1 . ' ' . $nombre2 . ' ' . $apellido1 . ' ' . $apellido2,  
            'area' => $area,
            'zona' => $zona
        );
    } else {
        $respuesta = array(
            'respuesta' => 'no-existe'
        );
    }
    $stmt->close();
    $conn->close();

} catch(Exception $e) {
    // En caso de un error, tomar la exepcion
    $respuesta = array(
        'error' => $e->getMessage()
    );
}

echo json_encode($respuesta);