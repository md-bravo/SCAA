<?php
    include 'inc/funciones/sesiones.php';
     include 'inc/funciones/funciones.php';
     include 'inc/templates/header.php';
     include 'inc/templates/sidebar.php';
?>

<section id="content-wrapper" class="pt-0">
    <div class="row mx-0">
        <div class="col-lg-12">
            <div class="row justify-content-center border-bottom">
                    <h4>Reportes</h4>     
            </div>
            
            <div id="filtros" class="border-bottom pt-3 row">
                <form class="form-inline" id="formulario-reporte" method="post">
                    <label class="sr-only" for="fechaInicio">De</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">De</div>
                        </div>
                        <input type="date" class="form-control" id="fechaInicio">
                    </div>

                    <label class="sr-only" for="fechaFin">Hasta</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Hasta</div>
                        </div>
                        <input type="date" class="form-control" id="fechaFin">
                    </div>

                    <button type="submit" id="btnGenerar" class="btn btn-primary mb-2">Generar</button>
                </form>
            </div>
            
            <div class="table-responsive">
            <table hidden id="tablaReporte" class="display" style="width:100%">
                    <thead>
                        <tr>                            
                            <th>Consecutivo</th>
                            <th>OST</th>
                            <th>SIGA</th>
                            <th>Servicio</th>
                            <th>Cantidad</th>
                            <th>Peso Total</th>
                            <th>Actividad</th>                          
                            <th>Observaciones</th>
                            <th>Fecha/Hora Apertura</th>
                            <th>Fecha/Hora Cierre</th>
                            <th>Tiempo Total</th>>
                            <th>Asignado a</th>
                            <th>Asignado por</th>
                            <th>Cerrado por</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Consecutivo</th>
                            <th>OST</th>
                            <th>SIGA</th>
                            <th>Servicio</th>
                            <th>Cantidad</th>
                            <th>Peso Total</th>
                            <th>Actividad</th>                          
                            <th>Observaciones</th>
                            <th>Fecha/Hora Apertura</th>
                            <th>Fecha/Hora Cierre</th>
                            <th>Tiempo Total</th>>
                            <th>Asignado a</th>
                            <th>Asignado por</th>
                            <th>Cerrado por</th>
                        </tr>
                    </tfoot>
            </table>
            </div>
        </div>
    </div>
</section>

<?php
  include 'inc/templates/footer.php';
?>