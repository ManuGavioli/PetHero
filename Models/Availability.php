<?php
namespace Models;


class Availability{

    private $availabilityId;
    private $keeperId;
    private $keeperDate;
    private $available;


    public function getKeeperId()
    {
        return $this->keeperId;
    }

    public function setKeeperId($keeperId)
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

    public function getAvailabilityId()
    {
        return $this->availabilityId;
    }

    public function setAvailabilityId($availabilityId)
    {
        $this->availabilityId = $availabilityId;
    }
}


?>