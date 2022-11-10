<?php
    namespace DAO;

    use Models\Bank as Booking;

    interface IBookingDAODB
    {
        function GetAll(){}
        function Add(Bank $newBooking);
        function Remove($id);
        function GetforKeeper($id);
        function ModifyTotal($mount);
    }
?>