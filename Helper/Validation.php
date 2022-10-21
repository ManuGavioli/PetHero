
<?php
namespace ValidateLog;

class UserValidate{

    static function ValidUser(){
        if(!isset($_SESSION['loggedUser'])){
            header('location:'.FRONT_ROOT);
        }
    }
}


?>
