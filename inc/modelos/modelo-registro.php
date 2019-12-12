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
    if($ost === ''){
        $ost = NULL;
    }
}
if (isset($_POST['siga'])) {
    $siga = filter_var($_POST['siga'], FILTER_SANITIZE_STRING);
    if($siga === ''){
        $siga = NULL;
    }
}
if (isset($_POST['numServicio'])) {
    $numServicio = filter_var($_POST['numServicio'], FILTER_SANITIZE_STRING);
    if($numServicio === ''){
        $numServicio = NULL;
    }
}
if (isset($_POST['cantidad'])) {
    $cantidad = filter_var($_POST['cantidad'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['total'])) {
    $total = filter_var($_POST['total'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['observaciones'])) {
    $observaciones = filter_var($_POST['observaciones'], FILTER_SANITIZE_STRING);
    if($observaciones === ''){
        $observaciones = NULL;
    }
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

    date_default_timezone_set('America/Costa_Rica');
    $fechaHora = Date('Y/m/d H:i:s');
    $id_Estado_Reg_Act = 71;

    $listaUsuarios = explode(",", $usuarios);
    $cantidadUsuarios = count($listaUsuarios);

    if($cantidadUsuarios === 1){
        try {
            $stmt = $conn->prepare("INSERT INTO reg_act (OST, SIGA, cantidad_eventos, numero_servicio, detalle, fecha_hora_apertura, usuario_asignado, usuario_asignador, id_Act, id_Estado_Reg_Act) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");   
            $stmt->bind_param('ssssssssss', $ost, $siga, $cantidad, $numServicio, $observaciones, $fechaHora, $usuarios, $idRegistrador, $idActividad, $id_Estado_Reg_Act);
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                $respuesta = array(
                    'estado' => 'correcto',
                    'id_insertado' => $stmt->insert_id
                );
            }  else {
                $respuesta = array(
                    'estado' => 'error'
                );
            }
            $stmt->close();
            $conn->close();


        } catch (Exception $e) {
            // En caso de un error, tomar la exepcion
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
        
    }else {
        try {         
            $grupo = array();   
            foreach ($listaUsuarios as $usuario) {
                try {
                    $stmt = $conn->prepare("INSERT INTO reg_act (OST, SIGA, cantidad_eventos, numero_servicio, detalle, fecha_hora_apertura, usuario_asignado, usuario_asignador, id_Act, id_Estado_Reg_Act) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");   
                    $stmt->bind_param('ssssssssss', $ost, $siga, $cantidad, $numServicio, $observaciones, $fechaHora, $usuario, $idRegistrador, $idActividad, $id_Estado_Reg_Act);
                    $stmt->execute();

                    if($stmt->affected_rows > 0) {
                        array_push($grupo, $stmt->insert_id);
                    }

                    if($stmt->affected_rows > 0) {
                        $respuesta = array(
                            'estado' => 'correcto',
                            'id_insertado' => $stmt->insert_id
                        );
                    }  else {
                        $respuesta = array(
                            'estado' => 'error'
                        );
                    }
                    $stmt->close();    
        
                } catch (Exception $e) {
                    // En caso de un error, tomar la exepcion
                    $respuesta = array(
                        'error' => $e->getMessage()
                    );
                }
            }
            $conn->close();

        } catch (Exception $e) {
            // En caso de un error, tomar la exepcion
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
    }
    
        
    
   
    // $respuesta = array(
    //     'estado' => 'correcto',
    //     'usuarios' => $cantidadUsuarios,
    //     'cuadrilla' => $cuadrilla,
    //     'idActividad' => $idActividad,
    //     'ost' => $ost,
    //     'siga' => $siga,
    //     'numServicio' => $numServicio,
    //     'cantidad' => $cantidad,
    //     'total' => $total,
    //     'observaciones' => $observaciones,
    //     'idRegistrador' => $idRegistrador,
    //     'tipo' => $tipo,
    //     'fecha-hora'=> $fechaHora
    // );

    echo json_encode($grupo);
}

// Formatear fecha y hora definida
// $formato = 'Y-m-d H:i:s';
// $fecha = DateTime::createFromFormat($formato, '2009-02-15 15:16:17');
// echo "Formato: $formato; " . $fecha->format('Y-m-d H:i:s') . "\n";