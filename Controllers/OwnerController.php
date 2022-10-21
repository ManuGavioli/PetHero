<?php

namespace Controllers;

use Models\Owner as Owner;
use Models\Pet as Pet;
use Models\Keeper as Keeper;
use DAO\OwnerDAO as OwnerDAO;
use DAO\PetDAO as PetDAO;
use DAO\KeeperDAO as KeeperDAO;
use Helper\Validation as Validation;

class OwnerController{
    private $DataOwners;
    private $DataPets;
    private $DataKeepers;

    function __construct(){
        $this->DataOwners=new OwnerDAO();
        $this->DataPets=new PetDAO();
        $this->DataKeepers=new KeeperDAO();
    }

    function ShowRegisterView(){
        require_once(VIEWS_PATH."owner-register.php");
    }

    function ShowListPetView(){
        Validation::ValidUser();
        require_once(VIEWS_PATH."pet-list.php");
    }

    function ShowAddPetView(){
        Validation::ValidUser();
        require_once(VIEWS_PATH."pet-add.php");
    }

    function ShowReservationView(){
        
    }

    function AddOwner($firstname, $lasName, $dni, $email, $password, $phonenumber){

        

        if($this->DataOwners->SearchEmail($email) == null){
                $ownerNew=new Owner();
                $ownerNew->setFirstName($firstname);
                $ownerNew->setLastName($lasName);
                $ownerNew->setDni($dni);
                $ownerNew->setEmail($email);
                $ownerNew->setPassword($password);
                $ownerNew->setPhoneNumber($phonenumber);

                $this->DataOwners->Add_Owner($ownerNew);
                echo "<script> confirm('Cuenta creada con exito!');</script>";
                require_once(VIEWS_PATH."login.php");
            }else{
                echo "<script> confirm('Ya hay un usuario en el sistema utilizando el email ingresado... vuelva a intentar con uno nuevo');</script>";
                require_once(VIEWS_PATH."owner-register.php");

            } 
    }

    function AddPet($name, $photo, $petType, $raze, $size, $vaccinationPhoto, $observations, $video){

        Validation::ValidUser();

        $petNew=new Pet();
        $petNew->setName($name);
        $petNew->setPhoto($photo);
        $petNew->setPetType($petType);
        $petNew->setRaze($raze);
        $petNew->setSize($size);
        $petNew->setVaccinationPhoto($vaccinationPhoto);
        $petNew->setObservations($observations);

        //convertir la url de un video para luego poder incrustarlo automaticamente en la vista 

        $video=substr($video, 32);

        $petNew->setVideo($video);
        $petNew->setMyowner($_SESSION['loggedUser']);

        $petNew=$this->DataPets->AddPet($petNew);

        $_SESSION['loggedUser']=$this->DataOwners->AddPet($_SESSION['loggedUser']->getUserId(), $petNew);

        header("location:".FRONT_ROOT."Owner/ShowListPetView");
    }

    public function MyProfile(){
        Validation::ValidUser();

        require_once(VIEWS_PATH."user-profile.php");
    }

    public function Edit($user_id){
        Validation::ValidUser();
        require_once(VIEWS_PATH."owner-edit.php");        
    }

    public function EditAux($firstname, $lasName, $dni, $email, $password, $phonenumber){
        Validation::ValidUser();
        $_SESSION['loggedUser']->setFirstName($firstname);
        $_SESSION['loggedUser']->setLastName($lasName);
        $_SESSION['loggedUser']->setDni($dni);
        $_SESSION['loggedUser']->setEmail($email);
        $_SESSION['loggedUser']->setPassword($password);
        $_SESSION['loggedUser']->setPhoneNumber($phonenumber);
        $this->DataOwners->EditUser($_SESSION['loggedUser']);
        echo "<script> confirm('Información actualizada con éxito!');</script>";
        require_once(VIEWS_PATH."user-profile.php");
    }

}



?>