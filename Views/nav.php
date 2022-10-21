<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <a class="nav-link" href="<?php echo FRONT_ROOT.'User/Home'?>" >Pet Hero</a>
     </span>
     <ul class="navbar-nav ml-auto">
          <?php
          if($_SESSION['loggedUser']->isKeeperOrOwner() == 1){
          ?>    
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Keeper/RegisterAvailableDates'?>">AGREGAR FECHAS DISPONIBLES</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Keeper/MyProfile'?>">MI PERFIL</a>
               </li>
          <?php
          } else {
               if($_SESSION['loggedUser']->isKeeperOrOwner() == 0){
          ?>   
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Owner/ShowAddPetView'?>">AGREGAR NUEVA MASCOTA</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Owner/ShowListPetView'?>">VER MIS MASCOTAS</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php //echo FRONT_ROOT.'Owner/ShowListPetView'?>"><!--MI PERFIL--></a>
               </li>    
               <li class="nav-item">
                    <a class="nav-link" href="<?php //echo FRONT_ROOT.'Owner/ShowListPetView'?>"><!--GENERAR RESEÑA--></a>
               </li>   
          <?php 
               }
          } 
          ?> 
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT.'User/Logout'?>">CERRAR SESIÓN</a>
          </li>
     </ul>
</nav>