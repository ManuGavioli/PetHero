<?php

namespace DAO;

use Models\Owner as Owner;
use Models\Pet as Pet;
use DAO\IOwnerDAO as IOwnerDAO;

class OwnerDAO implements IOwnerDAO{

    private $fileName;
    private $OwnersList;

    function __construct(){
        $this->fileName=ROOT.'/Data/owners.json';
    }


    function GetAll(){
        $this->RetriveData();

        return $this->OwnersList;
    }



    function Add_Owner(Owner $newOwner){
        $this->RetriveData();
        $newOwner->setUserId($this->GetNewId());
        array_push($this->OwnersList, $newOwner);

        $this->SaveData();
    }



    function Remove($id){
        


    }


    function GetNewId(){
        $id=0;
        $this->RetriveData();

        foreach($this->OwnersList as $owner){

            if($id<$owner->getId()){
                $id=$owner->getId();
            }
        }

        return $id+1;
    }



    private function RetriveData(){
        $this->OwnersList=array();
        $jsonContent=file_get_contents($this->fileName);
        $ArrayToDecode= $jsonContent ? json_decode($jsonContent, true) : array();

        if (file_exists($this->fileName)){
            foreach($ArrayToDecode as $owner){
                $ownerNew=new Owner();
                $ownerNew->setUserId($owner['ownerId']);
                $ownerNew->setFirstName($owner['firstName']);
                $ownerNew->setLastName($owner['lastName']);
                $ownerNew->setDni($owner['dni']);
                $ownerNew->setEmail($owner['email']);
                $ownerNew->setPassword($owner['password']);
                $ownerNew->setPhoneNumber($owner['phoneNumber']);
                
                
                
                /*$userNew=new User;
                $userNew->setFirstName($owner['user']['firstName']);
                $userNew->setFirstName($owner['user']['firstName']);
                $userNew->setFirstName($owner['user']['firstName']);
                $userNew->setFirstName($owner['user']['firstName']);
                $userNew->setFirstName($owner['user']['firstName']);
                $userNew->setFirstName($owner['user']['firstName']);*/
                
                foreach($owner['pets'] as $pets){
                        $petNew=new Pet();
                        $petNew->setId($owner['id']);
                        $petNew->setPhoto($owner['photo']);
                        $petNew->setPetType($owner['petType']);
                        $petNew->setRaze($owner['raze']);
                        $petNew->setSize($owner['size']);
                        $petNew->setVaccinationPhoto($owner['vaccinationPhoto']);
                        $petNew->setObservations($owner['observations']);
                        $petNew->setVideo($owner['video']);
                        
                        $ownerNew->AddPets($petNew);
                }
                

                array_push($this->OwnersList, $ownerNew);

            }
        }

    }

    private function SaveData(){
        $ArrayToEncode=array();


        if(file_exists($this->fileName)){

            foreach($this->OwnersList as $owners){


                $ownerJson['ownerId']=$owners->getUserId();
                $ownerJson['firstName']=$owners->getFirstName();
                $ownerJson['lastName']=$owners->getLastName();
                $ownerJson['dni']=$owners->getDni();
                $ownerJson['email']=$owners->getEmail();
                $ownerJson['password']=$owners->getPassword();
                $ownerJson['phoneNumber']=$owners->getPhoneNumber();
                $ownerJson['pets']=array();

                foreach($owners->getPets() as $pets){

                    $petNew['id']=$pets->getId();
                    $petNew['photo']=$pets->getPhoto();
                    $petNew['petType']=$pets->getPetType();
                    $petNew['raze']=$pets->getRaze();
                    $petNew['size']=$pets->getSize();
                    $petNew['vaccinationPhoto']=$pets->getVaccinationPhoto();
                    $petNew['observations']=$pets->getObservations();
                    $petNew['video']=$pets->getVideo();
                    
                    
                    array_push($ownerJson['pets'], $petNew);
            }

                array_push($ArrayToEncode, $ownerJson);
            }

            $jsonContent=json_encode($ArrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);

        }
    }
}


?>