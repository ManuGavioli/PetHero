<?php
namespace Models;


class Availability{
    private $keeperId;
    private $keeperDate;
    private $available;

    

    public function getkeeperId()
    {
        return $this->keeperId;
    }

    public function setkeeperId($keeperId)
    {
        $this->keeperId = $keeperId;

    }

    public function getKeeperDate()
    {
        return $this->keeperDate;
    }

    public function setKeeperDate($keeperDate)
    {
        $this->keeperDate = $keeperDate;

    }

    public function getAvailable()
    {
        return $this->available;
    }


    public function setAvailable($available)
    {
        $this->available = $available;

    }
}


?>