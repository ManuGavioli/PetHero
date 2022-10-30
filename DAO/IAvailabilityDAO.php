<?php
    namespace DAO;

    interface IAvailabilityDAO
    {
        function GetAll(); 
        function GetAllforKeeper($id);
    }
?>