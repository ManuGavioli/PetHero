<?php
    namespace DAO;

    use Models\Keeper as Keeper;

    interface IKeeperDAODB
    {
        function Add(Keeper $keeper);
        function GetAll();
    }
?>