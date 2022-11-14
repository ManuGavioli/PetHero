<?php
     require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Mi Perfil</h2>
               
            <table class="table bg-light-alpha">
                <form action="<?php if($_SESSION['loggedUser']->isKeeperOrOwner()== 1){$controller="Keeper";}else{if($_SESSION['loggedUser']->isKeeperOrOwner()== 0){$controller="Owner";}} echo FRONT_ROOT.$controller."/Edit"?>" method="post" class="bg-light-alpha p-5">
                    <thead class="navbar-dark bg-dark" style="color: #fff;">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Email</th>
                        <th>Contraseña</th>
                        <th>Numero de telefono</th>
                        <?php
                        if($_SESSION['loggedUser']->isKeeperOrOwner()== 1){
                        ?>
                        <th>Tamaño de mascota a cuidar</th>
                        <th>Fechas disponibles</th>
                        <th>Precio por día</th>
                        <th>Precio total de estadía</th>
                        <?php
                        }else{
                        ?>
                        <th>Cantidad de Mascotas Cargadas</th>
                        <?php
                        }
                        ?>
                    </thead>

                    <tbody>
                        <?php
                        if($_SESSION['loggedUser']->isKeeperOrOwner()== 1){
                        ?>   
                        <tr>
                            <td><?php echo $_SESSION['loggedUser']->getUserId(); ?></td>  
                            <td><?php echo $_SESSION['loggedUser']->getFirstName(); ?></td>
                            <td><?php echo $_SESSION['loggedUser']->getLastName(); ?></td>
                            <td><?php echo $_SESSION['loggedUser']->getDni(); ?></td>
                            <td><?php echo $_SESSION['loggedUser']->getEmail(); ?></td>
                            <td><?php echo $_SESSION['loggedUser']->getPassword(); ?></td>
                            <td><?php echo $_SESSION['loggedUser']->getPhoneNumber(); ?></td>
                            <td><?php
                                if($_SESSION['loggedUser']->getPetType() != null){ 
                                    if($_SESSION['loggedUser']->getPetType() == "big"){
                                        echo "GRANDE";
                                    }else{
                                        if($_SESSION['loggedUser']->getPetType() == "medium"){
                                            echo "MEDIANO";
                                        }else{
                                            echo "PEQUEÑO";
                                        }
                                    }
                                }else{
                                    echo "NO ASIGNADO";
                                }
                            ?></td>
                            <td><?php
                                if($availableDatesFromKeeper != null){
                                    echo "Desde el " . $availableDatesFromKeeper[0] . " Hasta el " . $availableDatesFromKeeper[count($availableDatesFromKeeper)-1];
                                }else{
                                    echo "NO ASIGNADAS";
                                }
                            ?></td>
                            <td><?php 
                                if($_SESSION['loggedUser']->getPrice() != null){
                                    echo "$".$_SESSION['loggedUser']->getPrice();
                                }else{
                                    echo "NO ASIGNADO";
                                }
                            ?></td> 
                            <td><?php 
                                if($_SESSION['loggedUser']->getPrice() != null){
                                    echo "$".$_SESSION['loggedUser']->getPrice() * count($availableDatesFromKeeper);
                                }else{
                                    echo "NO ASIGNADO";
                                }
                            ?></td>                                                                                                                                                          
                        </tr>
            </table>
            <table class="table bg-light-alpha">
                    <h2 class="mb-4">Mis Datos Bancarios</h2>
                        <thead class="navbar-dark bg-dark" style="color: #fff;">
                            <th>CBU</th>
                            <th>Alias</th>
                            <th>Total en la cuenta</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $bankInfo->getCbu(); ?></td>  
                                <td><?php echo $bankInfo->getAlias(); ?></td>
                                <td><?php echo $bankInfo->getTotal(); ?></td>                                                                                                                                                       
                            </tr>
                        </tbody>
                        <?php
            
                        }else{
                        ?>
                        <tr>
                            <td><?php echo $_SESSION['loggedUser']->getUserId(); ?></td>  
                            <td><?php echo $_SESSION['loggedUser']->getFirstName(); ?></td>
                            <td><?php echo $_SESSION['loggedUser']->getLastName(); ?></td>
                            <td><?php echo $_SESSION['loggedUser']->getDni(); ?></td>
                            <td><?php echo $_SESSION['loggedUser']->getEmail(); ?></td>
                            <td><?php echo $_SESSION['loggedUser']->getPassword(); ?></td>
                            <td><?php echo $_SESSION['loggedUser']->getPhoneNumber(); ?></td>
                            <td><?php  echo count($petsofowner); ?></td>                                                                                                                                                        
                        </tr>
                        <?php } ?> 
                    </tbody>
                    <td>
                        <button type="submit" class="btn" name="user_id" value="<?php echo $_SESSION['loggedUser']->getUserId();?>" style="background-color: #48c; color: #fff" >Editar Usuario</button> 
                    </td>
                   
                 
                    
                </form>
                <?php
                    if($_SESSION['loggedUser']->isKeeperOrOwner()== 1){
                    ?> 
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Editar Banco
                    </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Datos Bancarios</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo FRONT_ROOT."Bank/EditBank"?>" method="post">  
                                                <div class="col-lg-4">
                                                    <label>CBU:
                                                        <input type="number" name="cbu" class="form-control" required>
                                                    </label>
                                                    <br>
                                                    <label>ALIAS:
                                                        <input type="text" name="alias" class="form-control" required>
                                                    </label>
                                                    <br>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="idBank" value="<?php echo $_SESSION['loggedUser']->getBankKeeper(); ?>" class="btn btn-primary btn-lg btn-block" style="background-color: #48c; color: #fff" >Editar</button>
                                        </div>
                                            </form>
                                    </div>
                                </div>
                            </div> 
                        </td>
                    <?php
                    }
                    ?>
            </table>
        </div>
    </section>
</main>