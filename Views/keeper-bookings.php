<?php
     require_once('nav.php');
?>
<main class="py-5">
     
     <section id="listado" class="mb-5">
          
        <div class="container">
            <h2 class="mb-4">Mis Reservas</h2>
            <?php
            foreach($booking_list as $booking){
            ?>
                <table class="table bg-light-alpha">  
                    <form action="<?php echo FRONT_ROOT.'Keeper/Action'?>" method="post" class="bg-light-alpha p-5">             
                        <thead>
                            <th>Dueño</th>
                            <th>Estadia</th>
                            <th>Mascota</th>
                            <th>Monto Pagado</th>
                            <th>Total</th>
                            <th>Estado de la Reserva</th>
                        </thead>
                
                    <tbody>
                        <tr>
                            <td><?php echo ucfirst($booking->getPetId()->getMyowner()->getFirstName())." ".ucfirst($booking->getPetId()->getMyowner()->getLastName()); ?></td>
                            <td><?php echo "Desde el ".$booking->getStartDate()." hasta el ".$booking->getFinalDate(); ?></td>
                            <td><?php echo ucfirst($booking->getPetId()->getName()); ?></td>
                            <td><?php //aca va el objeto Coupon->getPaidAlready ?></td>    
                            <td><?php //aca va el objeto Coupon->getFullPayment ?></td>
                            <td><?php 
                                if($booking->getConfirmed() == 1){
                                    echo "Reserva confirmada - pago pendiente";
                                }else{
                                    if($booking->getConfirmed() == 3){
                                        echo "Reserva confirmada - 50% abonado";
                                    }else{
                                        if($booking->getConfirmed() == 4){  //agregar opcion de borrar reserva
                                            echo "Reserva completada";
                                        }
                                    }
                                }
                            ?></td>
                            <?php 
                            if($booking->getConfirmed() == 2){  //agregar opcion de borrar reserva ?>        
                            <td><?php echo "Reserva Cancelada"; ?></td>   
                            <?php 
                            }
                            ?>
                        </tr>
                    </tbody>
                </table> 
            </form>
            <?php  
            } 
            ?>
        </div>
</main>