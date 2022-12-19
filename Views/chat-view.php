<?php
     require_once('nav.php');
?>

<br>
<link rel="stylesheet" href="<?php echo CSS_PATH;?>chats.css">
<section class="body-chat">
    <div class="seccion-chat">
        <div class="usuario-seleccionado">
            <div class="avatar">
                <img src="
                <?php 
                    if ($_SESSION['loggedUser']->isKeeperOrOwner() == 0){
                        echo 'https://cdn-icons-png.flaticon.com/512/236/236832.png';
                    }else{
                        echo 'https://www.pngplay.com/wp-content/uploads/12/User-Avatar-Profile-Clip-Art-Transparent-PNG.png';
                    } ?>" alt="img">
            </div>
            <div class="cuerpo">
                <span>
                <?php 
                    if ($_SESSION['loggedUser']->isKeeperOrOwner() == 0){
                        echo $chatnew->getKeeperId()->getFirstName().' '.$chatnew->getKeeperId()->getLastName(); 
                    }else{
                        echo $chatnew->getOwnerId()->getFirstName().' '.$chatnew->getOwnerId()->getLastName(); 
                    } ?> </span>
                <span> <?php 
                    if ($_SESSION['loggedUser']->isKeeperOrOwner() == 0){
                        echo 'Cuidador';
                    }else{
                        echo 'Dueño';
                    } ?></span>
            </div>
        </div>
        <?php foreach($messagechat as $msg){  ?>
            <?php  if ($msg->getUser()==1) {  ?>
                <div class="panel-chat">
            <div class="mensaje">
                <div class="avatar">
                    <img src="https://cdn-icons-png.flaticon.com/512/236/236832.png" alt="img">
                </div>
                <div class="cuerpo">
                    <!-- <img src="http://localhost/multimedia/png/user-foto-3.png" alt=""> -->
                    <div class="texto">
                    <?php  echo  $msg->getTextMsg();  ?>
                        <span class="tiempo">
                            <i class="far fa-clock"></i>
                            <?php  echo  $msg->getDateTimer();  ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php }else{ ?>
            <!-- derecha -->
            <div class="panel-chat">
            <div class="mensaje left">
                <div class="cuerpo">
                    <!-- <img src="http://localhost/multimedia/png/user-foto-3.png" alt=""> -->
                    <div class="texto">
                        <?php  echo  $msg->getTextMsg();  ?>
                        <span class="tiempo">
                            <i class="far fa-clock"></i>
                            <?php  echo  $msg->getDateTimer();  ?>
                        </span>
                    </div>
                </div>
                <div class="avatar">
                    <img src="https://www.pngplay.com/wp-content/uploads/12/User-Avatar-Profile-Clip-Art-Transparent-PNG.png" alt="img">
                </div>
            </div>
        </div>
        <?php }} ?>
        <div class="panel-escritura">
            <form action="<?php echo FRONT_ROOT."Chat/MessageAdd"?>" method="post" class="textarea">
                <textarea style="max-higth: 50px;" name="text" placeholder="Escribir mensaje"></textarea>
                <button name="chatId" value="<?php  echo $chatnew->getIdChat() ?>" type="submit" class="enviar">
                    <i class="fas fa-paper-plane"><img style="width: 50px, higth:50px;" src="https://icons-for-free.com/download-icon-content+send+icon-1320087227200139227_512.png" alt=""></i>
                </button>
            </form>
        </div>
    </div>
</section>
</body>