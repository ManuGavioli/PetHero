<?php 
    namespace DAO;

    use Exception as Exception;
    use Models\Keeper as Keeper;
    use DAO\Connection as Connection;
    use Models\Bank as Bank;

    class KeeperDAODB implements IKeeperDAO{

        private $connection;
        private $tableName = "keepers";

        public function Add_Keeper(Keeper $newKeeper)
        {
            try{
                $query = "INSERT INTO ". $this->tableName . " (firstName, lastName, dni, email, pass, phoneNumber, petType, price, BankKeeper ) VALUES (:firstName, :lastName, :dni, :email, :pass, :phoneNumber, :petType, :price, :BankKeeper );";

                $parameters["firstName"] = $newKeeper->getFirstName();
                $parameters["lastName"] = $newKeeper->getLastName();
                $parameters["dni"] = $newKeeper->getDni();
                $parameters["email"] = $newKeeper->getEmail();
                $parameters["pass"] = $newKeeper->getPassword();
                $parameters["phoneNumber"] = $newKeeper->getPhoneNumber();

                //atributos unicos de keeper

                $parameters["petType"] = $newKeeper->getPetType();
                $parameters["price"] = $newKeeper->getPrice();
                $parameters["BankKeeper"] = $newKeeper->getBankKeeper()->getIdBank();

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

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach($resultSet as $row){
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
                    $keeper->setNotification($row["notifications"]);
                    // AGREGO EL BANK id

                    $keeper->setBankKeeper($row["BankKeeper"]);

                    array_push($keeperList, $keeper);
                }
                return $keeperList;

            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove($id)
        {
            try{
                $query = "DELETE FROM ".$this->tableName." WHERE (id = :id)";
                $parameter["user_id"] = $id;
    
                $this->connection = connection::GetInstance();
                $this->connection->ExecuteNonQuery($query,$parameter);
    
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function SearchEmail($email)
        {
            try{

                $query = "SELECT * FROM ".$this->tableName." WHERE email = :email";
                $parameters["email"] = $email;
    
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query,$parameters);

                $keeper = new Keeper;
                $bank = new Bank;

                if(isset($result[0])){
                    $row = $result[0];

                    $keeper->setUserId($row["user_id"]);
                    $keeper->setFirstName($row["firstName"]);
                    $keeper->setLastName($row["lastName"]);
                    $keeper->setDni($row["dni"]);
                    $keeper->setEmail($row["email"]);
                    $keeper->setPassword($row["pass"]);
                    $keeper->setPhoneNumber($row["phoneNumber"]);
                    $keeper->setPetType($row["petType"]);
                    $keeper->setPrice($row["price"]);
                    $keeper->setBankKeeper($row["BankKeeper"]);
                    $keeper->setNotification($row["notifications"]);
                }else{
                    $keeper = null;
                }
                return $keeper;
    
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function EditUser(Keeper $editKeeper)
        {
            try{
                $query = "UPDATE ".$this->tableName." SET firstName = :firstName, lastName = :lastName,  dni = :dni, email = :email, pass = :pass, phoneNumber = :phoneNumber
                WHERE user_id = ".$editKeeper->getUserId();

                $parameters["firstName"] = $editKeeper->getFirstName();
                $parameters["lastName"] = $editKeeper->getLastName();
                $parameters["dni"] = $editKeeper->getDni();
                $parameters["email"] = $editKeeper->getEmail();
                $parameters["pass"] = $editKeeper->getPassword();
                $parameters["phoneNumber"] = $editKeeper->getPhoneNumber();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function getKeeper($id){
            try{

                $query = "SELECT * FROM ".$this->tableName." WHERE user_id = :user_id";
                $parameters["user_id"] = $id;
    
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query,$parameters);

                $keeper = new Keeper;

                if(isset($result[0])){
                    $row = $result[0];

                    $keeper->setUserId($row["user_id"]);
                    $keeper->setFirstName($row["firstName"]);
                    $keeper->setLastName($row["lastName"]);
                    $keeper->setDni($row["dni"]);
                    $keeper->setEmail($row["email"]);
                    $keeper->setPassword($row["pass"]);
                    $keeper->setPhoneNumber($row["phoneNumber"]);
                    $keeper->setPetType($row["petType"]);
                    $keeper->setPrice($row["price"]);
                    $keeper->setBankKeeper($row["BankKeeper"]);
                    $keeper->setNotification($row["notifications"]);
                }else{
                    $keeper = null;
                }
                return $keeper;
    

            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function EditPrice($id, $price)
        {
            try{
                $query = "UPDATE ".$this->tableName." SET price = :price 
                WHERE user_id = ".$id;

                $parameters["price"] = $price;
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function EditPetType($id, $petType)
        {
            try{
                $query = "UPDATE ".$this->tableName." SET petType = :petType 
                WHERE user_id = ".$id;

                $parameters["petType"] = $petType;
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function EditNotification($editKeeper){
            try
            {
                $query = "UPDATE ".$this->tableName." SET  notifications = :notifications
                WHERE user_id = ".$editKeeper->getUserId();

                $parameters["notifications"] = $editKeeper->getNotification();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        

    }
?>