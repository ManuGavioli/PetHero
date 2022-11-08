<?php

namespace Controllers;

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

        $keeper = $this->DataKeepers->SearchEmail($email);
        if($keeper != null){
            if($keeper->getPassword() == $password){
                $_SESSION["loggedUser"] = $keeper; 
                $booking_list = $this->DataBookings->GetAll();
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
                    
                    $this->Home();
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

        $pets_list=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
        $pets_listAll=$this->DataPets->GetAll();
        $keeper_list=$this->DataKeepers->GetAll();
        $dates_list=$this->DataDates->GetAll();
        $booking_list = $this->DataBookings->GetAll();
        require_once(VIEWS_PATH.'home.php');
    }


}



?>