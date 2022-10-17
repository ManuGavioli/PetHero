<?php
    namespace DAO;

    use Models\Owner as Owner;

    interface IOwnerDAO
    {
        function GetAll();
        function Add_Owner(Owner $newOwner);
        function Remove($id);
        function SearchEmail($email);
    }
?>