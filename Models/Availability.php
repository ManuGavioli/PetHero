<?php
namespace Models;


class Availability{
    private $idKeeper;
    private $date;
    private $boolean;

    

    public function getIdKeeper()
    {
        return $this->idKeeper;
    }


    public function setIdKeeper($idKeeper)
    {
        $this->idKeeper = $idKeeper;

    }


    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

    }

 
    public function getBoolean()
    {
        return $this->boolean;
    }


    public function setBoolean($boolean)
    {
        $this->boolean = $boolean;

    }
}


?>