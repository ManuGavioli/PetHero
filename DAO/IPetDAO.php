<?php
    namespace DAO;

    use Models\Pet as Pet;

    interface IPetDAO
    {
        function GetAll();
        function AddPet(Pet $newPet);
        function Remove($id);
    }
?>