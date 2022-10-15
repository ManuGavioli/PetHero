<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Registro de nuevo cuidador</h2>
               <form action="<?php echo FRONT_ROOT.'Keeper/AddKeeper'?>" method="post" class="bg-light-alpha p-5">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre</label>
                                   <input maxlength="30" type="text" name="first_name" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Apellido</label>
                                   <input maxlength="30" type="text" name="last_name" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">DNI</label>
                                   <input maxlength="8" type="number" name="dni" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Contraseña</label>
                                   <input type="password" name="passw" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Numero de telefono</label>
                                   <input type="number" name="phone_number" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                <label for="">Tamaño de perro dispuesto a cuidar</label>
                                <select name="pet_type" required>
                                    <option value="big">Grande</option>
                                    <option value="medium">Mediano</option>
                                    <option value="small">Pequeño</option>                                
                                </select>
                              </div>
                        </div>
                        <button type="submit" class="btn btn-dark ml-auto d-block">Registrarse en el sistema</button>
                    </div>
               </form>
          </div>
     </section>
</main>