<?php

namespace Controllers;

use Models\Owner as Owner;
use Models\Pet as Pet;
use DAO\KeeperDAO as KeeperDAO;
    use Models\Keeper as Keeper;
use DAO\OwnerDAO as OwnerDAO;

class UserController{
    private $DataOwners;
    private $DataKeepers;

    function __construct(){
        $this->DataOwners=new OwnerDAO();
        $this->DataKeepers=new KeeperDAO();
    }


    function LogIn($email, $password){
        
    }


}



?>