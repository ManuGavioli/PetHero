<?php
     require_once('nav.php');
?>
<main class="py-5">
     
     <section id="listado" class="mb-5">
          
          <div class="container">
               <h2 class="mb-4">My Pets</h2>
               <?php foreach($_SESSION['loggedUser']->getPets() as $pets){ ?> 
               <table class="table bg-light-alpha">
               
                    <thead>
                         <th>Name</th>
                         <th>Raze</th>
                         <th>Type</th>
                         <th>Size</th>
                         <th>Observations</th>
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
                         <th>Photo</th>
                         <th>Vaccination</th>
                         <th>Video</th>
                    </thead> 
                    <tbody> 
                         <tr>
                              <td><img width="308" height="173.25" src="<?php  echo $pets->getPhoto();  ?>"></td> 
                              <td><img width="308" height="173.25" src="<?php  echo $pets->getVaccinationPhoto();  ?>"></td> 
                              <td><iframe width="308" height="173.25" src="<?php echo $pets->getVideo();  ?>" 
                                   title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
                         </tr>
                        </tbody> 
                    
                        </table> <?php  } ?> 
                       
          </div>
</main>