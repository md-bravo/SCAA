<?php
    session_start();
    include 'inc/funciones/funciones.php';

    if(isset($_GET['cerrar_session'])) {
        $_SESSION = array();
    }
?>
<!doctype html>
<html lang="en">

<head>
     <!-- Meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
     <link rel="icon" href="img/favicon.ico" type="image/x-icon">
     <!-- CSS -->
     <link rel="stylesheet" type="text/css" href="css/vendor/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="css/vendor/sweetalert2.min.css">
     <link rel="stylesheet" type="text/css" href="css/all.min.css">
     <link rel="stylesheet" type="text/css" href="css/style.css">

     <title>SCAA - DGEAS</title>
</head>

<body class="<?php echo obtenerPaginaActual(); ?>">

<div class="container container-login h-100">
    <div class="row h-100 align-items-center justify-content-center">
            <div class="contenido bg-light p-4">
                <h2 class="titulo-login text-center py-2 rounded">SCAA - Empresa</h2>       

                <form id="formulario-login" class="mt-5" method="post">
                    <div class="form-group row">
                        <label for="usuario" class="col-sm-3 col-form-label">Cédula: </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="usuario" id="usuario" placeholder="Ingrese su Cédula" maxlength="9" autofocus required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password: </label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese su Contraseña" required>
                        </div>
                    </div>
                        
                    <div class="form-group mb-0 mt-5">
                        <div class="d-flex">
                            <input type="hidden" id="tipo" value="login">
                            <div class="flex-grow-1 bd-highlight text-center">
                                <input type="submit" name="sub" id="sub" class="btn-login btn btn-primary" value="Iniciar Sesión">
                            </div>
                        </div>
                    </div>                            
                </form>
            </div>
    </div>
</div>


<?php
  include 'inc/templates/footer.php';
?>