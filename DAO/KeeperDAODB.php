<?php 
    namespace DAO;

    use Exception as Exception;
use Models\Booking;
use Models\Keeper as Keeper;

    class KeeperDAODB implements IKeeperDAODB{

        private $connection;
        private $tableName = "keepers";

        public function Add(Keeper $keeper)
        {
            try{
                $query = " INSERT INTO ". $this->tableName . " (user_id, first_name, last_name, dni, email, passw, phone_number, bookings_id, reviews_id, pet_type, price, available_dates ) VALUES (:user_id, :first_name, :last_name, :dni, :email, :passw, :phone_number, :bookings_id, :reviews_id, :pet_type, :price, :available_dates );";

                $parameters["user_id"] = $keeper->getUserId();
                $parameters["first_name"] = $keeper->getFirstName();
                $parameters["last_name"] = $keeper->getLastName();
                $parameters["dni"] = $keeper->getDni();
                $parameters["email"] = $keeper->getEmail();
                $parameters["passw"] = $keeper->getPassword();
                $parameters["phone_number"] = $keeper->getPhoneNumber();

                //objetos y atributos unicos de keeper
                $parameters["bookings_id"]= array();
                foreach($keeper->getBookings() as $booking){
                    array_push($parameters["bookings_id"],$booking->getIdBooking());
                }

                $parameters["reviews_id"]= array();
                foreach($keeper->getReviews() as $review){
                    array_push($parameters["reviews_id"],$review->getIdReview());
                }

                $parameters["pet_type"] = $keeper->getPetType();
                $parameters["price"] = $keeper->getPrice();
                $parameters["available_dates"] = $keeper->getAvailableDates();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll()
        {
            try{
                $keeperList = array();

                $query = "SELECT * FROM ".$this->tableName."INNER JOIN bookings ON keepers.";// aca iria el inner join pero tengo que acceder al id dentro de la lista de objetos que tiene el keeper

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach($resultSet as $row){
                    $keeper = new Keeper;
                    $keeper->setUserId($row["user_id"]);
                    $keeper->setFirstName($row["first_name"]);
                    $keeper->setLastName($row["last_name"]);
                    $keeper->setDni($row["dni"]);
                    $keeper->setEmail($row["email"]);
                    $keeper->setPassword($row["passw"]);
                    $keeper->setPhoneNumber($row["phone_number"]);
                    //INCOMPLETO


                    array_push($keeperList, $keeper);
                }
                return $keeperList;

            }catch(Exception $ex){
                throw $ex;
            }
        }

    }
?>