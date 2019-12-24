<?php 

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
}
if (isset($_POST['rol'])) {
    $rol = $_POST['rol'];
}
if (isset($_POST['tipo'])) {
    $tipo = $_POST['tipo'];
}


// importar la conexion
include '../funciones/conexion.php';

if($tipo === "llenarTabla"){

     // Consultar los estados disponibles, para conocer su id
     $stmt = $conn->prepare("SELECT * FROM estados_reg_act");
     $stmt->execute();
     $stmt->bind_result($id_Estado, $estado_Reg_Act);

     while ($stmt->fetch()) {
         if($estado_Reg_Act === "Abierto"){
             $estado = $id_Estado;
         }
     }
     $stmt->close();

    if($rol === "Vista" || $rol === "Tecnico"){
        try {
            $stmt = $conn->prepare("SELECT id_Reg_Act, consecutivo, OST, SIGA, cantidad_eventos, numero_servicio, detalle, fecha_hora_apertura, peso_total, reg_act.id_Act, usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2, actividades.nombre_Act, actividades.peso_Act, id_Grupo_Reg FROM reg_act INNER JOIN usuarios ON usuarios.cedula = reg_act.usuario_asignado INNER JOIN actividades ON actividades.id_Act = reg_act.id_Act WHERE usuario_asignado = ? &&reg_act.id_Estado_Reg_Act = ?  ORDER BY consecutivo DESC");
            $stmt->bind_param('ss', $usuario, $estado);
            $stmt->execute();
            $stmt->bind_result($id_Reg_Act, $consecutivo, $OST, $SIGA, $cantidad_eventos, $numero_servicio, $detalle, $fecha_hora_apertura, $peso_total, $id_Act, $nombre1, $nombre2, $apellido1, $apellido2, $actividad, $peso_Act, $grupo);

            $respuesta = array(
                'data' => array()
            );

            while ($stmt->fetch()) {
            array_push($respuesta['data'], ['id_reg_act' => $id_Reg_Act, 'consecutivo' => $consecutivo, 'ost' => $OST, 'siga' => $SIGA, 'numero_servicio' => $numero_servicio, 'actividad' => $actividad, 'peso_act' => $peso_Act, 'cantidad_eventos' => $cantidad_eventos, 'peso_total' => $peso_total, 'id_Act' => $id_Act, 'fecha_hora_apertura' => $fecha_hora_apertura, 'nombre' => $nombre1 . ' ' . $nombre2 . ' ' . $apellido1 . ' ' . $apellido2, 'detalle' => $detalle, 'grupo' => $grupo]);  
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
            $stmt = $conn->prepare("SELECT id_Reg_Act, consecutivo, OST, SIGA, cantidad_eventos, numero_servicio, detalle, fecha_hora_apertura, peso_total, reg_act.id_Act, usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2, actividades.nombre_Act, actividades.peso_Act, id_Grupo_Reg FROM reg_act INNER JOIN usuarios ON usuarios.cedula = reg_act.usuario_asignado INNER JOIN actividades ON actividades.id_Act = reg_act.id_Act WHERE reg_act.id_Estado_Reg_Act = ? ORDER BY consecutivo DESC");
            $stmt->bind_param('s', $estado);
            $stmt->execute();
            $stmt->bind_result($id_Reg_Act, $consecutivo, $OST, $SIGA, $cantidad_eventos, $numero_servicio, $detalle, $fecha_hora_apertura, $peso_total, $id_Act, $nombre1, $nombre2, $apellido1, $apellido2, $actividad, $peso_Act, $grupo);

            $respuesta = array(
                'data' => array()
            );

            while ($stmt->fetch()) {
                $fecha_Apertura = date_create($fecha_hora_apertura);
                array_push($respuesta['data'], ['id_reg_act' => $id_Reg_Act, 'consecutivo' => $consecutivo, 'ost' => $OST, 'siga' => $SIGA, 'numero_servicio' => $numero_servicio, 'actividad' => $actividad, 'peso_act' => $peso_Act, 'cantidad_eventos' => $cantidad_eventos, 'peso_total' => $peso_total, 'id_Act' => $id_Act, 'fecha_hora_apertura' => date_format($fecha_Apertura, 'd-m-Y H:i:s'), 'nombre' => $nombre1 . ' ' . $nombre2 . ' ' . $apellido1 . ' ' . $apellido2, 'detalle' => $detalle, 'grupo' => $grupo]);  
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
}

