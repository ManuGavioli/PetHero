<?php
     require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de reservas</h2>
               <table class="table bg-light-alpha">
                    <form action="<?php echo FRONT_ROOT.''?>" method="post" class="bg-light-alpha p-5">   

                    <?//php if(){  //if listado de reservas es diferente de null que lo muestre en una tabla?>   
                         
                    <thead>
                         <th>Id</th>
                         <th>Name</th>
                         <th>Description</th>
                         <th>Email</th>
                         <th>Phone</th>
                         <th></th>
                    </thead>

                    <tbody>
                         <?php
                              foreach($booking_list as $booking)                       // completar con todas las reservas que figuren y sean pasadas 
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
                              }
                         ?>

                    </tbody>

                    <?php 
                         //}else{
                         ?>     
                              <h1 style="margin: auto; padding:30px;"> --No hay reservas cargadas aún, cuando disponga de nuevas reservas figurarán en este sector. Utilize la barra de navegación en la esquina superior derecha para navegar en la aplicación-- </h1>
                         <?php     
                         //}
                    ?>

                    </form>
               </table>
          </div>
     </section>
</main>