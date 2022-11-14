<?php
namespace DAO;

    use \Exception as Exception;
    use Models\Bank as Bank;   
    use DAO\Connection as Connection;
    use DAO\IBankDAO as IBankDAO;
    use Models\Keeper as Keeper;

class BankDAODB implements IBankDAO{

    private $connection;
    private $tableName = "Banks";


    public function GetAll(){
        try
        {
            $BankList = array();

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $Bank)
            {                
                $BankNew=new Bank();

                $BankNew->setIdBank($Bank['IdBank']);
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

    }


    public function Add(Bank $newBank){
        try
            {
                $query = "INSERT INTO ".$this->tableName." (cbu, alias, total) VALUES (:cbu, :alias, :total);";

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


    public function GetforCbu($cbu){
        $allBanks = $this->GetAll();
        foreach ($allBanks as $Banks){
            if($Banks->getCbu() == $cbu){
                $Bank_keeper=$Banks;
            }else{
                $Bank_keeper = null;
            }
        }
        return $Bank_keeper;
    }
    

    public function ModifyTotal($mount, $idBank){
        try
        {
            $query = "UPDATE ".$this->tableName." SET total=total+".$mount." where IdBank=".$idBank.";";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
                
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function EditBank($cbu,$alias,$idBank){
        try
        {
            $query = "UPDATE ".$this->tableName." SET cbu = :cbu, alias = :alias WHERE IdBank = ".$idBank;

            $parameters['cbu'] = $cbu;
            $parameters['alias'] = $alias;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query,$parameters);
                
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetOneForId($id_bank){
        try
        {
            $query = "SELECT * FROM ".$this->tableName." WHERE IdBank = ".$id_bank;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if($resultSet != null){
                foreach ($resultSet as $Bank)
                {                
                    $newBank=new Bank;

                    $newBank->setIdBank ($Bank['IdBank']);
                    $newBank->setCbu($Bank['cbu']);
                    $newBank->setAlias($Bank['alias']);
                    $newBank->setTotal($Bank['total']);
                }
                
                return $newBank;
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