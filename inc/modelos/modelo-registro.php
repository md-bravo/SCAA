<?php

if (isset($_POST['codigo'])) {
    $codigo = filter_var($_POST['codigo'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['cedula'])) {
    $cedula = filter_var($_POST['cedula'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['tipo'])) {
    $tipo = filter_var($_POST['tipo'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['usuarios'])) {
    $usuarios = filter_var($_POST['usuarios'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['cuadrilla'])) {
    $cuadrilla = filter_var($_POST['cuadrilla'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['idActividad'])) {
    $idActividad = filter_var($_POST['idActividad'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['ost'])) {
    $ost = filter_var($_POST['ost'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['siga'])) {
    $siga = filter_var($_POST['siga'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['numServicio'])) {
    $numServicio = filter_var($_POST['numServicio'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['cantidad'])) {
    $cantidad = filter_var($_POST['cantidad'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['total'])) {
    $total = filter_var($_POST['total'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['observaciones'])) {
    $observaciones = filter_var($_POST['observaciones'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['idRegistrador'])) {
    $idRegistrador = filter_var($_POST['idRegistrador'], FILTER_SANITIZE_STRING);
}

// importar la conexion
include '../funciones/conexion.php';

if($tipo === 'buscar'){
    try {
        if($codigo != ''){
            $stmt = $conn->prepare("SELECT cedula, nombre1, nombre2, apellido1, apellido2, areas.nombre_Area, zonas.nombre_Zona FROM usuarios INNER JOIN areas ON usuarios.id_Area = areas.id_Area INNER JOIN zonas ON usuarios.id_Zona = zonas.id_Zona WHERE codigo = ?");   
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
                'estado' => 'correcto',
                'usuario' => $id,
                'nombre' => $nombre1 . ' ' . $nombre2 . ' ' . $apellido1 . ' ' . $apellido2,  
                'area' => $area,
                'zona' => $zona
            );
        } else {
            $respuesta = array(
                'estado' => 'no-existe'
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
}

if($tipo === 'registrar'){
   
    $respuesta = array(
        'estado' => 'correcto',
        'usuarios' => $usuarios,
        'cudrilla' => $cuadrilla,
        'idActividad' => $idActividad,
        'ost' => $ost,
        'siga' => $siga,
        'numServicio' => $numServicio,
        'cantidad' => $cantidad,
        'total' => $total,
        'observaciones' => $observaciones,
        'idRegistrador' => $idRegistrador,
        'tipo' => $tipo
    );

    echo json_encode($respuesta);
}
