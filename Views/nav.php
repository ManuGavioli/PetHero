<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
<?php
          if($_SESSION['loggedUser']->isKeeperOrOwner() == 1){
          ?> 
     <span class="navbar-text">
          <a class="nav-link" href="<?php echo FRONT_ROOT.'Keeper/ShowHome'?>" >Pet Hero</a>
     </span>
     <ul class="navbar-nav ml-auto">
             
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Booking/MyBookings'?>">MIS RESERVAS</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Keeper/EditKeeperContent'?>">EDITAR CUIDADOR</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Keeper/MyProfile'?>">MI PERFIL</a>
               </li>
          <?php
          } else {
               if($_SESSION['loggedUser']->isKeeperOrOwner() == 0){
          ?>   
          <span class="navbar-text">
          <a class="nav-link" href="<?php echo FRONT_ROOT.'Owner/ShowHome'?>" >Pet Hero</a>
     </span>
     <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Owner/ShowAddPetView'?>">AGREGAR NUEVA MASCOTA</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Pet/ShowListPetView'?>">VER MIS MASCOTAS</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Owner/MyProfile'?>">MI PERFIL</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Booking/ShowListReservas'?>">RESERVAS</a>
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