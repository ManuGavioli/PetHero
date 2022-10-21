<?php
     require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <?php
               if($_SESSION['loggedUser']->isKeeperOrOwner() == 1){
               ?>  
               <h2 class="mb-4">Listado de reservas</h2>
               <table class="table bg-light-alpha">
                    <form action="<?php echo FRONT_ROOT.''?>" method="post" class="bg-light-alpha p-5">     
                      
                    <?php
                    /*
                    <thead>
                         <th>Id</th>
                         <th>Name</th>
                         <th>Description</th>
                         <th>Email</th>
                         <th>Phone</th>
                         <th></th>
                    </thead>
                    */
                    ?>

                    <tbody>
                         <?php
                              /*foreach($booking_list as $booking)                       // completar con todas las reservas que figuren y sean pasadas 
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $booking->get(); ?></td>  
                                             <td><?php echo $booking->get(); ?></td>
                                             <td><?php echo $booking->get(); ?></td>
                                             <td><?php echo $booking->get(); ?></td>
                                             <td><?php echo $booking->get(); ?></td>
                                             <td>
                                             <button type="submit" class="btn" name="action" value="<?php echo $booking->getId(); ?>,Approve" style="background-color: #48c; color: #fff" >Aceptar</button>
                                             <button type="submit" class="btn" name="action" value="<?php echo $booking->getId(); ?>,Reject" style="background-color: #48c; color: #fff" >Rechazar</button> 
                                             </td>                                                                                                                                                                 
                                        </tr>
                                        
                                   <?php
                              }*/
                         ?>

                    </tbody>

                    <?php 
                         ?>     
                              <h1 style="margin: auto; padding:30px;"> --No hay reservas cargadas aún, cuando disponga de nuevas reservas figurarán en este sector. Utilize la barra de navegación en la esquina superior derecha para navegar en la aplicación-- </h1>
                         <?php     
                    ?>

                    </form>
               
               </table>
               <?php
               }else{
                    if($_SESSION['loggedUser']->isKeeperOrOwner() == 0){
               ?>
                         <h2 class="mb-4">Lista de cuidadores</h2>
                         <?php 
                         foreach($keeper_list as $keeper){ if ($keeper->getAvailableDates() != null && $keeper->getPrice() != null && $keeper->getPetType() != null){
                         ?> 
                              <table class="table bg-light-alpha">
                              <thead>
                                   <th>Nombre y apellido</th>
                                   <th>Tamaño de mascota que cuida</th>
                                   <th>Fechas Disponibles</th>
                                   <th>Precio por estadía</th>
                              </thead>
                              <tbody> 
                                   <tr>
                                        <td><?php  echo $keeper->getFirstName()." ".$keeper->getLastName();  ?></td>
                                        <td><?php 
                                             if($keeper->getPetType() == "big"){
                                                  echo "GRANDE";
                                             }else{
                                                  if($keeper->getPetType() == "medium"){
                                                       echo "MEDIANO";
                                                  }else{
                                                       echo "PEQUEÑO";
                                                  }
                                             }
                                        ?></td>
                                        <td><?php echo "Desde el " . $keeper->getAvailableDates()[0] . " Hasta el " . $keeper->getAvailableDates()[count($keeper->getAvailableDates())-1];    ?></td>
                                        <td><?php echo "$".$keeper->getPrice() * count($keeper->getAvailableDates()); ?></td>
                                   </tr>
                              </tbody> 
                              </table>
                       <?php
                       }}
                    }
               }
               ?>
          </div>
     </section>
</main>