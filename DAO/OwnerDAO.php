<?php

namespace DAO;

use Models\Owner as Owner;
use Models\Pet as Pet;
use DAO\IOwnerDAO as IOwnerDAO;
use Models\Pet as Pet;

class OwnerDAO{

    private $fileName;
    private $OwnersList;

    function __construct(){
        $this->fileName=ROOT.'/Data/owners.json';
    }

    private function RetriveData(){
        $this->OwnersList=array();
        $jsonContent=file_get_contents($this->fileName);
        $ArrayToDecode= $jsonContent ? json_decode($jsonContent, true) : array();

        if (file_exists($this->fileName)){
            foreach($ArrayToDecode as $owner){
                $ownerNew=new Owner();
                $ownerNew->setId($owner['ownerId']);
                $ownerNew->setFirstName($owner['firstName']);
                $ownerNew->setLastName($owner['lastName']);
                $ownerNew->setDni($owner['dni']);
                $ownerNew->setEmail($owner['email']);
                $ownerNew->setPassword($owner['password']);
                $ownerNew->setPhoneNumber($owner['phoneNumber']);
                $ownerNew->setownerType(array());
                
                
                
                foreach($owner['pets'] as $pets){
                        $petNew=new Pet();
                        $petNew->setId($owner['typeowner']['id']);
                        $petNew->setName($owner['typeowner']['name']);
                        $petNew->setDescription($owner['typeowner']['description']);
                }
                

                array_push($this->OwnersList, $ownerNew);

            }
        }

    }

    private function SaveData(){
        $ArrayToEncode=array();


        if(file_exists($this->fileName)){

            foreach($this->Listowners as $owners){
                $ownerJson['id']=$owners->getId();
                $ownerJson['code']=$owners->getCode();
                $ownerJson['name']=$owners->getName();
                $ownerJson['description']=$owners->getDescription();
                $ownerJson['density']=$owners->getDensity();
                $ownerJson['price']=$owners->getPrice();

                //type
                $ownerJson['typeowner']['id']=$owners->getownerType()->getId();
                $ownerJson['typeowner']['name']=$owners->getownerType()->getName();
                $ownerJson['typeowner']['description']=$owners->getownerType()->getDescription();


                array_push($ArrayToEncode, $ownerJson);
            }

            $jsonContent=json_encode($ArrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);

        }
    }
}


?>