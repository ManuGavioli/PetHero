<?php
     require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Registro de My New Pet</h2>
               <form action="<?php echo FRONT_ROOT.'Owner/AddPet'?>" method="post" class="bg-light-alpha p-5">
               
               
               <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="name" class="form-control" required>
                              </div>
                        </div>
              
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Foto</label>
                                   <input  type="url" name="photo" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Tipo</label>
                                   <br>
                                   <input type="radio", name="type" value="small"  required> Pequeño
                                   <input type="radio", name="type" value="medium"  required> Mediano
                                   <input type="radio", name="type" value="big" required> Grande
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Raza</label>
                                   <input type="text" name="raze" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Tamaño</label>
                                   <input type="number" name="size" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Foto de Vacunacion</label>
                                   <input  type="url" name="vaccination" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Observaciones</label>
                                   <input type="text" name="observations" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Video</label>
                                   <input  type="url" name="video" class="form-control" required>
                              </div>
                        </div>
                        <button type="submit" class="btn btn-dark ml-auto d-block">Registrar My Pet</button>
                    </div>
               </form>
          </div>
     </section>
</main>