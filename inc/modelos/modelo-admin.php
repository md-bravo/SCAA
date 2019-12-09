<?php
session_start();

if (isset($_POST['usuario'])) {
    $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
}

if (isset($_POST['password'])) {
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
}


include '../funciones/conexion.php';
        
try {
    // Seleccionar usuario de la base de datos
    $stmt = $conn->prepare("SELECT cedula, nombre1, nombre2, apellido1, apellido2, password, estado_usuario.nombre_Estado, roles.nombre_Rol FROM usuarios INNER JOIN roles ON usuarios.id_Rol = roles.id_Rol INNER JOIN estado_usuario ON usuarios.id_Estado = estado_usuario.id_Estado WHERE cedula = ?");
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    // Loguear el usuario
    $stmt->bind_result($cedula, $nombre1, $nombre2, $apellido1, $apellido2, $pass_usuario, $estado, $rol);
    $stmt->fetch();

    if($cedula){

        // Verificar si se encuentra activo
        if($estado === "Inactivo"){
            
            $respuesta = array(
                'estado' => 'inactivo'
            );
        } elseif(password_verify($password, $pass_usuario)){ // El usuario existe, verificar el password

            // El usuario existe
            // Iniciar la sesion                
            $_SESSION['usuario'] = $cedula;
            $_SESSION['nombre'] = $nombre1 . ' ' . $nombre2 . ' ' . $apellido1 . ' ' . $apellido2;
            $_SESSION['nombreCorto'] = $nombre1 . ' ' . $apellido1;
            $_SESSION['rol'] = $rol;               
            $_SESSION['login'] = true;
            
            //Login correcto
            $respuesta = array(
                'estado' => 'correcto',
                'usuario' => $cedula,
                'nombre' => $nombre1 . ' ' . $nombre2 . ' ' . $apellido1 . ' ' . $apellido2,  
                'rol' => $rol
            );
                            
        } else{
            // Login incorrecto,enviar error
            $respuesta = array (
                'estado' => 'PasswordFail'
            );
        }

    } else {
        $respuesta = array(
            'estado' => 'NoExiste'
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