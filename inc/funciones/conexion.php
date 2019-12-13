<?php

    $conn = new mysqli('localhost', 'root', 'root', 'db_scaa');

    if($conn->connect_error){
        $respuesta = array(
            'conexion' => 'Error de conexión: ' . $conn->connect_error
        );
        echo json_encode($respuesta);
        die();
    }
    $conn->set_charset('utf8');


