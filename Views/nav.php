<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
     <strong>Pet Hero</strong>
     </span>
     <ul class="navbar-nav ml-auto">
          <?php
          //if(){  aca va el condicional para que se muestre el nav de owner o keeper dependiendo el caso
          ?>    
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Keeper/RegisterAvailableDates'?>">AGREGAR FECHAS DISPONIBLES</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'Keeper/MyProfile'?>">MI PERFIL</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT.'User/Logout'?>">CERRAR SESIÓN</a>
               </li>
          <?php
          //} 
          ?>       
     </ul>
</nav>