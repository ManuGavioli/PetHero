<?php
    namespace Controllers;

    use DAO\ReviewDAODB as ReviewDAODB;
    use Models\Review as Review;
    use Helper\Validation as Validation;

    class ReviewController
    {
        private $DataReviews;

        function __construct(){
            
            $this->DataReviews=new ReviewDAODB(); 
            
        }
        
        function AddReview($score, $description, $reviewDate, $keeperId){

            
            Validation::ValidUser();
    
            $ReviewNew=new Review();
            $ReviewNew->setScore($score);
            $ReviewNew->setDescription($description);
            $ReviewNew->setReviewDate($reviewDate);
            $ReviewNew->setKeeperId($keeperId);
    
            $this->DataReviews->AddReview($ReviewNew);
    
            $this->ShowListReviewView();
        }

    }
?>