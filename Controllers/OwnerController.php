<?php

namespace Controllers;

use Models\Owner as Owner;
use Models\Pet as Pet;
use DAO\OwnerDAO as OwnerDAO;
use Models\Pet as Pet;
use Models\User as User;

class OwnerController{
    private $DataOwners;

    function __construct(){
        $this->DataOwners=new OwnerDAO();
    }

    function ShowRegisterView(){

    }

    function ShowAddPetView(){
        
    }

    function ShowReservationView(){
        
    }

    function AddOwner($id, $firstname, $lasName, $dni, $email, $password, $phonenumber){

                $ownerNew=new Owner();
                $ownerNew->setId($id);
                $ownerNew->setFirstName($firstname);
                $ownerNew->setLastName($lasName);
                $ownerNew->setDni($dni);
                $ownerNew->setEmail($email);
                $ownerNew->setPassword($password);
                $ownerNew->setPhoneNumber($phonenumber);


        $this->DataOwners->Add_Owner($ownerNew);
    }

    



}



?>