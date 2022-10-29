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
                $query = " INSERT INTO ". $this->tableName . " (user_id, first_name, last_name, dni, email, passw, phone_number, pet_type, price ) VALUES (:user_id, :first_name, :last_name, :dni, :email, :passw, :phone_number, :pet_type, :price );";

                $parameters["user_id"] = $keeper->getUserId();
                $parameters["first_name"] = $keeper->getFirstName();
                $parameters["last_name"] = $keeper->getLastName();
                $parameters["dni"] = $keeper->getDni();
                $parameters["email"] = $keeper->getEmail();
                $parameters["passw"] = $keeper->getPassword();
                $parameters["phone_number"] = $keeper->getPhoneNumber();

                //atributos unicos de keeper

                $parameters["pet_type"] = $keeper->getPetType();
                $parameters["price"] = $keeper->getPrice();

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