<?php
namespace DAO;

    use DAO\IAvailabilityDAO as IAvailabilityDAO;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Availability as Availability;

class AvailabilityDAODB implements IAvailabilityDAO{

    private $connection;
    private $tableName = "AvailabilityDate";

    public function GetAll()
    {
        try
        {
            $availabilityList = array();

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $availability)
            {                
                        $availabilityNew=new Availability();
                        $availabilityNew->setAvailabilityId($availability['availabilityId']);
                        $availabilityNew->setKeeperId($availability['keeperId']);
                        $availabilityNew->setKeeperDate($availability['keeperDate']);
                        $availabilityNew->setAvailable($availability['available']);

                array_push($availabilityList, $availabilityNew);
            }

            return $availabilityList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetAllforKeeper($id){
        try{
            $allDates = $this->GetAll();// cada elemento del array que se guarda en $allDates es un Availability
            $keeper_dates = array();
            foreach ($allDates as $dates){
                if($dates->getKeeperId() == $id){
                    array_push($keeper_dates, $dates->getKeeperDate());
                }
            }
            return $keeper_dates;
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function Add_AvailavilityDate($date, $id){
        try{ 
            $query = "INSERT INTO ". $this->tableName . " ( keeperId, keeperDate, available ) VALUES ( :keeperId, :keeperDate, :available );"; 

                $parameters["keeperId"] = $id;
                $parameters["keeperDate"] = $date;
                $parameters["available"] = true;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function Remove($id)
    {
        try{
            $query = "DELETE FROM ".$this->tableName." WHERE keeperId = :keeperId";
            $parameter["keeperId"] = $id;

            $this->connection = connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameter);

        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function Exist($id){
        try{

            $query = "SELECT * FROM ".$this->tableName." WHERE keeperId = :keeperId";
            $parameters["keeperId"] = $id;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query,$parameters);
            
            $availability = new Availability;

            if(isset($result[0])){
                $row = $result[0];

                $availability = $row;
                
            }else{
                $availability = null;
            }
            return $availability;
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetFiltersDates($beginning, $end){
        try
        {
            $availabilityList = array();

            $query = "SELECT * FROM ".$this->tableName.' WHERE keeperDate >= :keeperDate && keeperDate <= :keeperDateend';

            $parameters["keeperDate"] = $beginning;
            $parameters["keeperDateend"] = $end;
           
            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach ($resultSet as $availability)
            {                
                        $availabilityNew=new Availability();
                        $availabilityNew->setAvailabilityId($availability['availabilityId']);
                        $availabilityNew->setKeeperId($availability['keeperId']);
                        $availabilityNew->setKeeperDate($availability['keeperDate']);
                        $availabilityNew->setAvailable($availability['available']);

                array_push($availabilityList, $availabilityNew);
            }

            return $availabilityList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function DatesAvailability($dates_list, $keeper_id){
        $allDates=$this->GetAll();
        foreach($allDates as $dates){
            foreach($dates_list as $list){
                if($dates->getKeeperDate()==$list && $dates->getKeeperId()==$keeper_id){
                    if($dates->getAvailable()==true){

                    }else{
                        return false;
                    }
                }
            }
        }
        return true;
    }

}


?>