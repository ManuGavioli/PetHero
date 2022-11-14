<?php
namespace DAO;

    use DAO\IReviewDAO as IReviewDAO;
    use \Exception as Exception;
    use Models\Review as Review;  
    use Models\Booking as Booking;
    use Models\Owner as Owner;
    use Models\Pet as Pet; 
    use DAO\Connection as Connection;


class ReviewDAODB implements IReviewDAO{

    private $connection;
    private $tableName = "Reviews";

    

    function GetAll(){
        try
        {
            $ReviewList = array();

            $query = "SELECT * FROM ".$this->tableName." INNER JOIN bookings ON bookings.idBooking = reviews.idBooking  
            INNER JOIN pets ON pets.id_pet = bookings.petId
            INNER JOIN owners ON owners.user_id = pets.id_owner";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $Review)
            {                

                    $ReviewNew=new Review;
                    $ReviewNew->setIdReview($Review['idReview']);
                    $ReviewNew->setDesc($Review['description']);
                    $ReviewNew->setReviewDate($Review['reviewDate']);
                    $ReviewNew->setScore ($Review['score']);
                        
                    $Booking= new Booking;

                    $newOwner = new Owner;
                    $newOwner->setUserId($Review['id_owner']);
                    $newOwner->setFirstName($Review['firstName']);
                    $newOwner->setLastName($Review['lastName']);
                    $newOwner->setDni($Review['dni']);
                    $newOwner->setEmail($Review['email']);
                    $newOwner->setPassword($Review['pass']);
                    $newOwner->setPhoneNumber($Review['phoneNumber']);

                    $newPet = new Pet;
                    $newPet->setId($Review['petId']);
                    $newPet->setName($Review['name_pet']);
                    $newPet->setPhoto($Review['photo']);
                    $newPet->setPetType($Review['petType']);
                    $newPet->setRaze($Review['raze']);
                    $newPet->setSize($Review['size']);
                    $newPet->setVaccinationPhoto($Review['vaccinationPhoto']);
                    $newPet->setObservations($Review['observations']);
                    $newPet->setVideo($Review['video']);
                    $newPet->setMyowner($newOwner);
                    $Booking->setPetId($newPet);
                        
                    $Booking->setKeeperId($Review['keeperId']);
                    $Booking->setIdBooking($Review['idBooking']);
                    $Booking->setStartDate($Review['startDate']);
                    $Booking->setFinalDate($Review['finalDate']);
                    $Booking->setConfirmed($Review['confirmed']);

                    $ReviewNew->setidBooking($Booking);

                array_push($ReviewList, $ReviewNew);
            }

            return $ReviewList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }



    function AddReview(Review $newReview){
        try
            {
                $query = "INSERT INTO ".$this->tableName." (idBooking, description, reviewDate, score) VALUES ( :idBooking, :description, :reviewDate, :score);";


                $parameters['idBooking']=$newReview->getidBooking();
                $parameters['description']=$newReview->getDesc();
                $parameters['reviewDate']=$newReview->getReviewDate();
                $parameters['score']=$newReview->getScore();
                

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    function GetAllforKeeper($id_keeper){
        $allReviews=$this->GetAll();
        $Review_Keeper=array();
        foreach ($allReviews as $Reviews){
            if($Reviews->getIdBooking()->getKeeperId()==$id_keeper){
                array_push($Review_Keeper, $Reviews);
            }
        }
        return $Review_Keeper;
    }

}


?>