<?php
    namespace DAO;

    use Models\Owner as Owner;
    use Models\Pet as Pet;

    interface IOwnerDAO
    {
        function GetAll();
        function Add_Owner(Owner $newOwner);
        function Remove($id);
        function SearchEmail($email);
        function EditUser($owner);
      //  function AddPet($id, Pet $petnew);
    }
?>