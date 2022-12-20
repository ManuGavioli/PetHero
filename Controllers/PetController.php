<?php
    namespace Controllers;

    use DAO\PetDAODB as PetDAODB;
    use Models\Pet as Pet;
    use Helper\Validation as Validation;
    use \Exception as Exception;

    class PetController
    {
        private $DataPets;

        function __construct(){
            
            $this->DataPets=new PetDAODB(); 
            
        }

        function ShowListPetView(){
            Validation::ValidUser();
    
            //PASAR lista de pets
            try{
            $petsofowner=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
            
            require_once(VIEWS_PATH."pet-list.php");
        }catch(Exception $ex)
        {
            require_once(VIEWS_PATH."error-page.php");
        }
        }
        
        function AddPet( $name=0, $petType=0, $raze=0, $size=0, $observations=0, $video=0){
            
            Validation::ValidUser();
            if($petType!=0){
                try{
            
                    if($this->chekTypeFileoutPDF('photo')==true && $this->chekTypeFileALL('vaccinationPhoto')==true){
                    $petNew=new Pet();
                    $petNew->setName($name);
                    $petNew->setPhoto($this->RedirectImage('photo'));
                    $petNew->setPetType($petType);
                    $petNew->setRaze($raze);
                    $petNew->setSize($size);
                    $petNew->setVaccinationPhoto($this->RedirectImage('vaccinationPhoto'));
                    $petNew->setObservations($observations);
            
                    //convertir la url de un video para luego poder incrustarlo automaticamente en la vista 
            
                    $video=substr($video, 32);
            
                    $petNew->setVideo($video);
                    //agrego solo el id //pasar el owner completo 
                    $petNew->setMyowner($_SESSION['loggedUser']);
            
                    $this->DataPets->AddPet($petNew);
            
                    //no hay mas lista de pets en owner
                   //$_SESSION['loggedUser']=$this->DataOwners->AddPet($_SESSION['loggedUser']->getUserId(), $petNew);
            
                    header("location:".FRONT_ROOT."Pet/ShowListPetView");
                    }else{
                        echo "<script> confirm('Formato/s de imagenes cargados inavlidos solo se permite: PNG, JPG y PDF(solo en la planilla de vacunación)');</script>";
                        require_once(VIEWS_PATH."pet-add.php");
                    }
                }catch(Exception $ex)
                {
                    require_once(VIEWS_PATH."error-page.php");
                }
            }else{
                echo "<script> confirm('Formato/s de imagenes cargados inavlidos solo se permite: PNG, JPG y PDF(solo en la planilla de vacunación)');</script>";
                require_once(VIEWS_PATH."pet-add.php");
            }
           
        }

        private function RedirectImage($filename){
            $base_name= basename($_FILES[$filename]["name"]);
            $final_name = date("m-d-y")."-".date("H-i-s")."-".$base_name;
            $route= VIEWS_PATH."Styles/imgPhotoPets/".$final_name;
            move_uploaded_file($_FILES[$filename]['tmp_name'], $route);

            return $route;
        }

        private function chekTypeFileALL($filename){
            $ok=false;
            if($_FILES[$filename]["type"]=='image/jpeg' || $_FILES[$filename]["type"]=='image/png' || $_FILES[$filename]["type"]=='application/pdf' || $_FILES[$filename]["type"]=='image/jpg'){
                $ok=true;
                var_dump($_FILES[$filename]["type"]);
            }
            return $ok;
        }

        private function chekTypeFileoutPDF($filename){
            $ok=false;
            if($_FILES[$filename]["type"]=='image/jpeg' || $_FILES[$filename]["type"]=='image/png' || $_FILES[$filename]["type"]=='image/jpg'){
                $ok=true;
            }
            return $ok;
        }

    }
?>