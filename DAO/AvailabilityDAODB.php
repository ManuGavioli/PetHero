<?php
namespace DAO;

    use DAO\IAvailabilityDAO as IAvailabilityDAO;
    use \Exception as Exception;
    use DAO\Connection as Connection;
use Models\Availability;

class AvailabilityDAODB implements IAvailabilityDAO{

    private $connection;
    private $tableName = "Availability";

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

                array_push($availabilityList, $availability);
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
            $allDates = $this->GetAll();
            $keeper_dates = array();
            foreach ($allDates as $dates){
                if($dates->getKeeperId() == $id){
                    array_push($keeper_dates, $dates);
                }
            }
            return $keeper_dates;
        }catch(Exception $ex){
            throw $ex;
        }
    }

}


?>