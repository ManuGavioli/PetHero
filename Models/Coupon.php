<?php
namespace Models;


class Coupon{

    private $idCoupon;
    private $paidAlready;       //cantidad pagada hasta el momento
    private $fullPayment;       //cantidad total a pagar
    private $voucherNumInic;    //nro del comprobante 
    //private $voucherNumFinal;
    private $BookingId;    


    public function getIdCoupon()
    {
        return $this->idCoupon;
    }

    public function setIdCoupon($idCoupon)
    {
        $this->idCoupon = $idCoupon;
    }

    public function getPaidAlready()
    {
        return $this->paidAlready;
    }

    public function setPaidAlready($paidAlready)
    {
        $this->paidAlready = $paidAlready;
    }

    public function getFullPayment()
    {
        return $this->fullPayment;
    }

    public function setFullPayment($fullPayment)
    {
        $this->fullPayment = $fullPayment;
    }

    public function getBookingId()
    {
        return $this->BookingId;
    }

    public function setBookingId($BookingId)
    {
        $this->BookingId = $BookingId;
    }

    /**
     * Get the value of voucherNumInic
     */
    public function getVoucherNumInic()
    {
        return $this->voucherNumInic;
    }

    /**
     * Set the value of voucherNumInic
     */
    public function setVoucherNumInic($voucherNumInic)
    {
        $this->voucherNumInic = $voucherNumInic;

    }
}


?>