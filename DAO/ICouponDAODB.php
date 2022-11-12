<?php
    namespace DAO;

    interface ICouponDAODB
    {
        public function Modify($idBooking, $mount, $voucher);
    }
?>