<?php

namespace Controllers;

use Models\Owner as Owner;
use Models\Pet as Pet;
use DAO\OwnerDAO as OwnerDAO;
use DAO\PetDAO as PetDAO;

class OwnerController{
    private $DataOwners;
    private $DataPets;

    function __construct(){
        $this->DataOwners=new OwnerDAO();
        $this->DataPets=new PetDAO();
    }

    function ShowRegisterView(){
        require_once(VIEWS_PATH."owner-register.php");
    }

    function ShowListPetView(){
        
    }

    function ShowAddPetView(){
        require_once(VIEWS_PATH."pet-add.php");
    }

    function ShowReservationView(){
        
    }

    function AddOwner($firstname, $lasName, $dni, $email, $password, $phonenumber){

                $ownerNew=new Owner();
                $ownerNew->setFirstName($firstname);
                $ownerNew->setLastName($lasName);
                $ownerNew->setDni($dni);
                $ownerNew->setEmail($email);
                $ownerNew->setPassword($password);
                $ownerNew->setPhoneNumber($phonenumber);


        $this->DataOwners->Add_Owner($ownerNew);
    }

    function AddPet($name, $photo, $petType, $raze, $size, $vaccinationPhoto, $observations, $video){
        $petNew=new Pet();
        $petNew->setName($name);
        $petNew->setPhoto($photo);
        $petNew->setPetType($petType);
        $petNew->setRaze($raze);
        $petNew->setSize($size);
        $petNew->setVaccinationPhoto($vaccinationPhoto);
        $petNew->setObservations($observations);
        $petNew->setVideo($video);

        $this->DataPets->AddPet($petNew);
    }

    



}



?>