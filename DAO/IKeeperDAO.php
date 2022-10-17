<?php
    namespace DAO;

    use Models\Keeper as Keeper;

    interface IKeeperDAO
    {
        function GetAll();
        function Add_Keeper(Keeper $newKeeper);
        function Remove($id);
        function SearchEmail($email);
    }
?>