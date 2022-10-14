<?php

namespace Models;

class User{

    private $ownerId;
    private $firstName;
    private $lastName;
    private $dni;
    private $email;
    private $password;
    private $phoneNumber;
 

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }


    public function getFirstName()
    {
        return $this->firstName;
    }


    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }


    public function getLastName()
    {
        return $this->lastName;
    }


    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

  
    public function getDni()
    {
        return $this->dni;
    }


    public function setDni($dni)
    {
        $this->dni = $dni;
    }


    public function getEmail()
    {
        return $this->email;
    }

 
    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }


    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

    }
}



?>