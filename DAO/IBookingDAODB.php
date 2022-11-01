<?php
    namespace DAO;

    use Models\Booking as Booking;

    interface IBookingDAODB
    {
        function GetAll();
        function Add(Booking $newBooking);
        function Remove($id);
        function GetAllforKeeper($id);
    }
?>