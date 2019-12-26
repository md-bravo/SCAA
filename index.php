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
                         <h3>Actividades Asignadas</h3>     
                    </div>
                    
                    <table id="tablaRegistros" class="display" style="width:100%">
                         <thead>
                              <tr>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th>ID</th>
                                   <th>Consecutivo</th>
                                   <th>OST</th>
                                   <th>SIGA</th>
                                   <th>Servicio</th>
                                   <th>Actividad</th>
                                   <th>Cantidad</th>
                                   <th>Peso Total</th>
                                   <th>Fecha/Hora Apertura</th>
                                   <th>Asignado a</th>
                                   <th>Observaciones</th>
                                   <th>ID Grupo</th>
                              </tr>
                         </thead>
                         <tfoot>
                              <tr>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th>ID</th>
                                   <th>Consecutivo</th>
                                   <th>OST</th>
                                   <th>SIGA</th>
                                   <th>Servicio</th>
                                   <th>Actividad</th>
                                   <th>Cantidad</th>
                                   <th>Peso Total</th>
                                   <th>Fecha/Hora Apertura</th>
                                   <th>Asignado a</th>
                                   <th>Observaciones</th>                                   
                                   <th>ID Grupo</th>
                              </tr>
                         </tfoot>
                    </table>

               </div>
          </div>


          <!-- Modal -->
          <div class="modal fade" id="modalAccionesReg" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalAccionesReg" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
               <div class="modal-header" id="divModalHeader">
                    <h5 class="modal-title" id="modalAccionesRegTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <form>
                         <div class="form-group row">
                              <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                              <div class="col-sm-10">
                                   <input type="text" readonly class="form-control" id="nombre">
                              </div>
                         </div>

                         <div class="form-group row">
                              <label for="ddlActividades" class="col-sm-2 col-form-label">Actividad</label>
                              <div class="input-group col-sm-10">
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
                                   <div class="input-group-prepend">
                                        <div id="pesoAct" class="input-group-text"></div>
                                   </div>
                              </div>

                         </div> 

                         <div class="form-group row">
                              <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                              <div class=" input-group col-sm-4">
                                   <input type="text" class="form-control" id="cantidad">
                                   <div class="input-group-prepend">
                                        <div id="total" class="input-group-text">0.00</div>
                                   </div> 
                              </div>
                              <label for="ost" class="col-sm-2 col-form-label">OST</label>
                              <div class="col-sm-4">
                                   <input type="number" class="form-control" id="ost">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="siga" class="col-sm-2 col-form-label">SIGA</label>
                              <div class="col-sm-4">
                                   <input type="number" class="form-control" id="siga">
                              </div>
                              <label for="servicio" class="col-sm-2 col-form-label"># Servicio</label>
                              <div class="col-sm-4">
                                   <input type="number" class="form-control" id="servicio">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="observaciones" class="col-sm-2 col-form-label">Observaciones</label>
                              <div class="col-sm-10">
                                   <textarea class="form-control" maxlength="100" name="observaciones" id="observaciones" rows="2"></textarea>
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="fecha-hora" class="col-sm-3 col-form-label">Fecha/Hora Apertura</label>
                              <div class="col-sm-6">
                                   <input type="text" readonly class="form-control" id="fecha-hora">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="fecha-hora-cierre" class="col-sm-3 col-form-label">Fecha/Hora Cierre</label>
                              <div class="col-sm-3">
                                   <input type="text" class="form-control" id="fecha" readonly>
                              </div>
                              <div class="col-sm-3">
                                   <input type="text" class="form-control" id="hora" readonly>
                              </div>
                         </div>
                         <div class="form-group row" id="divRelacionados">
                              <label for="relacionados" class="col-sm-3 col-form-label"></label>
                              <div class="col-sm-6">
                                   <input type="text" readonly class="form-control" id="relacionados">
                              </div>
                         </div>
                         <fieldset class="form-group d-none" id="opcionesBorrar">
                              <div class="row">
                                   <legend class="col-form-label col-sm-3 pt-0">Cerrar</legend>
                                   <div class="col-sm-9">
                                        <div class="form-check">
                                             <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                                             <label class="form-check-label" for="gridRadios1">
                                             Solo el actual
                                             </label>
                                        </div>
                                        <div class="form-check">
                                             <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2" checked>
                                             <label class="form-check-label" for="gridRadios2">
                                             Todos los asociados
                                             </label>
                                        </div>
                                   </div>
                              </div>
                         </fieldset>
                    </form>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnAccionReg" class="btn btn-primary">Guardar</button>
               </div>
          </div>
          </div>
          </div>

     </section>
</div>


<?php
  include 'inc/templates/footer.php';
?>