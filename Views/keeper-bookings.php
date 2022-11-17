<?php
     require_once('nav.php');
?>
<main class="py-5">
     
     <section id="listado" class="mb-5">
          
        <div class="container">
            <h2 class="mb-4">Mis Reservas</h2>
            <?php
            if(!empty($booking_list)){
                foreach($booking_list as $booking){
                    if($booking->getConfirmed() != 0){
            ?>
                <table class="table bg-light-alpha">  
                    <form action="<?php echo FRONT_ROOT.'Booking/DeleteBooking'?>" method="post" class="bg-light-alpha p-5">             
                        <thead class="navbar-dark bg-dark" style="color: #fff;">
                            <th>ID de la reserva</th>
                            <th>Dueño</th>
                            <th>Estadia</th>
                            <th>Mascota</th>
                            <?php
                            if($booking->getConfirmed() != 2){?>
                                <th>Monto Pagado</th>
                                <th>Total</th>
                            <?php   
                            }?>
                            <th>Estado de la Reserva</th>
                            <th></th>
                        </thead>
                
                    <tbody>
                        <tr>
                            <td><?php echo $booking->getIdBooking(); ?></td>
                            <td><?php echo ucfirst($booking->getPetId()->getMyowner()->getFirstName())." ".ucfirst($booking->getPetId()->getMyowner()->getLastName()); ?></td>
                            <td><?php echo "Desde el ".date('d-m-Y', strtotime($booking->getStartDate()))." hasta el ".date('d-m-Y', strtotime($booking->getFinalDate())); ?></td>
                            <td><?php echo ucfirst($booking->getPetId()->getName()); ?></td>
                            <?php foreach($coupon_list as $coupon){
                                if($coupon->getBookingId() == $booking->getIdBooking()){
                                    ?><td><?php echo $coupon->getPaidAlready(); ?></td><?php
                                    ?><td><?php echo $coupon->getFullPayment(); ?></td><?php
                                }
                            } ?>
                            <td><?php 
                                if($booking->getConfirmed() == 1){
                                    echo "Reserva confirmada - pago pendiente";
                                }else{
                                    if($booking->getConfirmed() == 3){
                                        echo "Reserva confirmada - 50% abonado";
                                    }else{
                                        if($booking->getConfirmed() == 4 || $booking->getConfirmed() == 5 || $booking->getConfirmed() == 6){
                                            echo "Reserva completada";
                                        }
                                    }
                                }
                            if($booking->getConfirmed() == 2){       
                                echo "Reserva Cancelada"; ?>    
                            <?php
                            }
                            ?></td>
                            <td><?php 
                            if($booking->getConfirmed() == 2){?>       
                                <button type="submit" class="btn" name="id_booking" value="<?php echo $booking->getIdBooking()?>" style="background-color: #991919; color: #fff" >Borrar</button>   
                            <?php
                            }
                            ?></td>
                            
                        </tr>
                    </tbody>
                </table> 
            </form>
            <?php
                    }
                } 
            }else{
                ?><h1 style="margin: auto; padding:30px;"> --No hay reservas accionadas aun, cuando disponga de las mismas, figurarán en este sector. Utilize la barra de navegación en la esquina superior derecha para navegar en la aplicación-- </h1><?php
            }
            ?>
        </div>
</main>