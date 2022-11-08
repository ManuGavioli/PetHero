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
                              <td><?php
                                            echo $bookings->getKeeperId()->getFirstName()." ".$bookings->getKeeperId()->getLastName();
                               ?></td>
                              <td><?php  echo "desde ".$bookings->getStartDate()." hasta ".$bookings->getFinalDate(); ?></td>
                              <td><?php 
                                            echo $bookings->getPetId()->getName();
                                ?></td>
                              <td><?php  if(!isset($coupon)){
                                        echo 0;
                              }else
                              {
                                   echo $bookings->getAmountPaid();  
                              }
                              ?></td>
                              
                              <td><?php  
                              if(!isset($coupon)){
                                   echo 0;
                         }else
                         {
                              echo $bookings->getTotalValue();
                         }
                                ?></td>
                              <td><?php  if($bookings->getConfirmed()==0){
                                echo "El Cuidador no acepto la Reserva aun";
                              }else if($bookings->getConfirmed()==2){
                                   echo "Reserva Rechazada";
                              }
                              else if($bookings->getConfirmed()==1){
                                ?>  <form action="<?php echo FRONT_ROOT."Owner/PayBooking"?>" method="post">
                                        <button type="submit" class="btn" style="background-color: #48c; color: #fff" >Pagar 50%💰</button>
                                    </form><?php
                              }?></td>

                         </tr>
                    </tbody> 
                        </table> <?php  } ?> 
                       
          </div>
</main>