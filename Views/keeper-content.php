<?php
     require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Editar fechas disponibles, precio y tamaño de mascotas a cuidar</h2>
               <form action="<?php echo FRONT_ROOT.'Keeper/AddContent'?>" method="post" class="bg-light-alpha p-5">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Fecha de inicio</label>
                                   <input type="date" name="first_date" class="form-control" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Fecha Final</label>
                                   <input type="date" name="end_date" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Precio por dia</label>
                                   <input type="number" name="price" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Tamaño de mascotas a cuidar</label>
                                   <select name="pet_type" required>
                                        <option value="big">Grande</option>
                                        <option value="medium">Mediano</option>
                                        <option value="small">Pequeño</option>                                
                                   </select>
                              </div>
                        </div>
                        <button type="submit" class="btn btn-dark ml-auto d-block">ACEPTAR</button>
                    </div>
               </form>
          </div>
     </section>
</main>