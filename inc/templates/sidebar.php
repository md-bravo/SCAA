<aside id="sidebar-wrapper">
          <div class="sidebar-brand">
               <input type="hidden" name="idRegistrador" id="idRegistrador" value="<?php echo $_SESSION['usuario']?>">
               <input type="hidden" name="rolRegistrador" id="rolRegistrador" value="<?php echo $_SESSION['rol']?>">
               
               <div class="row">
                    <div class="col-4">
                         <a><i class="fas fa-user"></i></a>
                    </div>
                    <div class="col-8">
                         <span><?php echo $_SESSION['nombreCorto']?></span>
                    </div>
               </div>
               
          </div>           
          <ul class="sidebar-nav">
               <li>
                    <a href="index.php"><i class="fas fa-home"></i>Dashboard</a>
               </li>
               <li>
                    <a href="registro.php"><i class="fas fa-edit"></i>Registros</a>
               </li>
               <li>
                    <a href="reporte.php"><i class="fas fa-file-alt"></i>Reportes</a>
               </li>
               <li>
                    <a href="login.php?cerrar_session=true"><i class="fas fa-sign-out-alt"></i>Salir</a>
               </li>
          </ul> 
     </aside>