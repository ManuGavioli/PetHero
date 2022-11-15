<?php

namespace Controllers;
use \Exception as Exception;

//use Models\Owner as Owner;
//use Models\Pet as Pet;
//use Models\Availability as Availability;
//use DAO\KeeperDAO as KeeperDAO;
//use Models\Keeper as Keeper;
//use DAO\OwnerDAO as OwnerDAO; Persistencia en JSON

use DAO\KeeperDAODB as KeeperDAODB;
use DAO\OwnerDAODB as OwnerDAODB;
use DAO\PetDAODB as PetDAODB;
use Helper\Validation as Validation;
use DAO\AvailabilityDAODB as AvailabilityDAODB;
use DAO\BookingDAODB as Booking;

class UserController{
    private $DataOwners;
    private $DataKeepers;
    private $DataDates;
    private $DataPets;
    private $DataBookings;

    public function __construct(){
        //$this->DataOwners=new OwnerDAO;
        $this->DataOwners=new OwnerDAODB;
        //$this->DataKeepers=new KeeperDAO;
        $this->DataKeepers=new KeeperDAODB;
        $this->DataDates = new AvailabilityDAODB;
        $this->DataPets=new PetDAODB();
        $this->DataBookings=new Booking;
    }


    public function LogIn($email, $password){
    try {
        $keeper = $this->DataKeepers->SearchEmail($email);
        if($keeper != null){
            if($keeper->getPassword() == $password){
                $_SESSION["loggedUser"] = $keeper; 
                header('location:'.FRONT_ROOT.'Keeper/ShowHome');
            }else{
                echo "<script> confirm('Contraseña incorrecta... vuelva a intentar');</script>";
                require_once(VIEWS_PATH."login.php");
            }
        }else{
            $owner = $this->DataOwners->SearchEmail($email);
            if($owner != null){
                if($owner->getPassword() == $password){
                    $_SESSION["loggedUser"] = $owner;
                    header('location:'.FRONT_ROOT.'Owner/ShowHome');
                }else{
                    echo "<script> confirm('Contraseña incorrecta... vuelva a intentar');</script>";
                    require_once(VIEWS_PATH."login.php");
                }
            }else{
                echo "<script> confirm('El email no fue encontrado... vuelva a intentar');</script>";
                require_once(VIEWS_PATH."login.php");
            }
        }
    } catch(Exception $ex)
    {
        require_once(VIEWS_PATH."error-page.php");
    }
    }

    public function Logout(){
        session_destroy();

        require_once(VIEWS_PATH.'login.php');
    }


}



?>