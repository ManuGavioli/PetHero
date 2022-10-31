<?php

namespace Controllers;

use Models\Owner as Owner;
use Models\Pet as Pet;
use Models\Availability as Availability;
//use DAO\KeeperDAO as KeeperDAO;
use DAO\KeeperDAODB as KeeperDAODB;
use Models\Keeper as Keeper;
//use DAO\OwnerDAO as OwnerDAO; Persistencia en JSON
use DAO\OwnerDAODB as OwnerDAODB;
use Helper\Validation as Validation;

use DAO\AvailabilityDAODB as AvailabilityDAODB;

class UserController{
    private $DataOwners;
    private $DataKeepers;
    private $DataDates;

    public function __construct(){
        //$this->DataOwners=new OwnerDAO;
        $this->DataOwners=new OwnerDAODB;
        //$this->DataKeepers=new KeeperDAO;
        $this->DataKeepers=new KeeperDAODB;
        $this->DataDates = new AvailabilityDAODB;
    }


    public function LogIn($email, $password){

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
                    $dates_list=$this->DataDates->GetAll();
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
        Validation::ValidUser();
        $keeper_list=$this->DataKeepers->GetAll();
        $dates_list=$this->DataDates->GetAll();
        require_once(VIEWS_PATH.'home.php');
    }


}



?>