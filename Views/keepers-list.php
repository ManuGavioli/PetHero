<?php
     require_once('nav.php');
?>
<main class="py-5">
     
     <section id="listado" class="mb-5">
          
          <div class="container">
               <h2 class="mb-4">Keepers List</h2>
               <?php foreach($keepers as $keeper){ if ($keeper->getAvailableDates()!=null){?> 
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Bookings</th>
                         <th>Pet Type</th>
                         <th>Dates Avalibles</th>
                    </thead>
                    <tbody> 
                         <tr>
                              <td><?php  echo $keeper->getBookings();  ?></td>
                              <td><?php  echo $keeper->getPetType();  ?></td>
                              <td><?php  foreach ($keeper->getAvailableDates() as $dates){
                                echo $dates."<br>";

                              }
                                ?></td>
                         </tr>
                    </tbody> </table> <?php  }} ?> 
                       
          </div>
</main>