<?php
     require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Mis Chats</h2>
               
            <table class="table bg-light-alpha">
                <form action="<?php echo FRONT_ROOT."Chat/ChatView"?>" method="post" class="bg-light-alpha p-5">
                    <thead class="navbar-dark bg-dark" style="color: #fff;">
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <?php
                        if($_SESSION['loggedUser']->isKeeperOrOwner()== 0){
                        ?>  
                        <th>Precio por día</th>
                        <?php } ?>
                        <th>Chat</th>
                    </thead>

                    <tbody>
                        <?php
                        if($_SESSION['loggedUser']->isKeeperOrOwner()== 1){
                         foreach($chatsofowner as $chatsowner){ 
                        ?>   
                        <tr>
                            <td><?php echo $chatsowner->getOwnerId()->getFirstName(); ?></td>  
                            <td><?php echo $chatsowner->getOwnerId()->getLastName(); ?></td>
                            <td>  <button type="submit" class="btn" name="chatid" value="<?php echo $chatsowner->getIdChat()?>" style="background-color: green; color: #fff;margin: 5px" >Chatear 💬</button></td>                                                                                                                                                   
                        </tr>
                        
                        <?php } }else{  foreach($chatsofowner as $chatsowner){ 
                        ?>
                        <tr>
                            <td><?php echo $chatsowner->getKeeperId()->getFirstName(); ?></td>  
                            <td><?php echo $chatsowner->getKeeperId()->getLastName(); ?></td>
                            <td><?php echo $chatsowner->getKeeperId()->getPrice(); ?></td>
                            <td>  <button type="submit" class="btn" name="chatid" value="<?php echo $chatsowner->getIdChat()?>" style="background-color: green; color: #fff;margin: 5px" >Chatear 💬</button></td>                                                                                                                                                   
                        </tr>
                        
                        <?php } }?> 
                    </tbody>
                    
                </form>
            </table>
        </div>
    </section>
</main>