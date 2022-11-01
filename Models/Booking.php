<?php

namespace Models;

class Booking{
    private $keeperId;
    private $idBooking;
    private $amountPaid=0;
    private $totalValue;
    private $startDate;
    private $finalDate;
    private $confirmed=false;
    private $petId;


    public function getIdBooking()
    {
        return $this->idBooking;
    }

    public function setIdBooking($idBooking)
    {
        $this->idBooking = $idBooking;
    }

    public function getBookingDates()
    {
        return $this->bookingDates;
    }
 
    public function setBookingDates($bookingDates)
    {
        $this->bookingDates = $bookingDates;
    }

    public function getAmountPaid()
    {
        return $this->amountPaid;
    }
 
    public function setAmountPaid($amountPaid)
    {
        $this->amountPaid = $amountPaid;
    }

    public function getTotalValue()
    {
        return $this->totalValue;
    }

    public function setTotalValue($totalValue)
    {
        $this->totalValue = $totalValue;
    }

    public function getKeeperId()
    {
        return $this->keeperId;
    }

    public function setKeeperId($keeperId)
    {
        $this->keeperId = $keeperId;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function getFinalDate()
    {
        return $this->finalDate;
    }

    public function setFinalDate($finalDate)
    {
        $this->finalDate = $finalDate;
    }

    public function getPetId()
    {
        return $this->petId;
    }

    public function setPetId($petId)
    {
        $this->petId = $petId;
    }

    public function getConfirmed()
    {
        return $this->confirmed;
    }

    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }
}



?>