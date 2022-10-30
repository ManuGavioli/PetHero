<?php
    namespace DAO;

    use Models\Keeper as Keeper;

    interface IKeeperDAO
    {
        function GetAll();
        function Add_Keeper(Keeper $newKeeper);
        function EditUser(Keeper $editKeeper);
        function Remove($id);
        function SearchEmail($email);
    }
?>