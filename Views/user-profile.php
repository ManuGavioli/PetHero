<?php
     require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Mi Perfil</h2>
               
            <table class="table bg-light-alpha">
                <form action="<?php if($_SESSION['loggedUser']->isKeeperOrOwner()== 1){$controller="Keeper";}else{if($_SESSION['loggedUser']->isKeeperOrOwner()== 0){$controller="Owner";}} echo FRONT_ROOT.$controller."/Edit"?>" method="post" class="bg-light-alpha p-5">
                    <thead>
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
                                if($_SESSION['loggedUser']->getAvailableDates() != null){
                                    echo "Desde el " . $_SESSION['loggedUser']->getAvailableDates()[0] . " Hasta el " . $_SESSION['loggedUser']->getAvailableDates()[count($_SESSION['loggedUser']->getAvailableDates())-1];
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
                                    echo "$".$_SESSION['loggedUser']->getPrice() * count($_SESSION['loggedUser']->getAvailableDates());
                                }else{
                                    echo "NO ASIGNADO";
                                }
                            ?></td>                                                                                                                                                          
                        </tr>
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
            </table>
        </div>
    </section>
</main>