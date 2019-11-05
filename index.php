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
               <div class="sidebar-nav">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                         <a class="p-0 nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-home"></i>Dashboard</a>
                         <a class="p-0 nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-edit"></i>Registros</a>
                         <a class="p-0 nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-file-alt"></i>Reportes</a>
                         <a class="p-0 nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-sign-out-alt"></i>Salir</a>
                    </div>
               </div>
                  
          </aside>

          <section id="content-wrapper">
               <div class="row">
                    <div class="col-lg-12">
                         
                         <div class="tab-content" id="v-pills-tabContent">
                              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                   <h1>Tab 1</h1>     
                                   <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, sint commodi. Cum, voluptatem saepe maiores adipisci ullam culpa corrupti quas, assumenda error aliquam consequatur enim, sapiente inventore repudiandae nesciunt omnis.</h2>
                              </div>
                              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                   <h1>Tab 2</h1>     
                                   <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, sint commodi. Cum, voluptatem saepe maiores adipisci ullam culpa corrupti quas, assumenda error aliquam consequatur enim, sapiente inventore repudiandae nesciunt omnis.</h2>
                              </div>
                              <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                   <h1>Tab 3</h1>     
                                   <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, sint commodi. Cum, voluptatem saepe maiores adipisci ullam culpa corrupti quas, assumenda error aliquam consequatur enim, sapiente inventore repudiandae nesciunt omnis.</h2>
                              </div>
                              <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                   <h1>Tab 4</h1>     
                                   <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, sint commodi. Cum, voluptatem saepe maiores adipisci ullam culpa corrupti quas, assumenda error aliquam consequatur enim, sapiente inventore repudiandae nesciunt omnis.</h2>
                              </div>
                         </div>

                    </div>
               </div>
          </section>
     </div>


<?php
  require 'inc/templates/footer.php';
?>