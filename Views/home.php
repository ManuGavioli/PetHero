<?php
     require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <?php
               if($_SESSION['loggedUser']->isKeeperOrOwner() == 1){
                    if(!empty($booking_list)){?>  
                              <h2 class="mb-4">Listado de reservas</h2>
                              <table class="table bg-light-alpha">
                              <?php foreach($booking_list as $booking)
                         {
                             ?>
                                        <form action="<?php echo FRONT_ROOT.'Booking/Action'?>" method="post" class="bg-light-alpha p-5">     
                                             
                                             <thead class="navbar-dark bg-dark" style="color: #fff;">
                                                  <th>Nombre y apellido</th>
                                                  <th>Nombre de la mascota</th>
                                                  <th>Descripcion</th>
                                                  <th>Email</th>
                                                  <th>Telefono</th>
                                                  <th>Fecha Inicio</th>
                                                  <th>Fecha Final</th>
                                                  <th></th>
                                             </thead>
                                             
                                             <tbody>
                                                  <tr>
                                                       <td><?php echo ucfirst($booking->getPetId()->getMyowner()->getFirstName())." ".ucfirst($booking->getPetId()->getMyowner()->getLastName()); ?></td>  
                                                       <td><?php echo ucfirst($booking->getPetId()->getName()); ?></td>
                                                       <td><?php echo $booking->getPetId()->getObservations(); ?></td>
                                                       <td><?php echo $booking->getPetId()->getMyowner()->getEmail(); ?></td>
                                                       <td><?php echo $booking->getPetId()->getMyowner()->getPhoneNumber(); ?></td>
                                                       <td><?php echo date('d-m-Y', strtotime($booking->getStartDate())); ?></td>
                                                       <td><?php echo date('d-m-Y', strtotime($booking->getFinalDate())); ?></td>
                                                       <td>
                                                       <button type="submit" class="btn" name="action" value="<?php echo $booking->getIdBooking()?>,Approve" style="background-color: green; color: #fff;margin: 5px" >Aceptar</button>
                                                       <button type="submit" class="btn" name="action" value="<?php echo $booking->getIdBooking()?>,Reject" style="background-color: #991919; color: #fff" >Rechazar</button> 
                                                       </td>                                                                                                                                                                
                                                  </tr>
                              <?php
                              
                         }    
                    ?>
                                             </tbody>
                                        </form>
                    <?php
                    }else{
                         ?>     
                              <h1 style="margin: auto; padding:30px;"> --No hay reservas cargadas aún, cuando disponga de nuevas reservas figurarán en este sector. Utilize la barra de navegación en la esquina superior derecha para navegar en la aplicación-- </h1>
                         <?php
                    }
                    ?>
                                   </table>
               <?php
               }else{
                    if($_SESSION['loggedUser']->isKeeperOrOwner() == 0){
               ?>
                         <h2 class="mb-4">Lista de cuidadores</h2>
                         <form action="<?php echo FRONT_ROOT."Owner/FilterKeepers"?>" method="post">

                              <a>Desde:</a> <input maxlength="20" type="date" name="beginning" placeholder="fecha de inicio" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
                              <a>Hasta:</a> <input maxlength="20" type="date" name="end" placeholder="fecha de fin" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
                              
                              <button type="submit" class="btn" style="background-color: #48c; color: #fff" >Search🔎</button>
                         </form>
                         <br>
                         <?php 
                         foreach($keeper_list as $keeper){ //filtrar keepers si está en la lista de dates
                         ?> <form action="<?php echo FRONT_ROOT."Booking/NewBooking"?>" method="post">
                         <?php
                              if($keeper->VeryfyKeeper($dates_list)){
                                   $selectdates=array();
                         ?> 
                              <table class="table bg-light-alpha">
                              <thead>
                                   <th>Nombre y apellido</th>
                                   <th>Tamaño de mascota que cuida</th>
                                   <th>Fechas Disponibles</th>
                                   <th>Precio por Día</th>
                                   <th>Reservar</th> 
                              </thead>
                              <tbody> 
                                   <tr>
                                        <td><?php  echo $keeper->getFirstName()." ".$keeper->getLastName();  ?>
                                   
                              <br>
                              Puntuación: <?php  

                              $promedio=0;
                              $contador=0;
                              foreach($reviews_list as $reviews){

                                  if($reviews->getidBooking()->getKeeperId() == $keeper->getUserId()){
                                   $promedio=$promedio+$reviews->getScore();  
                                   $contador++;
                                  } 
                              }
                              if($contador!=0){
                                   $promedio=$promedio/$contador;
                              }
                              
                              
                              if (round($promedio)==1){echo '⭐';} 
                              else if(round($promedio)==2){echo '⭐⭐';}
                              else if(round($promedio)==3){echo '⭐⭐⭐';}
                              else if(round($promedio)==4){echo '⭐⭐⭐⭐';}
                              else if(round($promedio)==5){echo '⭐⭐⭐⭐⭐';} 
                              else if(round($promedio)==0){echo '  sin reputación';} ?></td>
                                   
                                   
                                   </td>
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
                                        <td>Fecha de Inicio: <br>
                                        <select name="first_date" id="lang"> 
                                                       
                                             <?php 
                                             foreach($dates_list as $dates){
                                                  if ($dates->getKeeperId()==$keeper->getUserId() && $dates->getAvailable()==true){
                                                      ?> <option type="date" value="<?php echo $dates->getKeeperDate() ?>">  <?php echo date('d-m-Y', strtotime($dates->getKeeperDate())).'<br>'; 
                                                  } 
                                             }
                                        ?>
                                        </select>
                                             

                                        <br> Fecha de Final: <br>
                                        <select name="end_date" id="lang"> 
                                             <?php 
                                             foreach($dates_list as $dates){
                                                  if ($dates->getKeeperId()==$keeper->getUserId() && $dates->getAvailable()==true){
                                                      ?> <option type="date" value="<?php echo $dates->getKeeperDate() ?>">  <?php echo date('d-m-Y', strtotime($dates->getKeeperDate())).'<br>'; 
                                                  } 
                                             }
                                        ?>
                                        </select>
                                   
                                   </td>
                                        <td><?php echo "$".$keeper->getPrice() ?></td>
                                        <td>
                                         Seleccione su mascota: <br>
                                        <select name="id_mascot" id="lang" required> 
                                                       
                                                       <?php 
                                                       foreach($pets_list as $pets){
                                                            if ($pets->getPetType()==$keeper->getPetType()){
                                                                 $in=1;
                                                                 foreach($booking_list as $bookingsPETS){
                                                                      if($pets->getId()==$bookingsPETS->getPetId()->getId() and $bookingsPETS->getConfirmed()!=2){
                                                                         $in=0;
                                                                      }
                                                                 }
                                                                 if($in==1){
                                                                 ?> <option value="<?php  echo $pets->getId() ?>">  <?php echo $pets->getName().'<br>'; 
                                                                 }
                                                            } 
                                                       }
                                        ?>
                                        </select>
                                        <br>
                                        <br>
                                        <button type="submit" class="btn" value="<?php echo $keeper->getUserId(); ?>" name="id_keeper" style="background-color: #FFEC00; color: #000000" >Reservar💰</button></td>
                                   </tr>
                              </tbody> 
                              

                              </table>
                              
                              </form>
                       <?php
                    }}}}
               ?>
          </div>
     </section>
</main>