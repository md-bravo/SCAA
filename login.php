<?php
    include 'inc/funciones/funciones.php';
    include 'inc/templates/header.php';
?>

<div class="container container-login h-100">
    <div class="row h-100 align-items-center justify-content-center">
            <div class="contenido bg-light p-4">
                <h2 class="titulo-login text-center py-2 rounded">SCAA - DGEAS</h2>       

                <form id="formulario-login" class="mt-5" method="post">
                    <div class="form-group row">
                        <label for="usuario" class="col-sm-3 col-form-label">Cédula: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese su Cédula" maxlength="9" autofocus required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="password" id="password" placeholder="Ingrese su Contraseña" required>
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