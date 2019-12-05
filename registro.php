<?php
     include 'inc/funciones/funciones.php';
     include 'inc/templates/header.php';
     include 'inc/templates/sidebar.php';
?>

    <section id="content-wrapper">
          <div class="row">
               <div class="col-lg-12">
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
          </div>
     </section>

<?php
  include 'inc/templates/footer.php';
?>