<?php

namespace Models;

use Models\User as User;
use Models\Pet as Pet;

class Owner extends User{

    private $pets;

    function __construct(){
        $this->pets=array();
    }

    public function getPets()
    {
        return $this->pets;
    }

    public function setPets($pets)
    {
        $this->pets = $pets;
    }

    public function AddPets(Pet $newPet){
        array_push($this->pets, $newPet);
    }
}



?>