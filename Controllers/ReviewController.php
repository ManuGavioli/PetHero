<?php
    namespace Controllers;

    use DAO\ReviewDAODB as ReviewDAODB;
    use DAO\BookingDAODB as BookingDAODB;
    use Models\Review as Review;
    use Models\Keeper as Keeper;
    use Helper\Validation as Validation;
    use Controllers\BookingController as BookingController;

    class ReviewController
    {
        private $DataReviews;
        private $DataBookings;
        private $BookingController;

        function __construct(){
            
            $this->DataReviews=new ReviewDAODB();
            $this->DataBookings=new BookingDAODB();
            $this->BookingController = new BookingController;
        }

        function ShowReviewsKeeper(){
            Validation::ValidUser();

            $reviews_list=$this->DataReviews->GetAllforKeeper($_SESSION["loggedUser"]->getUserId());

            require_once(VIEWS_PATH.'keeper-reviews.php');
        }
        
        function AddReview($description, $score, $idBooking){

            Validation::ValidUser();

            $booking=$this->DataBookings->GetOnlyOneBooking($idBooking);

            $reviewDate=date("Y-m-d");
    
            $ReviewNew=new Review();
            $ReviewNew->setScore($score);
            $ReviewNew->setDesc($description);
            $ReviewNew->setReviewDate($reviewDate);
            $ReviewNew->setKeeperId($booking->getKeeperId()->getUserId());
    
            $this->DataReviews->AddReview($ReviewNew);
            $this->BookingController->ReviewBooking($booking);
            
            $this->BookingController->ShowListReservas();
        }

    }
?>