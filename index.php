<?php
     include 'inc/funciones/funciones.php';
     include 'inc/templates/header.php';
?>


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
                         <a class="p-0 nav-link rounded-0 " id="v-pills-dashboard-tab" data-toggle="pill" href="#v-pills-dashboard" role="tab" aria-controls="v-pills-dashboard" aria-selected="true"><i class="fas fa-home"></i>Dashboard</a>
                         <a class="p-0 nav-link rounded-0 active" id="v-pills-registro-tab" data-toggle="pill" href="#v-pills-registro" role="tab" aria-controls="v-pills-registro" aria-selected="false"><i class="fas fa-edit"></i>Registros</a>
                         <a class="p-0 nav-link rounded-0" id="v-pills-reportes-tab" data-toggle="pill" href="#v-pills-reportes" role="tab" aria-controls="v-pills-reportes" aria-selected="false"><i class="fas fa-file-alt"></i>Reportes</a>
                         <a class="p-0 nav-link rounded-0" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-sign-out-alt"></i>Salir</a>
                    </div>
               </div>
                  
          </aside>

          <section id="content-wrapper">
               <div class="row">
                    <div class="col-lg-12">
                         
                         <div class="tab-content" id="v-pills-tabContent">
                              <div class="tab-pane fade " id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
                                   <div class="row justify-content-center border-bottom">
                                        <h3>Actividades Asignadas</h3>     
                                   </div>
                                   
                                   <table id="example" class="display" style="width:100%">
                                   <thead>
                                        <tr>
                                             <th>Name</th>
                                             <th>Position</th>
                                             <th>Office</th>
                                             <th>Age</th>
                                             <th>Start date</th>
                                             <th>Salary</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr>
                                             <td>Tiger Nixon</td>
                                             <td>System Architect</td>
                                             <td>Edinburgh</td>
                                             <td>61</td>
                                             <td>2011/04/25</td>
                                             <td>$320,800</td>
                                        </tr>
                                        <tr>
                                             <td>Garrett Winters</td>
                                             <td>Accountant</td>
                                             <td>Tokyo</td>
                                             <td>63</td>
                                             <td>2011/07/25</td>
                                             <td>$170,750</td>
                                        </tr>
                                        <tr>
                                             <td>Ashton Cox</td>
                                             <td>Junior Technical Author</td>
                                             <td>San Francisco</td>
                                             <td>66</td>
                                             <td>2009/01/12</td>
                                             <td>$86,000</td>
                                        </tr>
                                        <tr>
                                             <td>Cedric Kelly</td>
                                             <td>Senior Javascript Developer</td>
                                             <td>Edinburgh</td>
                                             <td>22</td>
                                             <td>2012/03/29</td>
                                             <td>$433,060</td>
                                        </tr>
                                        <tr>
                                             <td>Airi Satou</td>
                                             <td>Accountant</td>
                                             <td>Tokyo</td>
                                             <td>33</td>
                                             <td>2008/11/28</td>
                                             <td>$162,700</td>
                                        </tr>
                                        <tr>
                                             <td>Brielle Williamson</td>
                                             <td>Integration Specialist</td>
                                             <td>New York</td>
                                             <td>61</td>
                                             <td>2012/12/02</td>
                                             <td>$372,000</td>
                                        </tr>
                                        <tr>
                                             <td>Herrod Chandler</td>
                                             <td>Sales Assistant</td>
                                             <td>San Francisco</td>
                                             <td>59</td>
                                             <td>2012/08/06</td>
                                             <td>$137,500</td>
                                        </tr>
                                        <tr>
                                             <td>Rhona Davidson</td>
                                             <td>Integration Specialist</td>
                                             <td>Tokyo</td>
                                             <td>55</td>
                                             <td>2010/10/14</td>
                                             <td>$327,900</td>
                                        </tr>
                                        <tr>
                                             <td>Colleen Hurst</td>
                                             <td>Javascript Developer</td>
                                             <td>San Francisco</td>
                                             <td>39</td>
                                             <td>2009/09/15</td>
                                             <td>$205,500</td>
                                        </tr>
                                        <tr>
                                             <td>Sonya Frost</td>
                                             <td>Software Engineer</td>
                                             <td>Edinburgh</td>
                                             <td>23</td>
                                             <td>2008/12/13</td>
                                             <td>$103,600</td>
                                        </tr>
                                        <tr>
                                             <td>Jena Gaines</td>
                                             <td>Office Manager</td>
                                             <td>London</td>
                                             <td>30</td>
                                             <td>2008/12/19</td>
                                             <td>$90,560</td>
                                        </tr>
                                        <tr>
                                             <td>Quinn Flynn</td>
                                             <td>Support Lead</td>
                                             <td>Edinburgh</td>
                                             <td>22</td>
                                             <td>2013/03/03</td>
                                             <td>$342,000</td>
                                        </tr>
                                        <tr>
                                             <td>Charde Marshall</td>
                                             <td>Regional Director</td>
                                             <td>San Francisco</td>
                                             <td>36</td>
                                             <td>2008/10/16</td>
                                             <td>$470,600</td>
                                        </tr>
                                        <tr>
                                             <td>Haley Kennedy</td>
                                             <td>Senior Marketing Designer</td>
                                             <td>London</td>
                                             <td>43</td>
                                             <td>2012/12/18</td>
                                             <td>$313,500</td>
                                        </tr>
                                        <tr>
                                             <td>Tatyana Fitzpatrick</td>
                                             <td>Regional Director</td>
                                             <td>London</td>
                                             <td>19</td>
                                             <td>2010/03/17</td>
                                             <td>$385,750</td>
                                        </tr>
                                        <tr>
                                             <td>Michael Silva</td>
                                             <td>Marketing Designer</td>
                                             <td>London</td>
                                             <td>66</td>
                                             <td>2012/11/27</td>
                                             <td>$198,500</td>
                                        </tr>
                                        <tr>
                                             <td>Paul Byrd</td>
                                             <td>Chief Financial Officer (CFO)</td>
                                             <td>New York</td>
                                             <td>64</td>
                                             <td>2010/06/09</td>
                                             <td>$725,000</td>
                                        </tr>
                                        <tr>
                                             <td>Gloria Little</td>
                                             <td>Systems Administrator</td>
                                             <td>New York</td>
                                             <td>59</td>
                                             <td>2009/04/10</td>
                                             <td>$237,500</td>
                                        </tr>
                                        <tr>
                                             <td>Bradley Greer</td>
                                             <td>Software Engineer</td>
                                             <td>London</td>
                                             <td>41</td>
                                             <td>2012/10/13</td>
                                             <td>$132,000</td>
                                        </tr>
                                        <tr>
                                             <td>Dai Rios</td>
                                             <td>Personnel Lead</td>
                                             <td>Edinburgh</td>
                                             <td>35</td>
                                             <td>2012/09/26</td>
                                             <td>$217,500</td>
                                        </tr>
                                        <tr>
                                             <td>Jenette Caldwell</td>
                                             <td>Development Lead</td>
                                             <td>New York</td>
                                             <td>30</td>
                                             <td>2011/09/03</td>
                                             <td>$345,000</td>
                                        </tr>
                                        <tr>
                                             <td>Yuri Berry</td>
                                             <td>Chief Marketing Officer (CMO)</td>
                                             <td>New York</td>
                                             <td>40</td>
                                             <td>2009/06/25</td>
                                             <td>$675,000</td>
                                        </tr>
                                        <tr>
                                             <td>Caesar Vance</td>
                                             <td>Pre-Sales Support</td>
                                             <td>New York</td>
                                             <td>21</td>
                                             <td>2011/12/12</td>
                                             <td>$106,450</td>
                                        </tr>
                                        <tr>
                                             <td>Doris Wilder</td>
                                             <td>Sales Assistant</td>
                                             <td>Sidney</td>
                                             <td>23</td>
                                             <td>2010/09/20</td>
                                             <td>$85,600</td>
                                        </tr>
                                        <tr>
                                             <td>Angelica Ramos</td>
                                             <td>Chief Executive Officer (CEO)</td>
                                             <td>London</td>
                                             <td>47</td>
                                             <td>2009/10/09</td>
                                             <td>$1,200,000</td>
                                        </tr>
                                        <tr>
                                             <td>Gavin Joyce</td>
                                             <td>Developer</td>
                                             <td>Edinburgh</td>
                                             <td>42</td>
                                             <td>2010/12/22</td>
                                             <td>$92,575</td>
                                        </tr>
                                        <tr>
                                             <td>Jennifer Chang</td>
                                             <td>Regional Director</td>
                                             <td>Singapore</td>
                                             <td>28</td>
                                             <td>2010/11/14</td>
                                             <td>$357,650</td>
                                        </tr>
                                        <tr>
                                             <td>Brenden Wagner</td>
                                             <td>Software Engineer</td>
                                             <td>San Francisco</td>
                                             <td>28</td>
                                             <td>2011/06/07</td>
                                             <td>$206,850</td>
                                        </tr>
                                        <tr>
                                             <td>Fiona Green</td>
                                             <td>Chief Operating Officer (COO)</td>
                                             <td>San Francisco</td>
                                             <td>48</td>
                                             <td>2010/03/11</td>
                                             <td>$850,000</td>
                                        </tr>
                                        <tr>
                                             <td>Shou Itou</td>
                                             <td>Regional Marketing</td>
                                             <td>Tokyo</td>
                                             <td>20</td>
                                             <td>2011/08/14</td>
                                             <td>$163,000</td>
                                        </tr>
                                        <tr>
                                             <td>Michelle House</td>
                                             <td>Integration Specialist</td>
                                             <td>Sidney</td>
                                             <td>37</td>
                                             <td>2011/06/02</td>
                                             <td>$95,400</td>
                                        </tr>
                                        <tr>
                                             <td>Suki Burks</td>
                                             <td>Developer</td>
                                             <td>London</td>
                                             <td>53</td>
                                             <td>2009/10/22</td>
                                             <td>$114,500</td>
                                        </tr>
                                        <tr>
                                             <td>Prescott Bartlett</td>
                                             <td>Technical Author</td>
                                             <td>London</td>
                                             <td>27</td>
                                             <td>2011/05/07</td>
                                             <td>$145,000</td>
                                        </tr>
                                        <tr>
                                             <td>Gavin Cortez</td>
                                             <td>Team Leader</td>
                                             <td>San Francisco</td>
                                             <td>22</td>
                                             <td>2008/10/26</td>
                                             <td>$235,500</td>
                                        </tr>
                                        <tr>
                                             <td>Martena Mccray</td>
                                             <td>Post-Sales support</td>
                                             <td>Edinburgh</td>
                                             <td>46</td>
                                             <td>2011/03/09</td>
                                             <td>$324,050</td>
                                        </tr>
                                        <tr>
                                             <td>Unity Butler</td>
                                             <td>Marketing Designer</td>
                                             <td>San Francisco</td>
                                             <td>47</td>
                                             <td>2009/12/09</td>
                                             <td>$85,675</td>
                                        </tr>
                                        <tr>
                                             <td>Howard Hatfield</td>
                                             <td>Office Manager</td>
                                             <td>San Francisco</td>
                                             <td>51</td>
                                             <td>2008/12/16</td>
                                             <td>$164,500</td>
                                        </tr>
                                        <tr>
                                             <td>Hope Fuentes</td>
                                             <td>Secretary</td>
                                             <td>San Francisco</td>
                                             <td>41</td>
                                             <td>2010/02/12</td>
                                             <td>$109,850</td>
                                        </tr>
                                        <tr>
                                             <td>Vivian Harrell</td>
                                             <td>Financial Controller</td>
                                             <td>San Francisco</td>
                                             <td>62</td>
                                             <td>2009/02/14</td>
                                             <td>$452,500</td>
                                        </tr>
                                        <tr>
                                             <td>Timothy Mooney</td>
                                             <td>Office Manager</td>
                                             <td>London</td>
                                             <td>37</td>
                                             <td>2008/12/11</td>
                                             <td>$136,200</td>
                                        </tr>
                                        <tr>
                                             <td>Jackson Bradshaw</td>
                                             <td>Director</td>
                                             <td>New York</td>
                                             <td>65</td>
                                             <td>2008/09/26</td>
                                             <td>$645,750</td>
                                        </tr>
                                        <tr>
                                             <td>Olivia Liang</td>
                                             <td>Support Engineer</td>
                                             <td>Singapore</td>
                                             <td>64</td>
                                             <td>2011/02/03</td>
                                             <td>$234,500</td>
                                        </tr>
                                        <tr>
                                             <td>Bruno Nash</td>
                                             <td>Software Engineer</td>
                                             <td>London</td>
                                             <td>38</td>
                                             <td>2011/05/03</td>
                                             <td>$163,500</td>
                                        </tr>
                                        <tr>
                                             <td>Sakura Yamamoto</td>
                                             <td>Support Engineer</td>
                                             <td>Tokyo</td>
                                             <td>37</td>
                                             <td>2009/08/19</td>
                                             <td>$139,575</td>
                                        </tr>
                                        <tr>
                                             <td>Thor Walton</td>
                                             <td>Developer</td>
                                             <td>New York</td>
                                             <td>61</td>
                                             <td>2013/08/11</td>
                                             <td>$98,540</td>
                                        </tr>
                                        <tr>
                                             <td>Finn Camacho</td>
                                             <td>Support Engineer</td>
                                             <td>San Francisco</td>
                                             <td>47</td>
                                             <td>2009/07/07</td>
                                             <td>$87,500</td>
                                        </tr>
                                        <tr>
                                             <td>Serge Baldwin</td>
                                             <td>Data Coordinator</td>
                                             <td>Singapore</td>
                                             <td>64</td>
                                             <td>2012/04/09</td>
                                             <td>$138,575</td>
                                        </tr>
                                        <tr>
                                             <td>Zenaida Frank</td>
                                             <td>Software Engineer</td>
                                             <td>New York</td>
                                             <td>63</td>
                                             <td>2010/01/04</td>
                                             <td>$125,250</td>
                                        </tr>
                                        <tr>
                                             <td>Zorita Serrano</td>
                                             <td>Software Engineer</td>
                                             <td>San Francisco</td>
                                             <td>56</td>
                                             <td>2012/06/01</td>
                                             <td>$115,000</td>
                                        </tr>
                                        <tr>
                                             <td>Jennifer Acosta</td>
                                             <td>Junior Javascript Developer</td>
                                             <td>Edinburgh</td>
                                             <td>43</td>
                                             <td>2013/02/01</td>
                                             <td>$75,650</td>
                                        </tr>
                                        <tr>
                                             <td>Cara Stevens</td>
                                             <td>Sales Assistant</td>
                                             <td>New York</td>
                                             <td>46</td>
                                             <td>2011/12/06</td>
                                             <td>$145,600</td>
                                        </tr>
                                        <tr>
                                             <td>Hermione Butler</td>
                                             <td>Regional Director</td>
                                             <td>London</td>
                                             <td>47</td>
                                             <td>2011/03/21</td>
                                             <td>$356,250</td>
                                        </tr>
                                        <tr>
                                             <td>Lael Greer</td>
                                             <td>Systems Administrator</td>
                                             <td>London</td>
                                             <td>21</td>
                                             <td>2009/02/27</td>
                                             <td>$103,500</td>
                                        </tr>
                                        <tr>
                                             <td>Jonas Alexander</td>
                                             <td>Developer</td>
                                             <td>San Francisco</td>
                                             <td>30</td>
                                             <td>2010/07/14</td>
                                             <td>$86,500</td>
                                        </tr>
                                        <tr>
                                             <td>Shad Decker</td>
                                             <td>Regional Director</td>
                                             <td>Edinburgh</td>
                                             <td>51</td>
                                             <td>2008/11/13</td>
                                             <td>$183,000</td>
                                        </tr>
                                        <tr>
                                             <td>Michael Bruce</td>
                                             <td>Javascript Developer</td>
                                             <td>Singapore</td>
                                             <td>29</td>
                                             <td>2011/06/27</td>
                                             <td>$183,000</td>
                                        </tr>
                                        <tr>
                                             <td>Donna Snider</td>
                                             <td>Customer Support</td>
                                             <td>New York</td>
                                             <td>27</td>
                                             <td>2011/01/25</td>
                                             <td>$112,000</td>
                                        </tr>
                                   </tbody>
                                   <tfoot>
                                        <tr>
                                             <th>Name</th>
                                             <th>Position</th>
                                             <th>Office</th>
                                             <th>Age</th>
                                             <th>Start date</th>
                                             <th>Salary</th>
                                        </tr>
                                   </tfoot>
                              </table>
                              </div>
                              <div class="tab-pane fade show active" id="v-pills-registro" role="tabpanel" aria-labelledby="v-pills-registro-tab">
                                   <div class="row justify-content-center border-bottom">
                                        <h3>Asignar Actividades</h3>     
                                   </div>
                                   <div class="row pt-5 justify-content-center">                                       
                                        <form>
                                             <div class="form-row">
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
                                             <div class="form-row">
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
                                             <div class="form-row">
                                                  <div class="form-group col-md-8">
                                                       <label for="registra">Registra</label>
                                                       <input type="text" class="form-control" id="registra" readonly>
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                       <label for="fecha">Fecha / Hora</label>
                                                       <input type="text" class="form-control" id="fecha" readonly>
                                                  </div>
                                             </div>
                                             <button type="submit" class="btn btn-primary">Guardar</button>
                                        </form>
                                   </div>
                              </div>
                              <div class="tab-pane fade" id="v-pills-reportes" role="tabpanel" aria-labelledby="v-pills-reportes-tab">
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
  include 'inc/templates/footer.php';
?>