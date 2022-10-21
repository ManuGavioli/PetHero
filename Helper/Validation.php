
<?php
namespace Helper;

class Validation{

    static function ValidUser(){
        if(!isset($_SESSION['loggedUser'])){
            header('location:'.FRONT_ROOT);
        }
    }
}


?>
