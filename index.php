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
                    
                    <table id="tablaRegistros" class="display" style="width:100%">
                         <thead>
                              <tr>
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
     </section>
</div>


<?php
  include 'inc/templates/footer.php';
?>