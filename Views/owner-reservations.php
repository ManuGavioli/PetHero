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
                              <td><?php foreach($coupons_list as $coupons){
                                   if($coupons->getBookingId()==$bookings->getIdBooking()){
                                        echo $coupons->getPaidAlready();  
                                   }
                              }
                                  
                              ?></td>
                              
                              <td><?php  
                              $date1 = date_create($bookings->getStartDate());
                              $date2 = date_create($bookings->getFinalDate());
                              $diff = $date1->diff($date2);
                              // will output 2 days
                              $Total= ($diff->days+1)*$bookings->getKeeperId()->getPrice();
                              echo $Total;
                         
                                ?></td>
                              <td><?php  if($bookings->getConfirmed()==0){
                                echo "El Cuidador no acepto la Reserva aun";
                              }else if($bookings->getConfirmed()==2){
                                   echo "Reserva Rechazada";
                              }else if($bookings->getConfirmed()==3){
                                   echo "Su Reserva ya esta confirmada";
                              }else if($bookings->getConfirmed()==4){
                                   ?>  
                                              <!-- Button trigger modal -->
                                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                  Realizar Review 👍👎
                                                  </button>

                                             <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                             <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Review!!</h5>
                                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                                 </button>
                                                       </div>
                                                                      <div class="modal-body">
                                                                           <form action="<?php echo FRONT_ROOT."Booking/PayBooking"?>" method="post">
                                                                            
                                                                            
                                                                                          <label for="message-text" class="col-form-label">Message:</label>
                                                                                          <textarea class="form-control" id="message-text"></textarea>

                                                                                         
                                                                                          <div class="valoracion">
                                                                                          <p class="clasificacion">
                                                                                          <input id="radio1" type="radio" name="estrellas" value="5">
                                                                                          <label for="radio1">★</label>
                                                                                          <input id="radio2" type="radio" name="estrellas" value="4">
                                                                                          <label for="radio2">★★</label>
                                                                                          <input id="radio3" type="radio" name="estrellas" value="3">
                                                                                          <label for="radio3">★★★</label>
                                                                                          <input id="radio4" type="radio" name="estrellas" value="2">
                                                                                          <label for="radio4">★★★★</label>
                                                                                          <input id="radio5" type="radio" name="estrellas" value="1">
                                                                                          <label for="radio5">★★★★★</label>
                                                                                          </p>            
                                                                      </div>
                                                            <div class="modal-footer">
                                                                 <button type="submit" name="idbooking" value="<?php echo $bookings->getIdBooking(); ?>" class="btn btn-primary btn-lg btn-block" style="background-color: #48c; color: #fff" > Realizar Review 🌟</button>
                                                            </div>
                                                            </form>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                    <?php
                              }
                              else if($bookings->getConfirmed()==1){
                                ?>  
                                              <!-- Button trigger modal -->
                                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                  Pagar 50%💰
                                                  </button>

                                             <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                             <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Datos para el Pago</h5>
                                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                                 </button>
                                                       </div>
                                                                      <div class="modal-body">
                                                                           <form action="<?php echo FRONT_ROOT."Booking/PayBooking"?>" method="post">
                                                                            <div class="col-lg-4">
               
                                                                                <label for="">CBU: <?php  echo $bookings->getKeeperId()->getBankKeeper()->getCbu(); ?></label>
                                                                                <br>
                                                                                <label for="">ALIAS: <?php  echo $bookings->getKeeperId()->getBankKeeper()->getAlias(); ?></label>
                                                                                <br>
                                                                                <label for="">Debe transferir: <?php echo $Total/2; ?></label>
                                                                           </div>
                                                                           
                                                                                <div class="form-group">
                                                                                     <h3>Numero del Comprobante:</h3>
                                                                                     <input maxlength="10" type="number" name="voucher" class="form-control" required>
                                                                                </div>
                                                                      </div>
                                                            <div class="modal-footer">
                                                                 <button type="submit" name="idbooking" value="<?php echo $bookings->getIdBooking(); ?>" class="btn btn-primary btn-lg btn-block" style="background-color: #48c; color: #fff" >Realizar Pago💰</button>
                                                            </div>
                                                            </form>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                    <?php
                              }?></td>

                         </tr>
                    </tbody> 
                        </table> <?php  } ?> 
                       
          </div>
</main>