<?php
    namespace DAO;

    use Models\Review as Review;

    interface IPetDAO
    {
        function GetAll();
        function AddReview(Review $newPet);
        function Remove($id);
        function GetAllforKeeper($id);
    }
?>