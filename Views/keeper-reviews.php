<?php
     require_once('nav.php');
?>
<main class="py-5">
     
     <section id="listado" class="mb-5">
          
          <div class="container">
               <h2 class="mb-4">Mis Reseñas</h2>
               <?php foreach($reviews_list as $reviews){ ?> 
                                   <table class="table bg-light-alpha">
               
                    <thead>
                         <th>ID de la reserva</th>
                         <th>Usuario</th>
                         <th>Puntuación</th>
                         <th>Descripción</th>
                         <th>Fecha</th>
                    </thead>
                    <tbody> 
                         <tr>
                              <td><?php  echo $reviews->getidBooking()->getIdBooking();  ?></td>
                              <td><?php  echo $reviews->getIdBooking()->getPetId()->getMyowner()->getFirstName()." ".$reviews->getIdBooking()->getPetId()->getMyowner()->getLastName(); ?></td>
                              <td><?php  if ($reviews->getScore()==1){echo '⭐';} 
                              else if($reviews->getScore()==2){echo '⭐⭐';}
                              else if($reviews->getScore()==3){echo '⭐⭐⭐';}
                              else if($reviews->getScore()==4){echo '⭐⭐⭐⭐';}
                              else if($reviews->getScore()==5){echo '⭐⭐⭐⭐⭐';}  ?></td>
                              <td><?php  echo $reviews->getDesc();  ?></td>
                              <td><?php  echo $reviews->getReviewDate();  ?></td>
                         </tr>
                    </tbody> 
                    <br>
                        </table> <?php  } ?> 
                       
          </div>
</main>