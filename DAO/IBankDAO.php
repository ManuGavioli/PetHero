<?php namespace DAO;

    use Models\Bank as Bank;

    interface IBankDAO
    {
        function GetAll();
        function Add(Bank $newBank);
        function Remove($id);
        function GetforKeeper($id);
        function ModifyTotal($mount);
    }
?>