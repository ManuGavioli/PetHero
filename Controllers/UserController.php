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

    public function __construct(){
        $this->DataOwners=new OwnerDAO;
        $this->DataKeepers=new KeeperDAO;
    }


    public function LogIn($email, $password){
        $this->DataKeepers->GetAll();
        $this->DataOwners->GetAll();

        $keeper = $this->DataKeepers->SearchEmail($email);
        if($keeper != null){
            if($keeper->getPassword() == $password){
                $_SESSION["loggedUser"] = $keeper; 
                require_once(VIEWS_PATH."home.php"); 
            }else{
                echo "<script> confirm('Contraseña incorrecta... vuelva a intentar');</script>";
                require_once(VIEWS_PATH."login.php");
            }
        }else{
            $owner = $this->DataOwners->SearchEmail($email);
            if($owner != null){
                if($owner->getPassword() == $password){
                    $_SESSION["loggedUser"] = $owner;
                    $keeper_list=$this->DataKeepers->GetAll();
                    require_once(VIEWS_PATH."home.php");
                }else{
                    echo "<script> confirm('Contraseña incorrecta... vuelva a intentar');</script>";
                    require_once(VIEWS_PATH."login.php");
                }
            }else{
                echo "<script> confirm('El email no fue encontrado... vuelva a intentar');</script>";
                require_once(VIEWS_PATH."login.php");
            }
        }
    }

    public function Logout(){
        session_destroy();

        require_once(VIEWS_PATH.'login.php');
    }

    public function Home(){
        $keeper_list=$this->DataKeepers->GetAll();
        require_once(VIEWS_PATH.'home.php');
    }


}



?>