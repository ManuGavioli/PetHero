<?php
     require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Editar datos del usuario</h2>
               <form action="<?php echo FRONT_ROOT.'Owner/EditAux'?>" method="post" class="bg-light-alpha p-5">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre</label>
                                   <input maxlength="30" type="text" name="firstname" class="form-control" value="<?php echo $_SESSION['loggedUser']->getFirstName() ?>" placeholder="<?php echo $_SESSION['loggedUser']->getFirstName() ?>" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Apellido</label>
                                   <input maxlength="30" type="text" name="lasName" class="form-control" value="<?php echo $_SESSION['loggedUser']->getLastName() ?>" placeholder="<?php echo $_SESSION['loggedUser']->getLastName() ?>" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">DNI</label>
                                   <input maxlength="8" type="number" name="dni" class="form-control" value="<?php echo $_SESSION['loggedUser']->getDni() ?>" placeholder="<?php echo $_SESSION['loggedUser']->getDni() ?>" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['loggedUser']->getEmail() ?>" placeholder="<?php echo $_SESSION['loggedUser']->getEmail() ?>" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Contraseña</label>
                                   <input type="password" name="password" class="form-control" value="<?php echo $_SESSION['loggedUser']->getPassword() ?>" placeholder="<?php echo $_SESSION['loggedUser']->getPassword() ?>" required>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Numero de telefono</label>
                                   <input type="number" name="phonenumber" class="form-control" value="<?php echo $_SESSION['loggedUser']->getPhoneNumber() ?>" placeholder="<?php echo $_SESSION['loggedUser']->getPhoneNumber() ?>" required>
                              </div>
                        </div>
                        <button type="submit" class="btn btn-dark ml-auto d-block">Editar Usuario</button>
                    </div>
               </form>
          </div>
     </section>
</main>