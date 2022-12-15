<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use \Exception as Exception;
    use Models\Message as Message;
    use Models\Chat as Chat;

    class MessageDAODB 
    {
        private $connection;
        private $tableName = "Messages";

        public function GetMessageforChat($chatid)
        {
                try
                {
                    $messageList = array();

                    $query = "SELECT * FROM ".$this->tableName.' WHERE idChat='.$chatid->getIdChat();

                    $this->connection = Connection::GetInstance();

                    $resultSet = $this->connection->Execute($query);
                    
                    if($resultSet != null){
                    foreach ($resultSet as $message)
                    {                
                        $messageNew=new Message();
                        $messageNew->setIdMessage($message['idMessage']);
                        $messageNew->setIdChat($message['idChat']);
                        $messageNew->setDateTimer($message['dateTimer']);
                        $messageNew->setTextMsg($message['textMsg']);
                        $messageNew->setUser($message['user']);

                        array_push($messageList, $messageNew);
                    }

                    return $messageList;
                    } else{
                    return $messageList;
                    }
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
        }

        public function Add($messagenew){
            try{ 
                $query = "INSERT INTO ". $this->tableName . " ( idChat, dateTimer, user, textMsg ) VALUES ( :idChat, :dateTimer, :user, :textMsg );"; 
    
                    $parameters["idChat"] = $messagenew->getIdChat()->getIdChat();
                    $parameters["dateTimer"] = $messagenew->getDateTimer();
                    $parameters["user"] = $messagenew->getUser();
                    $parameters["textMsg"] = $messagenew->getTextMsg();
    
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
    
            }catch(Exception $ex){
                throw $ex;
            }
        }
}
?>