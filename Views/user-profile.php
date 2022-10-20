<?php
     require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Mi Perfil</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    <th>Numero de telefono</th>
                    <?php
                    if($_SESSION['loggedUser']->isKeeper()== 1){
                    ?>
                    <th>Tamaño de perro</th>
                    <th>Fechas disponibles</th>
                    <?php
                    }
                    ?>
                </thead>

                <tbody>
                    <?php
                    if($_SESSION['loggedUser']->isKeeper()== 1){ 
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
                            if($_SESSION['loggedUser']->getPetType() == "big"){
                                echo "GRANDE";
                            }else{
                                if($_SESSION['loggedUser']->getPetType() == "medium"){
                                    echo "MEDIANO";
                                }else{
                                    echo "PEQUEÑO";
                                }
                            }
                        ?></td>
                        <td><?php 
                            if($_SESSION['loggedUser']->getAvailableDates() != null){
                                echo "Desde el " . $_SESSION['loggedUser']->getAvailableDates()[0] . " Hasta el " . $_SESSION['loggedUser']->getAvailableDates()[count($_SESSION['loggedUser']->getAvailableDates())-1];
                            }else{
                                echo "NO ASIGNADAS";
                            }
                        ?></td>                                                                                                                                                                
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</main>