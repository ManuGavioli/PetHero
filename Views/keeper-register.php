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
                                   <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==8) return false;" type="number" name="dni" class="form-control" required>
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
                                   <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==15) return false;" type="number" name="phone_number" class="form-control" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Datos Bancarios</label>
                                   <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==19) return false;" type="number" name="cbu" class="form-control" placeholder="ingrese su cbu para recibir pagos" required>
                                   <br>
                                   <input minlength="6" maxlength="20" type="text" name="alias" class="form-control" placeholder="ingrese su alias para recibir pagos" required>
                              </div>
                        </div>
                        <button type="submit" class="btn btn-dark ml-auto d-block">Registrarse en el sistema</button>
                    </div>
               </form>
          </div>
     </section>
</main>