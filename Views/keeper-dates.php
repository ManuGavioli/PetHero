<?php
     require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Registro de fechas disponibles</h2>
               <form action="<?php echo FRONT_ROOT.'Keeper/AddAvailableDates'?>" method="post" class="bg-light-alpha p-5">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Fecha de inicio</label>
                                   <input type="date" name="first_date" class="form-control">
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Fecha Final</label>
                                   <input type="date" name="end_date" class="form-control">
                              </div>
                        </div>
                        <button type="submit" class="btn btn-dark ml-auto d-block">ACEPTAR</button>
                    </div>
               </form>
          </div>
     </section>
</main>