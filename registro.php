<?php
     include 'inc/funciones/sesiones.php';
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

                    <div class="row pb-3 pt-4 justify-content-center">                                       
                        <form id="formulario-registro">
                            <div class="form-row border-bottom mb-3">
                                <div class="custom-control custom-checkbox ml-1">
                                    <input type="checkbox" class="custom-control-input" id="checkCuadrilla">
                                    <label class="custom-control-label" for="checkCuadrilla">Hacer cuadrilla</label>
                                </div>
                                <div id="checkBuscar" class="custom-control custom-checkbox ml-3">
                                    <input type="checkbox" class="custom-control-input" id="checkBuscarNombre">
                                    <label class="custom-control-label" for="checkBuscarNombre">Buscar por Nombre</label>
                                </div>
                            </div>
                            <div id="busquedaIndividual" class="form-row bg-light pt-3">
                                <div class="form-group col-md-5">
                                    <label class="sr-only" for="registra">Código</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Código</div>
                                        </div>
                                        <input type="number" class="form-control" id="codigo">
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="sr-only" for="registra">Cédula</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Cédula</div>
                                        </div>
                                        <input type="number" class="form-control" id="cedula">
                                    </div>
                                </div>
                                <div class="form-group col-md-2 d-flex align-items-end flex-row-reverse">
                                    <input type="hidden" id="tipoBuscar" value="buscar">
                                    <button type="submit" id="btnBuscar" class="btn btn-primary btn-block">Buscar</button>
                                </div>
                            </div>
                            <div id="muestraIndividual" class="form-row bg-light">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="id" hidden readonly>
                                    <input type="text" class="form-control" id="nombre" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control" id="area" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control" id="zona" readonly>
                                </div>
                            </div>
                        
                            <div id="buscaNombre" class="form-row bg-light">
                                <div class="form-group col-md-3">
                                    <label class="sr-only" for="registra">Zonas</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Zonas</div>
                                        </div>
                                        <?php
                                        $zonas = obtenerZonas();
                                        if($zonas) { ?>
                                            <select disabled class="form-control" id="ddlZonas">
                                                <option value="0">Todas</option>
                                                <?php
                                                    foreach($zonas as $zona) { ?>
                                                        <option value="<?php echo $zona['id_Zona']?>"><?php echo $zona['nombre_Zona']?></option>
                                                    <?php } ?>                        
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="sr-only" for="registra">Áreas</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Áreas</div>
                                        </div>
                                        <?php
                                        $areas = obtenerAreas();
                                        if($areas) { ?>
                                            <select disabled class="form-control" id="ddlAreas">
                                            <option value="0">Todas</option>
                                                <?php
                                                    foreach($areas as $area) { ?>
                                                        <option value="<?php echo $area['id_Area']?>"><?php echo $area['nombre_Area']?></option>
                                                    <?php } ?>                        
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="sr-only" for="registra">Usuario</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Usuario</div>
                                        </div>
                                        <?php
                                        $usuarios = obtenerUsuarios();
                                        if($usuarios) { ?>
                                            <select disabled class="form-control selectpicker" data-live-search="true" id="ddlUsuarios" title="Seleccione">                                                
                                                <?php
                                                    foreach($usuarios as $usuario) { ?>
                                                        <option data-icon="far fa-user" value="<?php echo $usuario['cedula']?>"><?php echo ' - '.  $usuario['apellido1'] . ' ' . $usuario['apellido2'] . ' ' . $usuario['nombre1'] . ' ' . $usuario['nombre2']?></option>
                                                    <?php } ?>                        
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div id="muestraCuadrilla" class="form-row bg-light d-none py-3">
                                <div class="form-group col-md-11">
                                    <label class="pb-2" for="ddlCuadrilla">Seleccione los miembros de la cuadrilla</label>
                                    <?php
                                        if($usuarios) { ?>
                                            <select class="form-control selectpicker" multiple data-selected-text-format="count > 3" data-live-search="true"  id="ddlCuadrilla" title="Seleccione">                                                
                                                <?php
                                                    foreach($usuarios as $usuario) { ?>
                                                        <option data-icon="far fa-user" value="<?php echo $usuario['cedula']?>"><?php echo ' - ' . $usuario['apellido1'] . ' ' . $usuario['apellido2'] . ' ' . $usuario['nombre1'] . ' ' . $usuario['nombre2']?></option>
                                                    <?php } ?>                        
                                            </select>
                                        <?php } ?>
                                </div>
                                <div class="form-group col-md-1 d-flex align-items-end flex-row-reverse">
                                    <button type="button" id="btnLimpiar" class="btn btn-primary"><i class="fas fa-undo-alt"></i></button>
                                </div>
                            </div>


                            <div class="form-row mt-4 pt-3 bg-light">
                                <div class="form-group col-md-2">
                                    <label for="ddlAreasAct">Áreas</label>
                                    <?php                                        
                                        if($areas) { ?>
                                            <select class="form-control" id="ddlAreasAct">
                                            <option value="0">Todas</option>
                                                <?php
                                                    foreach($areas as $area) { ?>
                                                        <option value="<?php echo $area['id_Area']?>"><?php echo $area['nombre_Area']?></option>
                                                    <?php } ?>                        
                                            </select>
                                        <?php } ?>
                                </div>
                                                      
                                <div class="form-group col-md-9">
                                    <label for="ddlActividades">Actividades</label>
                                    <?php
                                        $actividades = obtenerActividades();
                                        if($actividades) { ?>
                                            <select class="form-control selectpicker" data-live-search="true"  id="ddlActividades" title="Seleccione">                                                
                                                <?php
                                                    foreach($actividades as $actividad) { ?>
                                                        <option data-icon="far fa-check-square" value="<?php echo $actividad['id_Act']?>" id="<?php echo $actividad['peso_Act']?>"><?php echo ' - '.  $actividad['nombre_Act']?></option>
                                                    <?php } ?>                        
                                            </select>
                                        <?php } ?>
                                </div>

                                <div class="form-group col-md-1">
                                    <label for="pesoAct">Peso</label>
                                    <input disabled type="text" class="form-control" id="pesoAct">
                                </div>
                            </div> 

                            <div class="form-row bg-light pt-3">
                                <div class="form-group col-md-3">
                                    <label for="OST">OST</label>
                                    <input type="number" class="form-control" id="OST">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="SIGA">SIGA</label>
                                    <input type="number" class="form-control" id="SIGA">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="NumServicio"># Servicio</label>
                                    <input type="number" class="form-control" id="NumServicio">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="cantidad">Cantidad</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" id="cantidad">
                                        <div class="input-group-prepend">
                                            <div id="total" class="input-group-text">0.00</div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label class="sr-only" for="registra">Observaciones</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">Observaciones</div>
                                    </div>
                                    <textarea class="form-control" id="observaciones" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="form-row align-items-end">
                                <div class="form-group col-md-8">
                                    <label class="sr-only" for="registra">Registra</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text font-weight-bold">Registra</div>
                                        </div>
                                        <input type="text" class="form-control" id="registra" readonly value="<?php echo $_SESSION['nombre']?>">
                                    </div>
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
                            <div class="form-row d-flex justify-content-center">
                                <input type="hidden" id="tipoRegistrar" value="registrar">
                                <button type="button" class="btn btn-lg btn-primary" id="btnGuardar">Guardar</button>
                            </div>
                        </form>

                        <table id="tablaUsuarios" class="d-none">
                        <thead>
                            <tr>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>id_Zona</th>
                                <th>id_Area</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($usuarios) { 
                                foreach($usuarios as $usuario) { ?>
                                    <tr>
                                    <td><?php echo $usuario['cedula']?></td>
                                    <td><?php echo   $usuario['apellido1'] . ' ' . $usuario['apellido2'] . ' ' . $usuario['nombre1'] . ' ' . $usuario['nombre2']?></td>
                                    <td><?php echo $usuario['id_Zona']?></td>
                                    <td><?php echo $usuario['id_Area']?></td>  
                                    </tr>                                     
                                <?php }                       
                            } ?>
                        </tbody>
                        </table>

                        <table id="tablaActividades" class="d-none">
                        <thead>
                            <tr>
                                <th>id_Act</th>
                                <th>nomre_Act</th>
                                <th>peso_Act</th>
                                <th>id_Area</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // $actividades = obtenerActividades();
                            if($actividades) { 
                                foreach($actividades as $actividad) { ?>
                                    <tr>
                                    <td><?php echo $actividad['id_Act']?></td>
                                    <td><?php echo $actividad['nombre_Act']?></td>
                                    <td><?php echo $actividad['peso_Act']?></td>
                                    <td><?php echo $actividad['id_Area']?></td>  
                                    </tr>                                     
                                <?php }                       
                            } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
          </div>
     </section>

<?php
  include 'inc/templates/footer.php';
?>