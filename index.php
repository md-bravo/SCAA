<?php
     require 'inc/templates/header.php';
?>

<body>
     <div id="wrapper">
          <div id="navbar-wrapper">
               <nav class="navbar fixed-top">
                    <div class="container-fluid d-flex justify-content-between pl-0 pr-0">
                         <div>
                              <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fas fa-bars fa-lg"></i></a>
                         </div>
                         <div>
                              <span class="navbar-text titulo-largo">
                                   Sistema de Control y Asignación de Actividades - DGEAS
                              </span>
                              <span class="navbar-text titulo-corto">
                                   SCAA - DGEAS
                              </span>
                         </div>
                         <div>
                              <img src="img/logo-ice.png" class="logo img-fluid" alt="logo-ice">
                         </div>

                    </div>
               </nav>
          </div>

          <aside id="sidebar-wrapper">
               <div class="sidebar-brand">
                    
               </div>
               <ul class="sidebar-nav">
                    <li class="active">
                         <a href="#"><i class="fas fa-home"></i>Dashboard</a>
                    </li>
                    <li>
                         <a href="#"><i class="fas fa-edit"></i>Registros</a>
                    </li>
                    <li>
                         <a href="#"><i class="fas fa-sign-out-alt"></i>Salir</a>
                    </li>
               </ul>
          </aside>

          <section id="content-wrapper">
               <div class="row">
                    <div class="col-lg-12">
                         <h2 class="content-title">Test</h2>
                         
                         <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia atque, sed animi dolor
                              odit magnam! Laudantium ad voluptatibus harum ducimus in corrupti, rerum modi mollitia
                              fuga? Expedita assumenda debitis aperiam?</h1>

                    </div>
               </div>
          </section>
     </div>


<?php
  require 'inc/templates/footer.php';
?>