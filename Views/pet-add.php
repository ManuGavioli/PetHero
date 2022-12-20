<?php
     require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Registro de My New Pet</h2>
               <form action="<?php echo FRONT_ROOT.'Pet/AddPet'?>" method="post" enctype="multipart/form-data" class="bg-light-alpha p-5">
               
               
               <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input maxlength="30" type="text" name="name" class="form-control" required>
                              </div>
                        </div>
              
                    <div class="col-lg-4">
                        <div class="form-group">
                                   <label for="">Foto</label>
                                   <input  type="file" name="photo" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Tipo</label>
                                   <br>
                                   <input type="radio", name="petType" value="small"  required> Pequeño
                                   <input type="radio", name="petType" value="medium"  required> Mediano
                                   <input type="radio", name="petType" value="big" required> Grande
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Raza</label>
                                   <input maxlength="30" type="text" name="raze" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Peso en KG</label>
                                   <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;" type="number" name="size" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Foto de Vacunacion</label>
                                   <input  type="file" name="vaccinationPhoto" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Observaciones</label>
                                   <input maxlength="270" type="text" name="observations" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Video</label>
                                   <input  type="url" name="video" class="form-control" required>
                              </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark ml-auto d-block">Registrar My Pet</button>
               </form>
          </div>
     </section>
</main>