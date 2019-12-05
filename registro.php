<?php
     include 'inc/funciones/funciones.php';
     include 'inc/templates/header.php';
     include 'inc/templates/sidebar.php';
?>

    <section id="content-wrapper">
          <div class="row mx-0">
               <div class="col-lg-12">
                    <div class="row justify-content-center border-bottom">
                        <h3>Asignar Actividades</h3>     
                    </div>

                    <div class="row pt-4 justify-content-center">                                       
                        <form>
                            <div class="custom-control custom-checkbox border-bottom mb-3">
                              <input type="checkbox" class="custom-control-input" id="checkCuadrilla">
                              <label class="custom-control-label" for="checkCuadrilla">Hacer cuadrilla</label>
                            </div>
                            <div id="busquedaIndividual" class="form-row bg-light">
                                <div class="form-group col-md-5">
                                    <label for="codigo">Código</label>
                                    <input type="text" class="form-control" id="codigo">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="cedula">Cédula</label>
                                    <input type="text" class="form-control" id="cedula">
                                </div>
                                <div class="form-group col-md-2 d-flex align-items-end flex-row-reverse">
                                    <button type="button" id="btnBuscar" class="btn btn-primary">Buscar</button>                                                       
                                </div>
                            </div>
                            <div id="muestraIndividual" class="form-row bg-light">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Técnico</label>
                                    <input type="text" class="form-control" id="nombre" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="area">Área</label>
                                    <input type="text" class="form-control" id="area" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="zona">Zona</label>
                                    <input type="text" class="form-control" id="zona" readonly>
                                </div>
                            </div>
                            <div id="muestraCuadrilla" class="form-row d-none bg-light">
                                <div class="form-group col-md-3">
                                    <label for="exampleFormControlSelect1">Zonas</label>
                                    <?php
                                        $zonas = obtenerZonas();
                                        if($zonas) { ?>
                                            <select class="form-control" id="ddlZonas">
                                                <?php
                                                    foreach($zonas as $zona) { ?>
                                                        <option value="<?php echo $zona['id_Zona']?>"><?php echo $zona['nombre_Zona']?></option>
                                                    <?php } ?>                        
                                            </select>
                                        <?php } ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exampleFormControlSelect1">Áreas</label>
                                    <?php
                                        $areas = obtenerAreas();
                                        if($areas) { ?>
                                            <select class="form-control" id="ddlAreas">
                                                <?php
                                                    foreach($areas as $area) { ?>
                                                        <option value="<?php echo $area['id_Area']?>"><?php echo $area['nombre_Area']?></option>
                                                    <?php } ?>                        
                                            </select>
                                        <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlSelect1">Empleado</label>
                                    <?php
                                        $usuarios = obtenerUsuarios();
                                        if($usuarios) { ?>
                                            <select class="form-control" id="ddlAreas">
                                                <?php
                                                    foreach($usuarios as $usuario) { ?>
                                                        <option value="<?php echo $usuario['cedula']?>"><?php echo   $usuario['apellido1'] . ' ' . $usuario['apellido1'] . ' ' . $usuario['nombre1'] . ' ' . $usuario['nombre2']?></option>
                                                    <?php } ?>                        
                                            </select>
                                        <?php } ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Actividades</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Actividad 1</option>
                                    <option>Actividad 2</option>
                                    <option>Actividad 3</option>
                                    <option>Actividad 4</option>
                                    <option>Actividad 5</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="OST">OST</label>
                                    <input type="text" class="form-control" id="OST">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="SIGA">SIGA</label>
                                    <input type="text" class="form-control" id="SIGA">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="NumServicio"># Servicio</label>
                                    <input type="text" class="form-control" id="NumServicio">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="text" class="form-control" id="cantidad" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" id="observaciones" rows="2"></textarea>
                            </div>
                            <div class="form-row align-items-end">
                                <div class="form-group col-md-8">
                                    <label for="registra">Registra</label>
                                    <input type="text" class="form-control" id="registra" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <!-- <label for="fecha"></label> -->
                                    <input type="text" class="form-control" id="fecha" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <!-- <label for="fecha"></label> -->
                                    <input type="text" class="form-control" id="hora" readonly>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
          </div>
     </section>

<?php
  include 'inc/templates/footer.php';
?>