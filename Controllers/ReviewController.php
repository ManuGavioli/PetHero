<?php
    namespace Controllers;

    use DAO\ReviewDAODB as ReviewDAODB;
    use DAO\BookingDAODB as BookingDAODB;
    use Models\Review as Review;
    use Models\Keeper as Keeper;
    use Helper\Validation as Validation;
    use Controllers\BookingController as BookingController;
    use \Exception as Exception;

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
            try{
            $reviews_list=$this->DataReviews->GetAllforKeeper($_SESSION["loggedUser"]->getUserId());

            require_once(VIEWS_PATH.'keeper-reviews.php');
            }catch(Exception $ex)
            {
                require_once(VIEWS_PATH."error-page.php");
            }
        }
        
        function AddReview($desc, $score, $idBooking){

            Validation::ValidUser();

            try{
            $booking=$this->DataBookings->GetOnlyOneBooking($idBooking);

            $reviewDate=date("Y-m-d");
    
            $ReviewNew=new Review();
            $ReviewNew->setScore($score);
            $ReviewNew->setDesc($desc);
            $ReviewNew->setReviewDate($reviewDate);
            $ReviewNew->setidBooking($idBooking);
    
            $this->DataReviews->AddReview($ReviewNew);
            $this->BookingController->ReviewBooking($booking);
            
            $this->BookingController->ShowListReservas();
            }catch(Exception $ex)
            {
                require_once(VIEWS_PATH."error-page.php");
            }
        }

    }
?>