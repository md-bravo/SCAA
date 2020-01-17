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
            
            <div id="filtros" class="border-bottom pt-3 ">
                <form id="formulario-reporte" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="fechaInicio">De</label>
                            <input type="date" class="form-control form-control-sm" id="fechaInicio">                        
                        </div>
                        <div class="form-group col-md-2">
                            <label for="fechaFin">Hasta</label>
                            <input type="date" class="form-control form-control-sm" id="fechaFin">                        
                        </div>
                        <div class="form-group col-md-2">
                            <label for="zonas">Zonas</label>
                            <?php
                                $zonas = obtenerZonas();
                                if($zonas) { ?>
                                    <select class="form-control form-control-sm" id="ddlZonas">
                                        <option value="0">Todas</option>
                                        <?php
                                            foreach($zonas as $zona) { ?>
                                                <option value="<?php echo $zona['id_Zona']?>"><?php echo $zona['nombre_Zona']?></option>
                                            <?php } ?>                        
                                    </select>
                                <?php } ?>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="areas">Areas</label>
                            <?php
                                $areas = obtenerAreas();
                                if($areas) { ?>
                                    <select class="form-control form-control-sm" id="ddlAreas">
                                    <option value="0">Todas</option>
                                        <?php
                                            foreach($areas as $area) { ?>
                                                <option value="<?php echo $area['id_Area']?>"><?php echo $area['nombre_Area']?></option>
                                            <?php } ?>                        
                                    </select>
                                <?php } ?>                     
                        </div>
                        <div class="form-group col-md-2">
                            <label for="cedula">Cédula</label>
                            <input type="number" class="form-control form-control-sm" id="cedula">                        
                        </div>
                        <div class="form-group col-md-2 d-flex align-items-end">                        
                            <button type="submit" id="btnGenerar" class="btn btn-sm btn-primary">Generar</button>
                        </div>
                    </div>

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
                                <th>Tiempo Total</th>
                                <th>Asignado a</th>
                                <th>Asignado por</th>
                                <th>Cerrado por</th>
                            </tr>
                        </thead>
                </table>
            </div>
            
        </div><!--.col-lg-12 -->
    </div><!--.row-->
</section>

<?php
  include 'inc/templates/footer.php';
?>