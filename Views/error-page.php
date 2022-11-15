
	<div class="rounded mx-auto d-block">
		<h1 class="text-center">😕 ¡Uy! Algo salió mal...</h1>
        <p class="text-center">
        <?php if(!isset($message)){ 
		echo "Vuelva a Intentarlo más tarde";
        } else{ echo $message; } ?> </p>
        <a class="btn btn-primary btn-lg btn-block" style='width=30%;'  href="<?php echo FRONT_ROOT.'User/Logout'?>" role="button">Cerrar Sesión</a>
	</div>
