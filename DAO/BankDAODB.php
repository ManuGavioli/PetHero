<?php
namespace DAO;

    use \Exception as Exception;
    use Models\Bank as Bank;   
    use DAO\Connection as Connection;
    use DAO\IBankDAO as IBankDAO;
    use Models\Keeper as Keeper;

class BankDAODB implements IBankDAO{

    private $connection;
    private $tableName = "Bank";

    

    public function GetAll(){}
       /* try
        {
            $BankList = array();

            $query = "SELECT * FROM ".$this->tableName." INNER JOIN keepers on Banks.keeperId = keepers.user_id;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $Bank)
            {                
                        $BankNew=new Bank();

                        
                        $newKeeper = new Keeper;
                        $newKeeper->setUserId($Bank["keeperBank"]);
                        $newKeeper->setFirstName($Bank["firstName"]);
                        $newKeeper->setLastName($Bank["lastName"]);
                        $newKeeper->setDni($Bank["dni"]);
                        $newKeeper->setEmail($Bank["email"]);
                        $newKeeper->setPassword($Bank["pass"]);
                        $newKeeper->setPhoneNumber($Bank["phoneNumber"]);
                        $newKeeper->setPetType($Bank["petType"]);
                        $newKeeper->setPrice($Bank["price"]);
                        $BankNew->setkeeperBank($newKeeper);

                       
                      //  $BankNew->setAmountPaid($Bank['amountPaid']); // es un objeto coupon?

                        $BankNew->setCbu($Bank['cbu']);
                        $BankNew->setAlias($Bank['alias']);
                        $BankNew->setTotal($Bank['total']);

                        array_push($BankList,$BankNew);
            }
            return $BankList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }*/



    public function Add(Bank $newBank){
        try
            {
                $query = "INSERT INTO ".$this->tableName." (keeperBank, cbu, alias, total) VALUES ( :keeperBank, :cbu, :alias, :total);";


                $parameters['keeperBank']=$newBank->getKeeperBank();
                $parameters['cbu']=$newBank->getCbu();
                $parameters['alias']=$newBank->getAlias();
                $parameters['total']=$newBank->getTotal();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }



    public function Remove($id){
        


    }

    public function GetforKeeper($id){
        $allBanks=$this->GetAll();
        $Bank_keeper;
        foreach ($allBanks as $Banks){
            if($Banks->getKeeperId()==$id){
                $Bank_keeper=$Banks;
            }
        }
        return $Bank_keeper;
    }

    function ModifyTotal($mount, $idKeeper){
        try
            {
                $query = "UPDATE ".$this->tableName." SET total=total+".$mount."INNER JOIN Keepers k on k.BankKeeper   = IdBank  WHERE k.user_id =".$idKeeper.";";

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query);
                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    

}


?>