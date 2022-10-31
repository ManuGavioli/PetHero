<?php
    namespace DAO;

    interface IAvailabilityDAO
    {
        function GetAll(); 
        function GetAllforKeeper($id);
        function Add_AvailavilityDate($date, $id);
        function Remove($id);
        function Exist($id);
    }
?>