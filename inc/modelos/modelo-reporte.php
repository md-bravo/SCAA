<?php 

if (isset($_POST['fechaInicio'])) {
    $fechaInicio = $_POST['fechaInicio'];
}
if (isset($_POST['fechaFin'])) {
    $fechaFin = $_POST['fechaFin'];
}


// importar la conexion
include '../funciones/conexion.php';

try {
    $stmt = $conn->prepare("SELECT id_Reg_Act, consecutivo, OST, SIGA, cantidad_eventos, numero_servicio, detalle, fecha_hora_apertura, fecha_hora_cierre, tiempo_total, peso_total, usuario_asignado, usuario_asignador, usuario_cierra, id_Act FROM reg_act_cerrados WHERE fecha_hora_apertura >= ? AND fecha_hora_apertura < ? ORDER BY consecutivo ASC");
    $stmt->bind_param('ss', $fechaInicio, $fechaFin);
    $stmt->execute();
    $stmt->bind_result($id_Reg_Act, $consecutivo, $OST, $SIGA, $cantidad_eventos, $numero_servicio, $detalle, $fecha_hora_apertura, $fecha_hora_cierre, $tiempo_total, $peso_total, $usuario_asignado, $usuario_asignador, $usuario_cierra, $id_Act);

    $respuesta = array(
        'data' => array()
    );

    while ($stmt->fetch()) {
        $fecha_Apertura = date_create($fecha_hora_apertura);
        $fecha_Cierre = date_create($fecha_hora_cierre);
        array_push($respuesta['data'], ['id_reg_act' => $id_Reg_Act, 'consecutivo' => $consecutivo, 'ost' => $OST, 'siga' => $SIGA, 'numero_servicio' => $numero_servicio, 'cantidad_eventos' => $cantidad_eventos, 'peso_total' => $peso_total, 'tiempo_total' => $tiempo_total, 'id_Act' => $id_Act, 'fecha_hora_apertura' => date_format($fecha_Apertura, 'd-m-Y H:i:s'), 'fecha_hora_cierre' => date_format($fecha_Cierre, 'd-m-Y H:i:s'), 'detalle' => $detalle, 'usuario_asignado' => $usuario_asignado, 'usuario_asignador' => $usuario_asignador, 'usuario_cierra' => $usuario_cierra]);  
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