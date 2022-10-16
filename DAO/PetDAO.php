<?php

namespace DAO;

use Models\Pet as Pet;
use DAO\IPetDAO as IPetDAO;

class PetDAO implements IPetDAO{

    private $fileName;
    private $PetList;

    function __construct(){
        $this->fileName=ROOT.'/Data/pets.json';
    }


    function GetAll(){
        $this->RetriveData();

        return $this->PetList;
    }



    function AddPet(Pet $newPet){
        $this->RetriveData();
        $newPet->setId($this->GetNewId());
        array_push($this->PetList, $newPet);

        $this->SaveData();
    }



    function Remove($id){
        


    }


    function GetNewId(){
        $id=0;
        $this->RetriveData();

        foreach($this->PetList as $Pet){

            if($id<$Pet->getId()){
                $id=$Pet->getId();
            }
        }

        return $id+1;
    }



    private function RetriveData(){
        $this->PetList=array();
        $jsonContent=file_get_contents($this->fileName);
        $ArrayToDecode= $jsonContent ? json_decode($jsonContent, true) : array();

        if (file_exists($this->fileName)){
            foreach($ArrayToDecode as $Pet){
                
                        $petNew=new Pet();
                        $petNew->setId($Pet['id']);
                        $petNew->setName($Pet['name']);
                        $petNew->setPhoto($Pet['photo']);
                        $petNew->setPetType($Pet['petType']);
                        $petNew->setRaze($Pet['raze']);
                        $petNew->setSize($Pet['size']);
                        $petNew->setVaccinationPhoto($Pet['vaccinationPhoto']);
                        $petNew->setObservations($Pet['observations']);
                        $petNew->setVideo($Pet['video']);

                        $OwnerNew=new Owner();
                        $OwnerNew->setUserId($Pet['myowner']['ownerId']);
                        $OwnerNew->setFirstName($Pet['myowner']['firstName']);
                        $OwnerNew->setLastName($Pet['myowner']['lastName']);
                        $OwnerNew->setDni($Pet['myowner']['dni']);
                        $OwnerNew->setEmail($Pet['myowner']['email']);
                        $OwnerNew->setPassword($Pet['myowner']['password']);
                        $OwnerNew->setPhoneNumber($Pet['myowner']['phoneNumber']);

                        $petNew->setMyOwner($OwnerNew);
                
                
                
                /*$userNew=new User;
                $userNew->setFirstName($Pet['user']['firstName']);
                $userNew->setFirstName($Pet['user']['firstName']);
                $userNew->setFirstName($Pet['user']['firstName']);
                $userNew->setFirstName($Pet['user']['firstName']);
                $userNew->setFirstName($Pet['user']['firstName']);
                $userNew->setFirstName($Pet['user']['firstName']);*/               
                

                array_push($this->PetList, $PetNew);

            }
        }

    }

    private function SaveData(){
        $ArrayToEncode=array();


        if(file_exists($this->fileName)){

            foreach($this->PetList as $Pets){

                    $PetJson['id']=$pets->getId();
                    $PetJson['name']=$pets->getName();
                    $PetJson['photo']=$pets->getPhoto();
                    $PetJson['petType']=$pets->getPetType();
                    $PetJson['raze']=$pets->getRaze();
                    $PetJson['size']=$pets->getSize();
                    $PetJson['vaccinationPhoto']=$pets->getVaccinationPhoto();
                    $PetJson['observations']=$pets->getObservations();
                    $PetJson['video']=$pets->getVideo();
                    $PetJson['myowner']['ownerId']=$Pets->getMyOwner()->getUserId();
                    $PetJson['myowner']['firstName']=$Pets->getMyOwner()->getFirstName();
                    $PetJson['myowner']['lastName']=$Pets->getMyOwner()->getLastName();
                    $PetJson['myowner']['dni']=$Pets->getMyOwner()->getDni();
                    $PetJson['myowner']['email']=$Pets->getMyOwner()->getEmail();
                    $PetJson['myowner']['password']=$Pets->getMyOwner()->getPassword();
                    $PetJson['myowner']['phoneNumber']=$Pets->getMyOwner()->getPhoneNumber();


                array_push($ArrayToEncode, $PetJson);
            }

            $jsonContent=json_encode($ArrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);

        }
    }
}


?>