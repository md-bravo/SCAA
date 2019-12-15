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

                    <!-- <table id="example" class="display" style="width:100%">
                         <thead>
                              <tr>
                                   <th hidden=true>ID</th>
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
                                   <th>G</th>
                                   <th hidden=true>ID Grupo</th>
                              </tr>
                         </thead>
                         <?php $listaRegistros = obtenerListaRegistros();
                         
                         if($listaRegistros) { ?>
                              <tbody>
                                   <?php foreach($listaRegistros as $registro) { ?>
                                        <tr>
                                             <td hidden=true><?php echo $registro['id_Reg_Act'] ?></td>
                                             <td><?php echo $registro['consecutivo'] ?></td>
                                             <td><?php echo $registro['OST'] ?></td>
                                             <td><?php echo $registro['SIGA'] ?></td>
                                             <td><?php echo $registro['numero_servicio'] ?></td>
                                             <td><?php echo $registro['nombre_Act'] ?></td>
                                             <td><?php echo $registro['cantidad_eventos'] ?></td>
                                             <td><?php echo $registro['peso_total'] ?></td>
                                             <td><?php echo $registro['fecha_hora_apertura'] ?></td>
                                             <td><?php echo $registro['nombre1'] . ' ' . $registro['nombre2'] . ' ' . $registro['apellido1'] . ' ' . $registro['apellido2'] ?></td>
                                             <td><?php echo $registro['detalle'] ?></td>
                                             <?php if($registro['id_Grupo_Reg']) {?>
                                                  <td>S</td>
                                             <?php } else { ?>
                                                  <td></td>
                                             <?php } ?>
                                             <td hidden=true><?php echo $registro['id_Grupo_Reg'] ?></td>
                                        </tr>
                                   <?php } ?>
                              </tbody>
                         <?php } ?>
                         <tfoot>
                              <tr>
                                   <th hidden=true>ID</th>
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
                                   <th>G</th>
                                   <th hidden=true>ID Grupo</th>
                              </tr>
                         </tfoot>
                    </table> -->
               </div>
          </div>
     </section>
</div>


<?php
  include 'inc/templates/footer.php';
?>