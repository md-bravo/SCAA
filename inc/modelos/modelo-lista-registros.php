<?php 

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
}
if (isset($_POST['rol'])) {
    $rol = $_POST['rol'];
}


// importar la conexion
include '../funciones/conexion.php';


if($rol === "Vista" || $rol === "Tecnico"){
    try {
        $stmt = $conn->prepare("SELECT id_Reg_Act, consecutivo, OST, SIGA, cantidad_eventos, numero_servicio, detalle, fecha_hora_apertura, peso_total, usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2, actividades.nombre_Act, id_Grupo_Reg FROM reg_act INNER JOIN usuarios ON usuarios.cedula = reg_act.usuario_asignado INNER JOIN actividades ON actividades.id_Act = reg_act.id_Act WHERE usuario_asignado = ? ORDER BY consecutivo DESC");
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $stmt->bind_result($id_Reg_Act, $consecutivo, $OST, $SIGA, $cantidad_eventos, $numero_servicio, $detalle, $fecha_hora_apertura, $peso_total, $nombre1, $nombre2, $apellido1, $apellido2, $actividad, $grupo);

        $respuesta = array(
             'data' => array()
        );

        while ($stmt->fetch()) {
          array_push($respuesta['data'], ['id_reg_act' => $id_Reg_Act, 'consecutivo' => $consecutivo, 'ost' => $OST, 'siga' => $SIGA, 'numero_servicio' => $numero_servicio, 'actividad' => $actividad, 'cantidad_eventos' => $cantidad_eventos, 'peso_total' => $peso_total, 'fecha_hora_apertura' => $fecha_hora_apertura, 'nombre' => $nombre1 . ' ' . $nombre2 . ' ' . $apellido1 . ' ' . $apellido2, 'detalle' => $detalle, 'grupo' => $grupo]);  
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
     
} else {
    try {
        $stmt = $conn->prepare("SELECT id_Reg_Act, consecutivo, OST, SIGA, cantidad_eventos, numero_servicio, detalle, fecha_hora_apertura, peso_total, usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2, actividades.nombre_Act, id_Grupo_Reg FROM reg_act INNER JOIN usuarios ON usuarios.cedula = reg_act.usuario_asignado INNER JOIN actividades ON actividades.id_Act = reg_act.id_Act ORDER BY consecutivo DESC");

        $stmt->execute();
        $stmt->bind_result($id_Reg_Act, $consecutivo, $OST, $SIGA, $cantidad_eventos, $numero_servicio, $detalle, $fecha_hora_apertura, $peso_total, $nombre1, $nombre2, $apellido1, $apellido2, $actividad, $grupo);

        $respuesta = array(
             'data' => array()
        );

        while ($stmt->fetch()) {
          array_push($respuesta['data'], ['id_reg_act' => $id_Reg_Act, 'consecutivo' => $consecutivo, 'ost' => $OST, 'siga' => $SIGA, 'numero_servicio' => $numero_servicio, 'actividad' => $actividad, 'cantidad_eventos' => $cantidad_eventos, 'peso_total' => $peso_total, 'fecha_hora_apertura' => $fecha_hora_apertura, 'nombre' => $nombre1 . ' ' . $nombre2 . ' ' . $apellido1 . ' ' . $apellido2, 'detalle' => $detalle, 'grupo' => $grupo]);  
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
}