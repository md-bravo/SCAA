<?php 

if (isset($_POST['fechaInicio'])) {
    $fechaInicio = $_POST['fechaInicio'];
}
if (isset($_POST['fechaFin'])) {
    $fechaFin = $_POST['fechaFin'];
}
if (isset($_POST['idZona'])) {
    $idZona = $_POST['idZona'];
}
if (isset($_POST['idArea'])) {
    $idArea = $_POST['idArea'];
}
if (isset($_POST['cedula'])) {
    $cedula = $_POST['cedula'];
    if($cedula === ''){
        $cedula = NULL;
    }
}

// importar la conexion
include '../funciones/conexion.php';

try {
    if($cedula != NULL){
        $stmt = $conn->prepare("SELECT a.consecutivo, a.OST, a.SIGA, a.numero_servicio, a.cantidad_eventos, a.peso_total, e.nombre_Act, a.detalle, a.fecha_hora_apertura, a.fecha_hora_cierre, a.tiempo_total, CONCAT_WS(' ', b.nombre1, b.apellido1, b.apellido2) AS usuario_asignado, CONCAT_WS(' ', c.nombre1, c.apellido1, c.apellido2) AS usuario_asignador, CONCAT_WS(' ', d.nombre1, d.apellido1, d.apellido2) AS usuario_cierra FROM reg_act_cerrados a INNER JOIN usuarios b ON b.cedula = a.usuario_asignado INNER JOIN usuarios c ON c.cedula = a.usuario_asignador INNER JOIN usuarios d ON d.cedula = a.usuario_cierra INNER JOIN actividades e ON e.id_Act = a.id_Act WHERE fecha_hora_apertura >= ? AND fecha_hora_apertura < ? AND a.usuario_asignado = ? ORDER BY consecutivo ASC");
        $stmt->bind_param('sss', $fechaInicio, $fechaFin, $cedula);
    } else if($idZona != 0 && $idArea != 0){
        $stmt = $conn->prepare("SELECT a.consecutivo, a.OST, a.SIGA, a.numero_servicio, a.cantidad_eventos, a.peso_total, e.nombre_Act, a.detalle, a.fecha_hora_apertura, a.fecha_hora_cierre, a.tiempo_total, CONCAT_WS(' ', b.nombre1, b.apellido1, b.apellido2) AS usuario_asignado, CONCAT_WS(' ', c.nombre1, c.apellido1, c.apellido2) AS usuario_asignador, CONCAT_WS(' ', d.nombre1, d.apellido1, d.apellido2) AS usuario_cierra FROM reg_act_cerrados a INNER JOIN usuarios b ON b.cedula = a.usuario_asignado INNER JOIN usuarios c ON c.cedula = a.usuario_asignador INNER JOIN usuarios d ON d.cedula = a.usuario_cierra INNER JOIN actividades e ON e.id_Act = a.id_Act WHERE fecha_hora_apertura >= ? AND fecha_hora_apertura < ? AND a.usuario_asignado IN (SELECT cedula FROM usuarios WHERE id_Zona = ? AND id_Area = ?) ORDER BY consecutivo ASC");
        $stmt->bind_param('ssss', $fechaInicio, $fechaFin, $idZona, $idArea);
    }
    else if($idZona != 0){
        $stmt = $conn->prepare("SELECT a.consecutivo, a.OST, a.SIGA, a.numero_servicio, a.cantidad_eventos, a.peso_total, e.nombre_Act, a.detalle, a.fecha_hora_apertura, a.fecha_hora_cierre, a.tiempo_total, CONCAT_WS(' ', b.nombre1, b.apellido1, b.apellido2) AS usuario_asignado, CONCAT_WS(' ', c.nombre1, c.apellido1, c.apellido2) AS usuario_asignador, CONCAT_WS(' ', d.nombre1, d.apellido1, d.apellido2) AS usuario_cierra FROM reg_act_cerrados a INNER JOIN usuarios b ON b.cedula = a.usuario_asignado INNER JOIN usuarios c ON c.cedula = a.usuario_asignador INNER JOIN usuarios d ON d.cedula = a.usuario_cierra INNER JOIN actividades e ON e.id_Act = a.id_Act WHERE fecha_hora_apertura >= ? AND fecha_hora_apertura < ? AND a.usuario_asignado IN (SELECT cedula FROM usuarios WHERE id_Zona = ?) ORDER BY consecutivo ASC");
        $stmt->bind_param('sss', $fechaInicio, $fechaFin, $idZona);
    } else if($idArea != 0){
        $stmt = $conn->prepare("SELECT a.consecutivo, a.OST, a.SIGA, a.numero_servicio, a.cantidad_eventos, a.peso_total, e.nombre_Act, a.detalle, a.fecha_hora_apertura, a.fecha_hora_cierre, a.tiempo_total, CONCAT_WS(' ', b.nombre1, b.apellido1, b.apellido2) AS usuario_asignado, CONCAT_WS(' ', c.nombre1, c.apellido1, c.apellido2) AS usuario_asignador, CONCAT_WS(' ', d.nombre1, d.apellido1, d.apellido2) AS usuario_cierra FROM reg_act_cerrados a INNER JOIN usuarios b ON b.cedula = a.usuario_asignado INNER JOIN usuarios c ON c.cedula = a.usuario_asignador INNER JOIN usuarios d ON d.cedula = a.usuario_cierra INNER JOIN actividades e ON e.id_Act = a.id_Act WHERE fecha_hora_apertura >= ? AND fecha_hora_apertura < ? AND a.usuario_asignado IN (SELECT cedula FROM usuarios WHERE id_Area = ?) ORDER BY consecutivo ASC");
        $stmt->bind_param('sss', $fechaInicio, $fechaFin, $idArea);
    }
    else {
        $stmt = $conn->prepare("SELECT a.consecutivo, a.OST, a.SIGA, a.numero_servicio, a.cantidad_eventos, a.peso_total, e.nombre_Act, a.detalle, a.fecha_hora_apertura, a.fecha_hora_cierre, a.tiempo_total, CONCAT_WS(' ', b.nombre1, b.apellido1, b.apellido2) AS usuario_asignado, CONCAT_WS(' ', c.nombre1, c.apellido1, c.apellido2) AS usuario_asignador, CONCAT_WS(' ', d.nombre1, d.apellido1, d.apellido2) AS usuario_cierra FROM reg_act_cerrados a INNER JOIN usuarios b ON b.cedula = a.usuario_asignado INNER JOIN usuarios c ON c.cedula = a.usuario_asignador INNER JOIN usuarios d ON d.cedula = a.usuario_cierra INNER JOIN actividades e ON e.id_Act = a.id_Act WHERE fecha_hora_apertura >= ? AND fecha_hora_apertura < ? ORDER BY consecutivo ASC");
        $stmt->bind_param('ss', $fechaInicio, $fechaFin);
    }
    $stmt->execute();
    $stmt->bind_result($consecutivo, $OST, $SIGA, $numero_servicio, $cantidad_eventos, $peso_total, $actividad, $detalle, $fecha_hora_apertura, $fecha_hora_cierre, $tiempo_total, $usuario_asignado, $usuario_asignador, $usuario_cierra);

    $respuesta = array(
        'data' => array()
    );

    $totalRegistros = 0;
    while ($stmt->fetch()) {
        $fecha_Apertura = date_create($fecha_hora_apertura);
        $fecha_Cierre = date_create($fecha_hora_cierre);
        array_push($respuesta['data'], ['consecutivo' => $consecutivo, 'ost' => $OST, 'siga' => $SIGA, 'numero_servicio' => $numero_servicio, 'cantidad_eventos' => $cantidad_eventos, 'peso_total' => $peso_total, 'actividad' => $actividad, 'detalle' => $detalle, 'fecha_hora_apertura' => date_format($fecha_Apertura, 'd-m-Y H:i:s'), 'fecha_hora_cierre' => date_format($fecha_Cierre, 'd-m-Y H:i:s'), 'tiempo_total' => $tiempo_total,  'usuario_asignado' => $usuario_asignado, 'usuario_asignador' => $usuario_asignador, 'usuario_cierra' => $usuario_cierra]);  
        $totalRegistros++;
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