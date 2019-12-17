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
                         <h3>Actividades Asignadas</h3>     
                    </div>
                    
                    <table id="tablaRegistros" class="table table-striped table-bordered" style="width:100%">
                         <thead>
                              <tr>
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
          <div class="modal fade" id="modalCerrarReg" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalCerrarReg" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
               <div class="modal-header">
               <h5 class="modal-title" id="modalCerrarRegTitle"></h5>
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
                         <label for="actividad" class="col-sm-2 col-form-label">Actividad</label>
                         <div class="col-sm-10">
                              <input type="text" readonly class="form-control" id="actividad">
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                         <div class="col-sm-4">
                              <input type="number" class="form-control" id="cantidad">
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
               </form>
               </div>
               <div class="modal-footer">
               <input type="hidden" id="tipo" value="cerrarReg">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               <button type="button" id="btnGuardarReg" class="btn btn-primary">Guardar</button>
               </div>
          </div>
          </div>
          </div>
     </section>
</div>


<?php
  include 'inc/templates/footer.php';
?>