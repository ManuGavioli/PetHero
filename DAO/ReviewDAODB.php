<?php
namespace DAO;

    use DAO\IReviewDAO as IReviewDAO;
    use \Exception as Exception;
    use Models\Review as Review;   
    use Models\Keeper as Keeper; 
    use DAO\Connection as Connection;

class ReviewDAODB implements IReviewDAO{

    private $connection;
    private $tableName = "Reviews";

    

    function GetAll(){
        try
        {
            $ReviewList = array();

            $query = "SELECT * FROM ".$this->tableName." inner join Keepers on Keepers.user_id= ".$this->tableName.".keeperId";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $Review)
            {                


                    $ReviewNew=new Review();
                    $ReviewNew->setIdReview($Review['idReview']);
                    $ReviewNew->setDesc($Review['description']);
                    $ReviewNew->setReviewDate($Review['reviewDate']);
                    $ReviewNew->setScore ($Review['score']);
                        

                        $keeper = new Keeper;
                        $keeper->setUserId($row["user_id"]);
                        $keeper->setFirstName($row["firstName"]);
                        $keeper->setLastName($row["lastName"]);
                        $keeper->setDni($row["dni"]);
                        $keeper->setEmail($row["email"]);
                        $keeper->setPassword($row["pass"]);
                        $keeper->setPhoneNumber($row["phoneNumber"]);
                        $keeper->setPetType($row["petType"]);
                        $keeper->setPrice($row["price"]);

                    $ReviewNew->setKeeperId($keeper);

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
                $query = "INSERT INTO ".$this->tableName." (keeperId, description, reviewDate, score) VALUES ( :keeperId, :description, :reviewDate, :score);";


                $parameters['keeperId']=$newReview->getKeeperId();
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



    function Remove($id){
        


    }

    function GetAllforKeeper($id){
        $allReviews=$this->GetAll();
        $Review_Keeper=array();
        foreach ($allReviews as $Reviews){
            if($Reviews->getKeeperId()->getUserId()==$id){
                array_push($Review_Keeper, $Reviews);
            }
        }
        return $Review_Keeper;
    }

}


?>