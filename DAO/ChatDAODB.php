<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use \Exception as Exception;
    use Models\Chat as Chat;
    use Models\Owner as Owner;
    use Models\Keeper as Keeper;
    use Models\Bank as Bank;

    class ChatDAODB 
    {
        private $connection;
        private $tableName = "Chats";

        public function GetAllforOwner($owner)
        {
                try
                {
                    $chatList = array();

                    $query = "SELECT *, keepers.firstName as firstNameK, keepers.lastName as lastNameK FROM ".$this->tableName." INNER JOIN keepers on Chats.KeeperId = keepers.user_id INNER JOIN owners on Chats.KeeperId = owners.user_id INNER JOIN banks on banks.IdBank = keepers.BankKeeper where Chats.OwnerId=".$owner->getUserId().";";

                    $this->connection = Connection::GetInstance();

                    $resultSet = $this->connection->Execute($query);
                    
                    foreach ($resultSet as $chat)
                    {                
                        $chatNew=new Chat();
                        $chatNew->setIdChat($chat['idChat']);

                            $newOwner = new Owner;
                            $newOwner->setUserId($chat['OwnerId']);
                            $newOwner->setFirstName($chat['firstName']);
                            $newOwner->setLastName($chat['lastName']);
                            $newOwner->setDni($chat['dni']);
                            $newOwner->setEmail($chat['email']);
                            $newOwner->setPassword($chat['pass']);
                            $newOwner->setPhoneNumber($chat['phoneNumber']);

                        $chatNew->setOwnerId($newOwner);


                        $newBank = new Bank;
                        $newBank->setIdBank($chat['IdBank']);
                        $newBank->setCbu($chat['cbu']);
                        $newBank->setAlias($chat['alias']);
                        $newBank->setTotal($chat['total']);

                        $newKeeper = new Keeper;
                        $newKeeper->setUserId($chat["KeeperId"]);
                        $newKeeper->setFirstName($chat["firstNameK"]);
                        $newKeeper->setLastName($chat["lastNameK"]);
                        $newKeeper->setDni($chat["dni"]);
                        $newKeeper->setEmail($chat["email"]);
                        $newKeeper->setPassword($chat["pass"]);
                        $newKeeper->setPhoneNumber($chat["phoneNumber"]);
                        $newKeeper->setPetType($chat["petType"]);
                        $newKeeper->setPrice($chat["price"]);
                        $newKeeper->setBankKeeper($newBank);

                        $chatNew->setKeeperId($newKeeper);

                        array_push($chatList, $chatNew);
                    }

                    return $chatList;
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
        }

        public function GetAllforKeeper($keeper)
        {
                try
                {
                    $chatList = array();

                    $query = "SELECT *, keepers.firstName as firstNameK, keepers.lastName as lastNameK FROM ".$this->tableName." INNER JOIN keepers on Chats.KeeperId = keepers.user_id INNER JOIN owners on Chats.KeeperId = owners.user_id INNER JOIN banks on banks.IdBank = keepers.BankKeeper where Chats.OwnerId=".$keeper->getUserId().";";

                    $this->connection = Connection::GetInstance();

                    $resultSet = $this->connection->Execute($query);
                    
                    foreach ($resultSet as $chat)
                    {                
                        $chatNew=new Chat();
                        $chatNew->setIdChat($chat['idChat']);

                            $newOwner = new Owner;
                            $newOwner->setUserId($chat['OwnerId']);
                            $newOwner->setFirstName($chat['firstName']);
                            $newOwner->setLastName($chat['lastName']);
                            $newOwner->setDni($chat['dni']);
                            $newOwner->setEmail($chat['email']);
                            $newOwner->setPassword($chat['pass']);
                            $newOwner->setPhoneNumber($chat['phoneNumber']);

                        $chatNew->setOwnerId($newOwner);


                        $newBank = new Bank;
                        $newBank->setIdBank($chat['IdBank']);
                        $newBank->setCbu($chat['cbu']);
                        $newBank->setAlias($chat['alias']);
                        $newBank->setTotal($chat['total']);

                        $newKeeper = new Keeper;
                        $newKeeper->setUserId($chat["KeeperId"]);
                        $newKeeper->setFirstName($chat["firstNameK"]);
                        $newKeeper->setLastName($chat["lastNameK"]);
                        $newKeeper->setDni($chat["dni"]);
                        $newKeeper->setEmail($chat["email"]);
                        $newKeeper->setPassword($chat["pass"]);
                        $newKeeper->setPhoneNumber($chat["phoneNumber"]);
                        $newKeeper->setPetType($chat["petType"]);
                        $newKeeper->setPrice($chat["price"]);
                        $newKeeper->setBankKeeper($newBank);

                        $chatNew->setKeeperId($newKeeper);

                        array_push($chatList, $chatNew);
                    }

                    return $chatList;
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
        }


        public function Add($chat){
            try{ 
                $query = "INSERT INTO ". $this->tableName . " ( OwnerId, KeeperId ) VALUES ( :OwnerId, :KeeperId );"; 
    
                    $parameters["OwnerId"] = $chat->getOwnerId()->getUserId();
                    $parameters["KeeperId"] = $chat->getKeeperId();
    
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
                    
    
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetOneChat($id){ //retorna cuando la id del chat es la pasada por parametro
            try
            {
                $chatList = array();
    
                $query = "SELECT *, keepers.firstName as firstNameK, keepers.lastName as lastNameK FROM ".$this->tableName." INNER JOIN keepers on Chats.KeeperId = keepers.user_id INNER JOIN owners on Chats.OwnerId = owners.user_id INNER JOIN banks on banks.IdBank = keepers.BankKeeper WHERE idChat =".$id.';';
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
    
                if($resultSet != null){
                    $chat=$resultSet[0];  

                    $chatNew=new Chat();
                        $chatNew->setIdChat($chat['idChat']);

                            $newOwner = new Owner;
                            $newOwner->setUserId($chat['OwnerId']);
                            $newOwner->setFirstName($chat['firstName']);
                            $newOwner->setLastName($chat['lastName']);
                            $newOwner->setDni($chat['dni']);
                            $newOwner->setEmail($chat['email']);
                            $newOwner->setPassword($chat['pass']);
                            $newOwner->setPhoneNumber($chat['phoneNumber']);

                        $chatNew->setOwnerId($newOwner);


                        $newBank = new Bank;
                        $newBank->setIdBank($chat['IdBank']);
                        $newBank->setCbu($chat['cbu']);
                        $newBank->setAlias($chat['alias']);
                        $newBank->setTotal($chat['total']);

                        $newKeeper = new Keeper;
                        $newKeeper->setUserId($chat["KeeperId"]);
                        $newKeeper->setFirstName($chat["firstNameK"]);
                        $newKeeper->setLastName($chat["lastNameK"]);
                        $newKeeper->setDni($chat["dni"]);
                        $newKeeper->setEmail($chat["email"]);
                        $newKeeper->setPassword($chat["pass"]);
                        $newKeeper->setPhoneNumber($chat["phoneNumber"]);
                        $newKeeper->setPetType($chat["petType"]);
                        $newKeeper->setPrice($chat["price"]);
                        $newKeeper->setBankKeeper($newBank);

                        $chatNew->setKeeperId($newKeeper);
    
                    
                    return $chatNew;
                }else{
                    return null;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    



    }
}
?>