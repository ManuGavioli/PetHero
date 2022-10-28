<?php

namespace Models;

class Booking{
    private $idBooking;
    private $bookingDates;
    private $amountPaid;
    private $totalValue;


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
}



?>