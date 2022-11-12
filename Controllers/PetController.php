<?php
    namespace Controllers;

    use DAO\PetDAODB as PetDAODB;
    use Models\Pet as Pet;
    use Helper\Validation as Validation;

    class PetController
    {
        private $DataPets;

        function __construct(){
            
            $this->DataPets=new PetDAODB(); 
            
        }

        function ShowListPetView(){
            Validation::ValidUser();
    
            //PASAR lista de pets
            $petsofowner=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
            
            require_once(VIEWS_PATH."pet-list.php");
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
            //agrego solo el id //pasar el owner completo 
            $petNew->setMyowner($_SESSION['loggedUser']);
    
            $this->DataPets->AddPet($petNew);
    
            //no hay mas lista de pets en owner
           //$_SESSION['loggedUser']=$this->DataOwners->AddPet($_SESSION['loggedUser']->getUserId(), $petNew);
    
            $this->ShowListPetView();
        }
    }
?>