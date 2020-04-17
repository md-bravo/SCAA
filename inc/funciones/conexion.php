<?php

    $conn = new mysqli('localhost', 'root', 'root', 'db_scaa');

    //$conn = new mysqli('localhost', 'macbb_root', '123root456', 'macbb__p_scaa');

    if($conn->connect_error){
        $respuesta = array(
            'conexion' => 'Error de conexión: ' . $conn->connect_error
        );
        echo json_encode($respuesta);
        die();
    }
    $conn->set_charset('utf8');


