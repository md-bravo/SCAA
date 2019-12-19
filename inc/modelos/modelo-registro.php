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
if (isset($_POST['pesoTotal'])) {
    $pesoTotal = filter_var($_POST['pesoTotal'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['observaciones'])) {
    $observaciones = filter_var($_POST['observaciones'], FILTER_SANITIZE_STRING);
    if($observaciones === ''){
        $observaciones = NULL;
    }
}
if (isset($_POST['idGrupo'])) {
    $idGrupo = filter_var($_POST['idGrupo'], FILTER_SANITIZE_STRING);
    if($idGrupo === "null"){
        $idGrupo = NULL;
    }
}
if (isset($_POST['id_Reg'])) {
    $id_Reg = filter_var($_POST['id_Reg'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['idRegistrador'])) {
    $idRegistrador = filter_var($_POST['idRegistrador'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['fecha_hora_apertura'])) {
    $fecha_hora_apertura = ($_POST['fecha_hora_apertura']);
    // $fecha_hora_apertura = new DateTime($_POST['fecha_hora_apertura']);
}



// importar la conexion
include '../funciones/conexion.php';

date_default_timezone_set('America/Costa_Rica');

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

    $fechaHora = Date('Y/m/d H:i:s');

    // Consultar los estados disponibles, para conocer su id
    $stmt = $conn->prepare("SELECT * FROM estados_reg_act");
    $stmt->execute();
    $stmt->bind_result($id_Estado, $estado_Reg_Act);
    
    while ($stmt->fetch()) {
        if($estado_Reg_Act === "Abierto"){
            $id_Estado_Reg_Act = $id_Estado;
        }
    }
    $stmt->close();


    $listaUsuarios = explode(",", $usuarios);
    $cantidadUsuarios = count($listaUsuarios);

    if($cantidadUsuarios === 1){
        try {
            $stmt = $conn->prepare("INSERT INTO reg_act (OST, SIGA, cantidad_eventos, numero_servicio, detalle, fecha_hora_apertura, usuario_asignado, peso_total, usuario_asignador, id_Act, id_Estado_Reg_Act) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");   
            $stmt->bind_param('sssssssssss', $ost, $siga, $cantidad, $numServicio, $observaciones, $fechaHora, $usuarios, $pesoTotal ,$idRegistrador, $idActividad, $id_Estado_Reg_Act);
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
                    $stmt = $conn->prepare("INSERT INTO reg_act (OST, SIGA, cantidad_eventos, numero_servicio, detalle, fecha_hora_apertura, usuario_asignado, peso_total, usuario_asignador, id_Act, id_Estado_Reg_Act) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");   
                    $stmt->bind_param('sssssssssss', $ost, $siga, $cantidad, $numServicio, $observaciones, $fechaHora, $usuario, $pesoTotal, $idRegistrador, $idActividad, $id_Estado_Reg_Act);
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

            // Crea un grupo e inserta los registros que lo conforman
            if(count($grupo > 0)){
                $grupoJSON = json_encode($grupo);
                $stmt = $conn->prepare("INSERT INTO reg_act_agrupados (consecutivos) VALUES (?) ");  
                $stmt->bind_param('s', $grupoJSON);
                $stmt->execute();
    
                if($stmt->affected_rows > 0) {
                    $id_grupo = $stmt->insert_id;
                }
    
                $stmt->close();
            }
            

            // El ID del grupo creado se asocia a cada registro que lo conforma
            if($id_grupo){
                foreach ($grupo as $registro){
                    $stmt = $conn->prepare("UPDATE reg_act SET id_Grupo_Reg = ? WHERE id_Reg_Act = $registro ");  
                    $stmt->bind_param('s', $id_grupo);
                    $stmt->execute();
                }
                $stmt->close();
            }
            $conn->close();

        } catch (Exception $e) {
            // En caso de un error, tomar la exepcion
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
    }

    echo json_encode($respuesta);
}

if($tipo === 'cerrarReg'){

    $fecha_hora_cierre = Date('Y/m/d H:i:s');
    $tiempoTotal = tiempoTranscurridoFechas($fecha_hora_apertura, $fecha_hora_cierre);
    $grupo = NULL;

    try {

        // Consultar los estados disponibles, para conocer su id
        $stmt = $conn->prepare("SELECT * FROM estados_reg_act");
        $stmt->execute();
        $stmt->bind_result($id_Estado, $estado_Reg_Act);
        
        while ($stmt->fetch()) {
            if($estado_Reg_Act === "Cerrado"){
                $id_Estado_Reg_Act = $id_Estado;
            }
        }
        $stmt->close();


        $listaRegistros = explode(",", $id_Reg);

        try {
            foreach ($listaRegistros as $registro) {
                $stmt = $conn->prepare("UPDATE reg_act SET OST = ?, SIGA = ?, cantidad_eventos = ?, numero_servicio = ?, detalle = ?, fecha_hora_cierre = ?, tiempo_total = ?, peso_total = ?, usuario_cierra = ?, id_Estado_Reg_Act = ?, id_Grupo_Reg = ? WHERE id_Reg_Act = ? ");  
                $stmt->bind_param('ssssssssssss', $ost, $siga, $cantidad, $numServicio, $observaciones, $fecha_hora_cierre, $tiempoTotal, $pesoTotal, $idRegistrador, $id_Estado_Reg_Act, $grupo, $registro);
                $stmt->execute();
            }

            if($stmt->affected_rows > 0) {
                $respuesta = array(
                    'estado' => 'correcto'
                    // 'idReg' => $id_Reg,
                    // 'ost' => $ost,
                    // 'siga' => $siga,
                    // 'servicio' => $numServicio,
                    // 'cantidad' => $cantidad,
                    // 'pesoTotal' => $pesoTotal,
                    // 'detalle' => $observaciones,
                    // 'fechaApertura' => $fecha_hora_apertura,
                    // 'idGrupo' => $idGrupo,
                    // 'tipo' => $tipo,
                    // 'idRegistrador' => $idRegistrador,
                    // 'listaReg' => $listaRegistros,
                    // 'idEstado' => $id_Estado_Reg_Act,
                    // 'tiempototal' => $tiempoTotal,
                    // 'cierre' => $fecha_hora_cierre
                );
            }

            $stmt->close();

            if($idGrupo != NULL){
                $stmt = $conn->prepare("DELETE FROM reg_act_agrupados WHERE id_Grupo_Reg = ? ");  
                $stmt->bind_param('s', $idGrupo);
                $stmt->execute();
                $stmt->close();
            }

            $conn->close();
            

        } catch (Exception $e) {
            // En caso de un error, tomar la exepcion
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }



    } catch (Exception $e) {
        // En caso de un error, tomar la exepcion
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }

    // $respuesta = array(
    //     'estado' => 'correcto'
    // );
    
    echo json_encode($respuesta);
}

// Calcular el tiempo transcurrido entre fechas
function tiempoTranscurridoFechas($fechaInicio, $fechaFin)
{
    $fecha1 = new DateTime($fechaInicio);
    $fecha2 = new DateTime($fechFin);
    $fecha = $fecha1->diff($fecha2);
    $tiempo = "";
         
    //años
    if($fecha->y > 0)
    {
        $tiempo .= $fecha->y;
             
        if($fecha->y == 1)
            $tiempo .= " año, ";
        else
            $tiempo .= " años, ";
    }
         
    //meses
    if($fecha->m > 0)
    {
        $tiempo .= $fecha->m;
             
        if($fecha->m == 1)
            $tiempo .= " mes, ";
        else
            $tiempo .= " meses, ";
    }
         
    //dias
    if($fecha->d > 0)
    {
        $tiempo .= $fecha->d;
             
        if($fecha->d == 1)
            $tiempo .= " día, ";
        else
            $tiempo .= " días, ";
    }
         
    //horas
    if($fecha->h > 0)
    {
        $tiempo .= $fecha->h;
             
        if($fecha->h == 1)
            $tiempo .= " hora, ";
        else
            $tiempo .= " horas, ";
    }
         
    //minutos
    if($fecha->i > 0)
    {
        $tiempo .= $fecha->i;
             
        if($fecha->i == 1)
            $tiempo .= " minuto";
        else
            $tiempo .= " minutos";
    }
    else if($fecha->i == 0) //segundos
        $tiempo .= $fecha->s." segundos";
         
    return $tiempo;
}

// Formatear fecha y hora definida
// $formato = 'Y-m-d H:i:s';
// $fecha = DateTime::createFromFormat($formato, '2009-02-15 15:16:17');
// echo "Formato: $formato; " . $fecha->format('Y-m-d H:i:s') . "\n";