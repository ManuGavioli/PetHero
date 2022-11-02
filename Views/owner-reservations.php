<?php
     require_once('nav.php');
?>
<main class="py-5">
     
     <section id="listado" class="mb-5">
          
          <div class="container">
               <h2 class="mb-4">Reservas💰</h2>
               <?php foreach($Booking_list as $bookings){ ?> 
                                   <table class="table bg-light-alpha">               
                    <thead>
                         <th>Cuidador</th>
                         <th>Estadia</th>
                         <th>Mascota</th>
                         <th>Monto Pagado</th>
                         <th>Total</th>
                         <th>Estado de la Reserva</th>
                    </thead>
                    <tbody> 
                         <tr>
                              <td><?php  foreach($keeper_list as $keeper){
                                        if($keeper->getUserId()==$bookings->getKeeperId()){
                                            echo $keeper->getFirstName();
                                        }
                              }  ?></td>
                              <td><?php  echo "desde ".$bookings->getStartDate()." hasta ".$bookings->getFinalDate() ?></td>
                              <td><?php  foreach($petsofowner as $pet){
                                        if($pet->getId()==$bookings->getPetId()){
                                            echo $pet->getName();
                                        }
                              }  ?></td>
                              <td><?php  echo $bookings->getAmountPaid();  ?></td>
                              <td><?php  echo $bookings->getTotalValue();  ?></td>
                              <td><?php  if($bookings->getConfirmed()==false){
                                echo "El Cuidador no acepto la Reserva aun";
                              }else{
                                ?>  <form action="<?php echo FRONT_ROOT."Owner/PayBooking"?>" method="post">
                                        <button type="submit" class="btn" style="background-color: #48c; color: #fff" >Pagar 50%💰</button>
                                    </form><?php
                              }?></td>

                         </tr>
                    </tbody> 
                        </table> <?php  } ?> 
                       
          </div>
</main>