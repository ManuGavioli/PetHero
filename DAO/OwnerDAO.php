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
        return $newOwner;
    }



    function Remove($id){
        


    }


    function GetNewId(){
        $id=0;
        $this->RetriveData();

        foreach($this->OwnersList as $owner){

            if($id<$owner->getUserId()){
                $id=$owner->getUserId();
            }
        }

        return $id+1;
    }

    function AddPet($id, Pet $petnew){
        $this->RetriveData();
        $ownerRefresh;
        foreach($this->OwnersList as $owner){
            if($id == $owner->getUserId()){
                $owner->AddPets($petnew);
                $ownerRefresh=$owner;
            }
        }
        
        $this->SaveData();
        return $ownerRefresh;
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
                        $petNew->setId($pets['id']);
                        $petNew->setId($pets['name']);
                        $petNew->setPhoto($pets['photo']);
                        $petNew->setPetType($pets['petType']);
                        $petNew->setRaze($pets['raze']);
                        $petNew->setSize($pets['size']);
                        $petNew->setVaccinationPhoto($pets['vaccinationPhoto']);
                        $petNew->setObservations($pets['observations']);
                        $petNew->setVideo($pets['video']);
                        
                        $ownerNew->AddPets($petNew);
                }
                

                array_push($this->OwnersList, $ownerNew);

            }
        }

    }

    public function SearchEmail($email){
            $this->RetriveData();

            $owners = array_filter($this->OwnersList, function($ownerExist) use($email){
                return $ownerExist->getEmail() == $email;
            });

            $owners = array_values($owners);

            return (count($owners) > 0) ? $owners[0] : null;
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
                    $petNew['name']=$pets->getName();
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