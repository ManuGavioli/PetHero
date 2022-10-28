<?php
     require_once('nav.php');
?>
<main class="py-5">
     
     <section id="listado" class="mb-5">
          
          <div class="container">
               <h2 class="mb-4">My Pets</h2>
               <?php foreach($_SESSION['loggedUser']->getPets() as $pets){ 
                if($pets->getPetType()/*==$keeperreservation->getPetType()*/){
                ?> 
                <form action="<?php echo FRONT_ROOT."Owner/NewBooking"?>" method="post">
                                   <table class="table bg-light-alpha">
               
                    <thead>
                         <th>Nombre</th>
                         <th>Raza</th>
                         <th>Tipo</th>
                         <th>Tamaño</th>
                         <th>Observaciones</th>
                    </thead>
                    <tbody> 
                         <tr>
                              <td><?php  echo $pets->getName();  ?></td>
                              <td><?php  echo $pets->getRaze();  ?></td>
                              <td><?php  echo $pets->getPetType();  ?></td>
                              <td><?php  echo $pets->getSize();  ?></td>
                              <td><?php  echo $pets->getObservations();  ?></td>

                         </tr>
                    </tbody> 
                    <thead>
                         <th>Foto</th>
                         <th>Vacunación</th>
                         <th>Video</th>
                    </thead> 
                    <tbody> 
                         <tr>
                              <td><img width="308" height="173.25" src="<?php  echo $pets->getPhoto();  ?>"></td> 
                              <td><img width="308" height="173.25" src="<?php  echo $pets->getVaccinationPhoto();  ?>"></td> 
                              <td><iframe width="308" height="173.25" src="https://www.youtube.com/embed/<?php echo $pets->getVideo(); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
                            <td><button type="submit" class="btn" style="background-color: #FFEC00; color: #000000" >🐱Seleccionar🐶</button></td>
                         </tr>
                        </tbody> 
                    
                        </table>
                        </form>
                        
                        <?php  }} ?> 
                       
          </div>
</main>